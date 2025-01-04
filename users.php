<?php
  $page_title = 'All User';
  require_once('includes/load.php');
?>
<?php
// Checkin What level user has permission to view this page
page_require_level(1);
// Pull out all users from the database
$all_users = find_all_user();
?>
<?php include_once('layouts/header.php'); ?>
<br>
<div class="row">
   <div class="col-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <strong>Users</strong>
        <a href="add_user.php" class="btn btn-info btn-sm">Add New User</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Name</th>
              <th>Username</th>
              <th class="text-center" style="width: 15%;">User Role</th>
              <th class="text-center" style="width: 10%;">Status</th>
              <th style="width: 20%;">Last Login</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($all_users as $a_user): ?>
            <tr>
             <td class="text-center"><?php echo count_id();?></td>
             <td><?php echo remove_junk(ucwords($a_user['name']))?></td>
             <td><?php echo remove_junk(ucwords($a_user['username']))?></td>
             <td class="text-center"><?php echo remove_junk(ucwords($a_user['group_name']))?></td>
             <td class="text-center">
               <?php if($a_user['status'] === '1'): ?>
                <span class="badge bg-success"><?php echo "Active"; ?></span>
              <?php else: ?>
                <span class="badge bg-danger"><?php echo "Deactive"; ?></span>
              <?php endif; ?>
             </td>
             <td><?php echo read_date($a_user['last_login'])?></td>
             <td class="text-center">
               <div class="btn-group" role="group">
                  <!-- Edit Button -->
                  <a href="edit_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-warning btn-sm" title="Edit">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <!-- Delete Button -->
                  <a href="delete_user.php?id=<?php echo (int)$a_user['id'];?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this user?');">
                    <i class="bi bi-trash"></i> Delete
                  </a>
               </div>
             </td>
            </tr>
          <?php endforeach;?>
         </tbody>
       </table>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
