<?php
include_once("DBManager.php");
class RFIDManager extends DBManager{
    private $TBL_Transactions;
    public function __construct($tbl = "rfid_transactions"){
        parent::__construct();
        $this->TBL_Transactions = $tbl;
        $sql = "CREATE TABLE IF NOT EXISTS" . $this->TBL_Transactions . "(
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              customer TEXT NOT NULL,
              initial_balance TEXT NOT NULL,
              transport_fare TEXT NOT NULL,
              new_balance TEXT NOT NULL,
              timestamp TEXT NOT NULL
            );";
        $q = $this->con->prepare($sql);
            $q->execute();
    }
    public function getTableName(){
        return $this->TBL_Transactions;
    }
    public function saveTransaction($customer, $initial_balance, $transport_fare, $timestamp){
        $new_balance = $initial_balance - $transport_fare;
        $sql = "INSERT INTO " .$this->TBL_Transactions . "
                (customer, initial_balance, transport_fare, new_balance, timestamp) 
                VALUES (:customer, :initial_balance, :transport_fare, :new_balance, :timestamp)"; 
        $q = $this->con->prepare($sql);
        $q->bindValue(":customer", $customer);
        $q->bindValue("initial_balance", $initial_balance);
        $q->bindValue(":transport_fare", $transport_fare);
        $q->bindValue(":new_balance", $new_balance);
        $q->bindValue(":timestamp", $timestamp);
        if($q->execute()){
            echo "Transaction uploaded successfully!";
        }else{
            echo "Failed to save transaction.";
        }
    }
}
?>