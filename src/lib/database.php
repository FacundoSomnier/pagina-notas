<?php

namespace Facundo\Notas\lib;

use PDO;
use PDOException;

class Database {
    private string $host;
    private string $db;
    private string $user;
    private string $password;
    private string $charset;


    public function __construct(){
        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASSWORD');
        $this->charset = 'utf8mb4';
        $this->port = getenv('DB_PORT');
    }

    public function connect () {
        try {
            $connection = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}; port={$this->port}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $pdo = new PDO($connection, $this->user, $this->password, $options);
            return $pdo;
        } catch (PDOException $th) {
            throw $th;
        }
    }

}
