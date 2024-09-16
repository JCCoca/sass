<?php

class DataTableRepository
{
    protected Connection $connection;

    protected string $table;
    protected string $select;
    protected string $join;
    protected string $where;
    protected bool $softDelete;

    protected int $draw;
    protected int $start;
    protected int $length;
    protected ?string $search;
    protected array $columns;
    protected int $orderColumn;
    protected string $orderDir;

    protected array $columnName;
    protected string $searchConditions;

    protected object $formatData;
    
    public function __construct(string $table, bool $softDelete = true)
    {
        $this->connection = new Connection();

        $this->table = $table;
        $this->select = '';
        $this->join = '';
        $this->where = '';
        $this->softDelete = $softDelete;

        $this->draw = (int) filter_var(@$_REQUEST['draw'], FILTER_VALIDATE_INT) ?? 1;
        $this->start = (int) filter_var(@$_REQUEST['start'], FILTER_VALIDATE_INT) ?? 0;
        $this->length = (int) filter_var(@$_REQUEST['length'], FILTER_VALIDATE_INT) ?? 10;
        $this->search = htmlspecialchars(strip_tags(@$_REQUEST['search']['value']), ENT_QUOTES, 'UTF-8') ?? '';
        $this->columns = (array) @$_REQUEST['columns'] ?? [];
        $this->orderColumn = (int) filter_var(@$_REQUEST['order'][0]['column'], FILTER_VALIDATE_INT) ?? 0;
        $this->orderDir = htmlspecialchars(strip_tags(@$_REQUEST['order'][0]['dir']), ENT_QUOTES, 'UTF-8') ?? 'asc';

        $this->columnName = [];

        $columns = [];
        foreach ($this->columns as $column) {
            $this->columnName[] = ($column['orderable'] == 'true') ? $column['name'] : '';
            
            if ($column['searchable'] == 'true' and !empty($column['name'])) {
                $columns[] = $column['name'];
            }
        }

        $this->searchConditions = implode(' OR ', array_map(fn($col) => "{$col} LIKE :search", $columns));
    }

    public function select(string $select): object
    {
        $this->select .= $select;
        return $this;
    }

    public function join(string $table, string $column1, string $comparator, string $column2): object
    {
        $this->join .= " INNER JOIN {$table} ON {$column1} {$comparator} {$column2}";
        return $this;
    }

    public function leftJoin(string $table, string $column1, string $comparator, string $column2): object
    {
        $this->join .= " LEFT JOIN {$table} ON {$column1} {$comparator} {$column2}";
        return $this;
    }

    public function where(string $a, string $comparator, string $b): object
    {
        $this->where .= " AND {$a} {$comparator} {$b}";
        return $this;
    }

    public function orWhere(string $a, string $comparator, string $b): object
    {
        $this->where .= " OR {$a} {$comparator} {$b}";
        return $this;
    }

    public function softDelete(bool $softDelete): void 
    {
        $this->softDelete = $softDelete;
    }

    public function setColumnName(array $columnName): void
    {
        $this->columnName = $columnName;
    }

    public function formatData(object $formatData): void
    {
        $this->formatData = $formatData;
    }

    public function get(): array
    {
        if ($this->softDelete) {
            $totalQuery = $this->connection->query("SELECT COUNT(*) AS total FROM {$this->table} {$this->join} WHERE {$this->table}.excluido_em IS NULL {$this->where}");
        } else {
            $totalQuery = $this->connection->query("SELECT COUNT(*) AS total FROM {$this->table} {$this->join} WHERE 1 = 1 {$this->where}");
        }
        $totalRecords = $totalQuery->fetch()->total;

        $select = !empty($this->select) ? $this->select : '*';
        $sql = "SELECT {$select} FROM {$this->table} {$this->join} WHERE 1 = 1 {$this->where}";

        if ($this->softDelete) {
            $sql .= " AND {$this->table}.excluido_em IS NULL";
        }

        if (!empty($this->search)) {
            $sql .= " AND ({$this->searchConditions})";
        }

        $sql .= " ORDER BY {$this->columnName[$this->orderColumn]} {$this->orderDir} LIMIT :length OFFSET :start";

        $stmt = $this->connection->prepare($sql);

        if (!empty($this->search)) {
            $stmt->bindValue(':search', '%'.$this->search.'%', PDO::PARAM_STR);
        }
        $stmt->bindValue(':start', $this->start, PDO::PARAM_INT);
        $stmt->bindValue(':length', $this->length, PDO::PARAM_INT);

        $stmt->execute();
        
        $result = $stmt->fetchAll();
        $formatData = $this->formatData ?? null;
        $data = [];

        if (!empty($formatData)) {
            foreach ($result as $key => $value) {
                $data[] = $formatData($value, $key);
            }
        } else {
            foreach ($result as $key => $value) {
                $data[] = $value;
            }
        }

        return [
            "draw" => intval($this->draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => empty($search) ? intval($totalRecords) : intval($stmt->rowCount()),
            "data" => $data
        ];
    }
}
