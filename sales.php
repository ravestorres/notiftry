<?php
  $page_title = 'All sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);


  $sales = find_all_sale(); // Assuming this function fetches the sales data
?>
<?php include_once('layouts/header.php'); ?>
<div class="container mt-4">
  <div class="row">
    <div class="col-12">
      <?php echo display_msg($msg); ?>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5><span class="bi bi-box"></span> All Sales</h5>
          <a href="add_sale.php" class="btn btn-primary">Add sale</a>
        </div>

        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th>Product name</th>
                <th class="text-center" style="width: 15%;">Quantity</th>
                <th class="text-center" style="width: 15%;">Total</th>
                <th class="text-center" style="width: 15%;">Date</th>
                <th class="text-center" style="width: 100px;">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $counter = 1; // Initialize counter for row numbers
                foreach ($sales as $sale): 
              ?>
                <tr>
                  <td class="text-center"><?php echo $counter++; ?></td> <!-- Increment counter for each row -->
                  <td><?php echo remove_junk($sale['name']); ?></td>
                  <td class="text-center"><?php echo (int)$sale['qty']; ?></td>
                  <td class="text-center"><?php echo remove_junk($sale['price']); ?></td>
                  <td class="text-center"><?php echo $sale['date']; ?></td>
                  <td class="text-center">
                    <div class="btn-group">
                      <a href="edit_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-warning btn-sm" title="Edit">
                        <span class="bi bi-pencil"></span>
                      </a>
                      <a href="delete_sale.php?id=<?php echo (int)$sale['id']; ?>" class="btn btn-danger btn-sm" title="Delete">
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
</div>
<?php include_once('layouts/footer.php'); ?>
