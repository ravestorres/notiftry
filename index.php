<?php
  ob_start();
  require_once('includes/load.php');
  if ($session->isUserLoggedIn(true)) { redirect('home.php', false); }
?>
<?php include_once('layouts/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="libs/css/index.css">
</head>
<body>
    <div class="container">
        <table>
            <!-- Logo Section -->
            <tr>
                <td>
                    <img src="libs/images/0.png" alt="Logo" class="img-fluid" style="max-width: 150px;">
                    <h2>StockTrack</h2>
                </td>
            </tr>
            <!-- Login Panel -->
            <tr>
                <td>
                    <h1>Login Panel</h1>
                    <h4>Inventory Management System</h4>
                    <?php echo display_msg($msg); ?>
                </td>
            </tr>
            <!-- Login Form -->
            <tr>
                <td>
                    <form method="post" action="auth.php" class="form-container">
                        <table style="width: 100%; border: none;">
                            <tr>
                                <td style="text-align: left;">
                                    <label for="username" class="control-label">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">
                                    <label for="password" class="control-label">Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <br><button type="submit" class="btn btn-success" style="border-radius:50px; width: 100%;">Login</button><br>
                                </td>
                            </tr>
                        </table>
                        <br>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>

<?php include_once('layouts/footer.php'); ?>
