<?php
  require_once('includes/load.php');
  page_require_level(3);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Get form data
      $s_id = (int)$_POST['s_id'];
      $quantity = (int)$_POST['quantity'];
      $price = (float)$_POST['price'];
      $total = (float)$_POST['total'];
      $date = $_POST['date'];

      // Insert the sale into the database
      $sql = "INSERT INTO sales (product_id, qty, price, date) ";
      $sql .= "VALUES ('{$s_id}', '{$quantity}', '{$total}', '{$date}')";

      if ($db->query($sql)) {
          // Update product quantity if sale is successful
          update_product_qty($quantity, $s_id);
          echo json_encode(['success' => true]);
      } else {
          echo json_encode(['success' => false, 'error' => 'Failed to add sale']);
      }
  }
?>
