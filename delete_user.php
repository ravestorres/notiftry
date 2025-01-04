<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>

<?php
  if(isset($_GET['id'])){
      $user_id = (int)$_GET['id'];
      $user = find_by_id('users', $user_id);
      if(!$user){
          $session->msg("d","User not found.");
          redirect('users.php');
      }
  } else {
      $session->msg("d","Missing user id.");
      redirect('users.php');
  }
?>

<!-- Modal for confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this user? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <a href="delete_user.php?id=<?php echo $user_id; ?>" class="btn btn-danger">Delete User</a>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/header.php'); ?>

<!-- Display session messages -->
<?php echo display_msg($msg); ?>

<!-- Show the modal when the page loads -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#deleteModal').modal('show');
  });
</script>

<?php include_once('layouts/footer.php'); ?>
