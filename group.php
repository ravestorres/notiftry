<?php
  $page_title = 'All Group';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  $all_groups = find_all('user_groups');
?>
<?php include_once('layouts/header.php'); ?>
<br>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <strong>Groups</strong>
        <a href="add_group.php" class="btn btn-info btn-sm">Add New Group</a>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Group Name</th>
              <th class="text-center" style="width: 20%;">Group Level</th>
              <th class="text-center" style="width: 15%;">Status</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($all_groups as $a_group): ?>
            <tr>
             <td class="text-center"><?php echo count_id();?></td>
             <td><?php echo remove_junk(ucwords($a_group['group_name']))?></td>
             <td class="text-center">
               <?php echo remove_junk(ucwords($a_group['group_level']))?>
             </td>
             <td class="text-center">
               <?php if($a_group['group_status'] === '1'): ?>
                <span class="badge bg-success"><?php echo "Active"; ?></span>
              <?php else: ?>
                <span class="badge bg-danger"><?php echo "Deactive"; ?></span>
              <?php endif; ?>
             </td>
             <td class="text-center">
               <div class="btn-group" role="group">
                  <!-- Edit Button -->
                  <a href="edit_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-warning btn-sm" title="Edit">
                    <i class="bi bi-pencil-square"></i> Edit
                  </a>
                  <!-- Delete Button -->
                  <a href="delete_group.php?id=<?php echo (int)$a_group['id'];?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to delete this group?');">
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
