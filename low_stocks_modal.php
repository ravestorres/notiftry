<?php
require_once('includes/config.php'); // Include database connection

$threshold = 250; // Define the stock threshold
$sql = "SELECT name, quantity FROM products WHERE quantity < ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $threshold);
$stmt->execute();
$result = $stmt->get_result();
?>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Product Name</th>
      <th>Quantity Left</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($row['name']); ?></td>
        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>
