<?php
if (isset($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']);
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $query = "SELECT * FROM products WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(str_repeat('i', count($ids)), ...$ids);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h1>Low Stock Products</h1>";
    while ($row = $result->fetch_assoc()) {
        echo "<p>{$row['name']} - Only {$row['quantity']} left!</p>";
    }
}
?>
