<?php

class FileManager
{
    private string $rootPath;
    private string $storagePath;

    public function __construct()
    {
        $this->rootPath = $_SERVER["DOCUMENT_ROOT"].APP_BASE_PATH;
        $this->storagePath = '/public/storages';
    }

    public function upload(array $file, ?string $subpath = null): string
    {
        // Validação básica do arquivo
        if (!isset($file['tmp_name'], $file['name']) or $file['error'] !== UPLOAD_ERR_OK) {
            throw new \Exception('Erro no upload do arquivo.');
        }

        // Definindo os subdiretórios ano/mês/dia
        $subDirectory = date('Y').'/'.date('m').'/'.date('d');
        if (!empty($subpath)) {
            $subDirectory = $subpath.'/'.$subDirectory;
        }
        $destinationDir = $this->storagePath.'/'.$subDirectory;

        // Criar diretórios caso não existam
        if (!is_dir($this->rootPath.$destinationDir) and !mkdir($this->rootPath.$destinationDir, 0777, true) and !is_dir($this->rootPath.$destinationDir)) {
            throw new \Exception('Não foi possível criar o diretório de destino.');
        }

        // Definindo o caminho completo do arquivo
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = time().'.'.$fileExtension;
        $destinationPath = $destinationDir.'/'.$fileName;

        // Movendo o arquivo para o destino final
        if (!move_uploaded_file($file['tmp_name'], $this->rootPath.$destinationPath)) {
            throw new \Exception('Erro ao mover o arquivo para o destino.');
        }

        return $destinationPath;
    }

    public function destroy(string $filePath): bool
    {
        // Verifica se o arquivo existe e tenta excluí-lo
        if (!file_exists($this->rootPath.$filePath)) {
            throw new \Exception('Arquivo não encontrado.');
        }

        // Destroi o arquivo
        if (!unlink($this->rootPath.$filePath)) {
            throw new \Exception('Erro ao excluir o arquivo.');
        }

        return true;
    }
}