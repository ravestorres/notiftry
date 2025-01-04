<?php
  $page_title = 'My Profile';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
  $user_id = (int)$_GET['id'];
  if(empty($user_id)):
    redirect('home.php', false);
  else:
    $user_p = find_by_id('users', $user_id);
  endif;
?>
<?php include_once('layouts/header.php'); ?>

<div class="container mt-4">
  <div class="row">
    <div class="col-lg-4">
      <div class="card profile">
        <div class="card-body text-center bg-danger text-white">
          <img class="img-fluid rounded-circle mb-3" src="uploads/users/<?php echo $user_p['image'];?>" alt="" style="width: 150px; height: 150px; object-fit: cover;">
          <h3><?php echo first_character($user_p['name']); ?></h3>
        </div>

        <?php if($user_p['id'] === $user['id']): ?>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="edit_account.php">
                <i class="bi bi-pencil-square"></i> Edit Profile
              </a>
            </li>
          </ul>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
