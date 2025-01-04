<?php
  $page_title = 'Change Password';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php $user = current_user(); ?>
<?php
  if(isset($_POST['update'])){
    $req_fields = array('new-password','old-password','id');
    validate_fields($req_fields);

    if(empty($errors)){
      if(sha1($_POST['old-password']) !== current_user()['password']){
        $session->msg('d', "Your old password does not match.");
        redirect('change_password.php', false);
      }

      $id = (int)$_POST['id'];
      $new = remove_junk($db->escape(sha1($_POST['new-password'])));
      $sql = "UPDATE users SET password ='{$new}' WHERE id='{$db->escape($id)}'";
      $result = $db->query($sql);
      if($result && $db->affected_rows() === 1):
        $session->logout();
        $session->msg('s', "Login with your new password.");
        redirect('index.php', false);
      else:
        $session->msg('d', 'Sorry, failed to update!');
        redirect('change_password.php', false);
      endif;
    } else {
      $session->msg("d", $errors);
      redirect('change_password.php', false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>

<div class="container mt-4">
  <div class="text-center mb-4">
    <h3>Change Your Password</h3>
  </div>
  
  <?php echo display_msg($msg); ?>

  <form method="post" action="change_password.php" class="clearfix">
    <div class="mb-3">
      <label for="newPassword" class="form-label">New Password</label>
      <input type="password" class="form-control" name="new-password" placeholder="New password" required>
    </div>
    <div class="mb-3">
      <label for="oldPassword" class="form-label">Old Password</label>
      <input type="password" class="form-control" name="old-password" placeholder="Old password" required>
    </div>
    <input type="hidden" name="id" value="<?php echo (int)$user['id'];?>">
    <div class="d-flex justify-content-between">
      <button type="submit" name="update" class="btn btn-info">Change Password</button>
    </div>
  </form>
</div>

<?php include_once('layouts/footer.php'); ?>
