<?php
require_once('includes/load.php'); // Include database connection
header('Content-Type: application/json');

$threshold = 20; // Define the stock threshold
$count = count_low_stock_items($threshold);

echo json_encode(['count' => $count]);
?>
