<?php
require_once('includes/config.php'); // Include database connection

$threshold = 250; // Define the stock threshold
$sql = "SELECT name, quantity FROM products WHERE quantity < ?";
$stmt = $db->prepare($sql);
$stmt->bind_param('i', $threshold);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Low Stock Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="mb-4">Low Stock Products</h1>
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
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
