<?php $user = current_user();
$low_stock_count = count_low_stock_items(5); // Get the number of items with stock less than 5$low_stock_count = count_low_stock_items(5); // Get the number of items with stock less than 5


include 'config.php';
$threshold = 10; // Set your threshold for low stock
$query = "SELECT * FROM products WHERE quantity < ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $threshold);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any products with low stock
$lowStockProducts = [];
while ($row = $result->fetch_assoc()) {
    $lowStockProducts[] = $row;


    
}
?>

<!-- Loop through products with low stock -->
<?php foreach ($lowStockProducts as $product): ?>
    <div id="product-<?php echo $product['id']; ?>" class="product-item">
        <h3><?php echo $product['name']; ?></h3>
        <p>Stock: <?php echo $product['quantity']; ?></p>
    </div>
<?php endforeach; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Inventory Management System</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="libs/css/main.css" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .logo img {
      height: 80px; /* Larger size */
    }
    .header-content {
      display: flex;
      justify-content: space-between;
      width: 100%;
      align-items: center;
    }
    .navbar-right {
      display: flex;
      align-items: center;
    }
    #notification-bar {
      display: flex;
      align-items: center;
      margin-right: 15px;
      position: relative;
    }
    #notification-icon {
      margin-right: 15px; /* Space between notification and profile */
      font-size: 1.5rem;
    }
    #notification-count {
  position: absolute;
  top: -5px;
  right: -5px;
  background-color: red;
  color: white;
  padding: 3px 6px; /* Smaller padding */
  border-radius: 50%;
  font-size: 10px; /* Smaller font size */
}

#notification-count:empty {
  display: none; /* Hide the notification if count is 0 */

}
  .product-item {
    padding: 10px;
    margin: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

.product-item:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}


  </style>
</head>
<body>
  <?php if ($session->isUserLoggedIn(true)): ?>
    <header id="header" class="d-flex justify-content-between align-items-center px-3">
      <div class="logo">
        <img src="libs/images/0.png" alt="Logo">
      </div>
      <div class="header-content">
        <div class="header-date">
          <strong><?php echo date("F j, Y, g:i a"); ?></strong>
        </div>

  <!-- Notification bar -->
  <div id="notification-bar" class="navbar-right">
      <i id="notification-icon" class="bi bi-bell"></i>
      <span id="notification-count"><?php echo $low_stock_count; ?></span> <!-- Show low stock count -->
    </div>
        <!-- Profile dropdown remains on the right -->
        <div class="dropdown ms-auto">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="uploads/users/<?php echo $user['image']; ?>" alt="user-image" class="img-circle img-inline" style="width: 30px; height: 30px;">
            <?php echo remove_junk(ucfirst($user['name'])); ?>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="profile.php?id=<?php echo (int)$user['id']; ?>"><i class="bi bi-person"></i> Profile</a></li>
            <li><a class="dropdown-item" href="edit_account.php" title="edit account"><i class="bi bi-gear"></i> Settings</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="bi bi-power"></i> Logout</a></li>
          </ul>
        </div>
      </div>
    </header>

    <div class="sidebar">
      <?php if ($user['user_level'] === '1'): ?>
        <!-- Admin menu -->
        <?php include_once('admin_menu.php'); ?>
      <?php elseif ($user['user_level'] === '2'): ?>
        <!-- Special user menu -->
        <?php include_once('special_menu.php'); ?>
      <?php elseif ($user['user_level'] === '3'): ?>
        <!-- Regular user menu -->
        <?php include_once('user_menu.php'); ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

  <div class="page">
    <div class="container-fluid">
      <!-- Page Content -->
    </div>
  </div>
</body>
</html>
