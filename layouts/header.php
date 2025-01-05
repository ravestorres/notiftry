<?php $user = current_user(); ?>
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
    #notification-icon {
      position: relative;
      margin-right: 15px; /* Space between notification and profile */
    }
    #notification-count {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: red;
      color: white;
      padding: 5px;
      border-radius: 50%;
      font-size: 12px;
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
        
        <!-- Notification icon moved to the left -->
        <div class="navbar-left">
  <a id="notification-icon" class="btn btn-outline-info">
    <span class="bi bi-bell"></span>
    <span id="notification-count" class="badge badge-danger" style="display: none;">1</span>
  </a>
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

  <script>
    // Update notification count (this is just an example, replace with actual logic)
    document.addEventListener("DOMContentLoaded", function() {
      const notificationCount = document.getElementById('notification-count');
      const notifications = 3; // Example value, replace with actual notification count

      if (notifications > 0) {
        notificationCount.textContent = notifications;
        notificationCount.style.display = 'inline-block';
      }
    });
  </script>
</body>
</html>
