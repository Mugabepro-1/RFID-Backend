<?php
class DBManager{
    private $db_file = "database.sqlite";
    protected $con;
    public function __construct(){
        try{
            $this->con = new PDO("sqlite:" . $this->db_file);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $error){
            echo "Connection failed" . $error->getMessage();
        }
    }
    public function getConnection(){
        return $this->con;
    }
}
?>
