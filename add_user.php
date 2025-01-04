<?php
  $page_title = 'Add User';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $groups = find_all('user_groups');
?>

<?php
  if(isset($_POST['add_user'])){

   $req_fields = array('full-name','username','password','level' );
   validate_fields($req_fields);

   if(empty($errors)){
           $name   = remove_junk($db->escape($_POST['full-name']));
       $username   = remove_junk($db->escape($_POST['username']));
       $password   = remove_junk($db->escape($_POST['password']));
       $user_level = (int)$db->escape($_POST['level']);
       $password = sha1($password);
        $query = "INSERT INTO users (";
        $query .="name, username, password, user_level, status";
        $query .=") VALUES (";
        $query .=" '{$name}', '{$username}', '{$password}', '{$user_level}', '1'";
        $query .=")";
        if($db->query($query)){
          // Success
          $session->msg('s', "User account has been created!");
          redirect('add_user.php', false);
        } else {
          // Failed
          $session->msg('d', 'Sorry, failed to create account!');
          redirect('add_user.php', false);
        }
   } else {
     $session->msg("d", $errors);
      redirect('add_user.php', false);
   }
 }
?>

<?php include_once('layouts/header.php'); ?>
<div class="container mt-4">
    <?php echo display_msg($msg); ?>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Add New User</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="add_user.php">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full-name" placeholder="Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">User Role</label>
                            <select class="form-select" name="level" required>
                                <?php foreach ($groups as $group): ?>
                                    <option value="<?php echo $group['group_level']; ?>"><?php echo ucwords($group['group_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 clearfix">
                            <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>
