<?php

namespace CRUD\Helper;

use Exception;
use PDO;
use PDOException;

class DBConnector
{

    /** @var mixed $db */
    private $db;


    private $connection;

    public function __construct()
    {
        $this->db="CURD";
    }

    /**
     * @return void
     */
    public function connect(): void
    {
        $servername ="localhost";
        $username = "asa";
        $password = "123456";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$this->db", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection=$conn;

        } catch(PDOException $e) {

            echo "<h3>Connection failed: </h3>" . $e->getMessage();
//            print_r( $e );
        }
        echo "connected";
    }

    /**
     * @param string $query
     * @return bool
     */
    public function execQuery(string $query) : bool
    {
        try {
            $this->connection->exec($query);
        } catch(PDOException $e) {
            echo "not found"."<br>" ;
            return false;
        }
        return true;
    }

    /**
     * @param string $message
     * @throws Exception
     * @return void
     */
    private function exceptionHandler(string $message): void
    {
        echo  $message();
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return mixed
     */
    public function getDb()
    {
        return $this->db;
    }


}