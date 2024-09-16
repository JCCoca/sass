<?php 

class DB
{
    public static function query(string $query, array $values = []): object
    {
        try {
            Connection::beginTransaction();

            $stmt = Connection::prepare($query);

            foreach ($values as $key => $value) {
                if (gettype($value) === 'string' || gettype($value) === 'float' || gettype($value) === 'double') {
                    $stmt->bindValue($key, $value, PDO::PARAM_STR);
                } else if (gettype($value) === 'integer') {
                    $stmt->bindValue($key, $value, PDO::PARAM_INT);
                } else if (gettype($value) === 'boolean') {
                    $stmt->bindValue($key, $value, PDO::PARAM_BOOL);
                } else if (gettype($value) === 'NULL') {
                    $stmt->bindValue($key, $value, PDO::PARAM_NULL);
                }
            }

            $stmt->execute();

            Connection::commit();
            return $stmt;
        } catch (PDOException $error) {
            Connection::rollBack();
            show500($error);
        }
    } 

    public static function create(string $table, array $values): int|bool
    {
        try {
            Connection::beginTransaction();

            $sColumns = $sValues = '';
            $count = 1;

            foreach ($values as $key => $value) {
                $sColumns .= $key;
                $sValues  .= ":{$key}";

                if ($count < count($values)) {
                    $sColumns .= ', ';
                    $sValues  .= ', ';
                }

                $count++;
            }

            $create = Connection::prepare("INSERT INTO {$table} ({$sColumns}) VALUE ({$sValues})");

            foreach ($values as $key => $value) {
                if (gettype($value) === 'string' || gettype($value) === 'float' || gettype($value) === 'double') {
                    $create->bindValue(":{$key}", $value, PDO::PARAM_STR);
                } else if (gettype($value) === 'integer') {
                    $create->bindValue(":{$key}", $value, PDO::PARAM_INT);
                } else if (gettype($value) === 'boolean') {
                    $create->bindValue(":{$key}", $value, PDO::PARAM_BOOL);
                } else if (gettype($value) === 'NULL') {
                    $create->bindValue(":{$key}", $value, PDO::PARAM_NULL);
                }
            }

            $create->execute();

            if (Connection::lastInsertId() !== false) {
                Connection::commit();
                return intval(Connection::lastInsertId());
            } else {
                Connection::rollBack();
                return false;
            }
        } catch (PDOException $error) {
            Connection::rollBack();
            show500($error);
        }
    }

    public static function update(string $table, array $values, array $conditions = []): bool
    {
        try {
            Connection::beginTransaction();

            $sValues = '';
            $count = 1;

            foreach ($values as $key => $value) {
                $sValues  .= "{$key} = :{$key}";

                if ($count < count($values)) {
                    $sValues  .= ', ';
                }

                $count++;
            }

            $sConditions = '';
            foreach ($conditions as $key => $value) {
                $sConditions  .= " AND {$key} = :{$key}";
            }

            $update = Connection::prepare("UPDATE {$table} SET {$sValues} WHERE 1 = 1 {$sConditions}");

            $fields = array_merge($values, $conditions);
            foreach ($fields as $key => $value) {
                if (gettype($value) === 'string' || gettype($value) === 'float' || gettype($value) === 'double') {
                    $update->bindValue(":{$key}", $value, PDO::PARAM_STR);
                } else if (gettype($value) === 'integer') {
                    $update->bindValue(":{$key}", $value, PDO::PARAM_INT);
                } else if (gettype($value) === 'boolean') {
                    $update->bindValue(":{$key}", $value, PDO::PARAM_BOOL);
                } else if (gettype($value) === 'NULL') {
                    $update->bindValue(":{$key}", $value, PDO::PARAM_NULL);
                }
            }

            $status = $update->execute();

            if ($update->rowCount() > 0 || $status) {
                Connection::commit();
                return true;
            } else {
                Connection::rollBack();
                return false;
            }
        } catch (PDOException $error) {
            Connection::rollBack();
            show500($error);
        }
    }

    public static function delete(string $table, array $conditions = []): bool
    {
        try {
            Connection::beginTransaction();

            $sConditions = '';
            foreach ($conditions as $key => $value) {
                $sConditions  .= " AND {$key} = :{$key}";
            }

            $delete = Connection::prepare("DELETE FROM {$table} WHERE 1 = 1 {$sConditions}");

            foreach ($conditions as $key => $value) {
                if (gettype($value) === 'string' || gettype($value) === 'float' || gettype($value) === 'double') {
                    $delete->bindValue(":{$key}", $value, PDO::PARAM_STR);
                } else if (gettype($value) === 'integer') {
                    $delete->bindValue(":{$key}", $value, PDO::PARAM_INT);
                } else if (gettype($value) === 'boolean') {
                    $delete->bindValue(":{$key}", $value, PDO::PARAM_BOOL);
                } else if (gettype($value) === 'NULL') {
                    $delete->bindValue(":{$key}", $value, PDO::PARAM_NULL);
                }
            }

            $status = $delete->execute();

            if ($delete->rowCount() > 0 || $status) {
                Connection::commit();
                return true;
            } else {
                Connection::rollBack();
                return false;
            }
        } catch (PDOException $error) {
            Connection::rollBack();
            show500($error);
        }
    }
}