<?php
class Database{

    private $db = null;
    private $conn;
    private $pdo;

    private $dbhost = DB_HOST;
    private $dbuser = DB_USER;
    private $dbpass = DB_PASS;
    private $dbname = DB_NAME;


    public function __construct()
    {
        try {
            $dsn = "mysql:host={$this->dbhost};dbname={$this->dbname}";
            $this->conn = new PDO($dsn, $this->dbuser, $this->dbpass);
        } catch (PDOException $e){
            die('Database Exception: '.$e->getMessage());
        }

    }

    public function prepare($sql){
        try{
			
            $this->pdo = $this->conn->prepare($sql);
			
			return $this;
        }
         catch(PDOException $e){
            die('Database Exception: '.$e->getMessage());
        }
    }

   	
    public function execute(){
        return $this->pdo->execute();
    }

	public function resultSet(){
        $this->execute();
        return $this->pdo->fetchAll(PDO::FETCH_OBJ);
    }

    // da se dobije samo jedan red
    public function single(){
        $this->execute();
        return $this->pdo->fetch(PDO::FETCH_OBJ);
    }
  
}