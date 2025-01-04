<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('categories')
?>
<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
   validate_fields($req_field);
   $cat_name = remove_junk($db->escape($_POST['categorie-name']));
   if(empty($errors)){
      $sql  = "INSERT INTO categories (name)";
      $sql .= " VALUES ('{$cat_name}')";
      if($db->query($sql)){
        $session->msg("s", "Successfully Added New Category");
        redirect('categorie.php',false);
      } else {
        $session->msg("d", "Sorry Failed to insert.");
        redirect('categorie.php',false);
      }
   } else {
     $session->msg("d", $errors);
     redirect('categorie.php',false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<br>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <strong>
          <span class="bi bi-plus-circle"></span>
          Add New Category
        </strong>
      </div>
      <div class="card-body">
        <form method="post" action="categorie.php">
          <div class="mb-3">
              <input type="text" class="form-control" name="categorie-name" placeholder="Category Name">
          </div>
          <button type="submit" name="add_cat" class="btn btn-primary">Add Category</button>
        </form>
      </div>
    </div>
  </div>
  
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <strong>
          <span class="bi bi-list-ul"></span>
          All Categories
        </strong>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th>Categories</th>
              <th class="text-center" style="width: 100px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($all_categories as $cat):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td><?php echo remove_junk(ucfirst($cat['name'])); ?></td>
                <td class="text-center">
                  <div class="btn-group">
                    <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit">
                      <span class="bi bi-pencil-square"></span>
                    </a>
                    <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Remove">
                      <span class="bi bi-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
