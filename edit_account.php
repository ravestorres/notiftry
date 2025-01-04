<?php
  $page_title = 'Edit Account';
  require_once('includes/load.php');
  page_require_level(3);
?>

<?php
  // Update user image
  if(isset($_POST['submit'])) {
    $photo = new Media();
    $user_id = (int)$_POST['user_id'];

    // Check if the uploaded file is an image
    if ($_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
      $file_tmp = $_FILES['file_upload']['tmp_name'];
      $file_info = getimagesize($file_tmp);
      if ($file_info !== false) {  // File is an image
        $photo->upload($_FILES['file_upload']);
        if($photo->process_user($user_id)){
          $session->msg('s','Photo has been uploaded.');
          redirect('edit_account.php');
        } else {
          $session->msg('d',join($photo->errors));
          redirect('edit_account.php');
        }
      } else {
        $session->msg('d','Please upload a valid image file.');
        redirect('edit_account.php');
      }
    } else {
      $session->msg('d','Error uploading file.');
      redirect('edit_account.php');
    }
  }
?>

<?php
  // Update user other info
  if(isset($_POST['update'])){
    $req_fields = array('name','username');
    validate_fields($req_fields);
    if(empty($errors)){
      $id = (int)$_SESSION['user_id'];
      $name = remove_junk($db->escape($_POST['name']));
      $username = remove_junk($db->escape($_POST['username']));
      $sql = "UPDATE users SET name ='{$name}', username ='{$username}' WHERE id='{$id}'";
      $result = $db->query($sql);
      if($result && $db->affected_rows() === 1){
        $session->msg('s',"Account updated");
        redirect('edit_account.php', false);
      } else {
        $session->msg('d',' Sorry, failed to update!');
        redirect('edit_account.php', false);
      }
    } else {
      $session->msg("d", $errors);
      redirect('edit_account.php', false);
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <?php echo display_msg($msg); ?>
    </div>
    <!-- Profile Image Update -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-warning text-white">
          <i class="bi bi-camera"></i> Change My Photo
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <img class="img-fluid rounded-circle" src="uploads/users/<?php echo $user['image'];?>" alt="" style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <div class="col-md-8">
              <form action="edit_account.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                
                  <input type="file" name="file_upload" class="form-control" accept="image/*" />
                </div>
                <input type="hidden" name="user_id" value="<?php echo $user['id'];?>">
                <button type="submit" name="submit" class="btn btn-warning">Change</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Account Info Update -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-header bg-info text-white">
          <i class="bi bi-pencil-square"></i> Edit My Account
        </div>
        <div class="card-body">
          <form method="post" action="edit_account.php?id=<?php echo (int)$user['id'];?>" class="clearfix">
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control" name="name" value="<?php echo remove_junk(ucwords($user['name'])); ?>">
            </div>
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" value="<?php echo remove_junk(ucwords($user['username'])); ?>">
            </div>
            <div class="d-flex justify-content-between">
              <a href="change_password.php" title="Change password" class="btn btn-danger">Change Password</a>
              <button type="submit" name="update" class="btn btn-info">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
