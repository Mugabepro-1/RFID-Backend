<?php
include_once("RFIDManager.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer = $_POST['customer'] ?? '';
    $initial_balance = $_POST['initial_balance'] ?? 0;
    $transport_fare = $_POST['transport_fare'] ?? 0;
    $timestamp = date("Y-m-d H:i:s"); 
    if (!empty($customer) && is_numeric($initial_balance) && is_numeric($transport_fare)) {
        $rfidManager = new RFIDManager();
        $rfidManager->saveTransaction($customer, $initial_balance, $transport_fare, $timestamp);
        echo "Transaction uploaded successfully!";
    } else {
        echo "Invalid input data. Please check and try again.";
    }
} else {
    echo "Invalid request method.";
}
?>