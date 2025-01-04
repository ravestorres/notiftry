<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $products = join_product_table();
  $low_stock_threshold = 5;  // Define the low stock threshold
?>
<?php include_once('layouts/header.php'); ?>
<br>
  <div class="row">
     <div class="col-12">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between">
          <strong>Products</strong>
          <a href="add_product.php" class="btn btn-primary btn-sm">Add New</a>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center" style="width: 50px;">#</th>
                <th> Photo</th>
                <th> Product Title </th>
                <th class="text-center" style="width: 10%;"> Categories </th>
                <th class="text-center" style="width: 10%;"> In-Stock </th>
                <th class="text-center" style="width: 10%;"> Buying Price </th>
                <th class="text-center" style="width: 10%;"> Selling Price </th>
                <th class="text-center" style="width: 10%;"> Product Added </th>
                <th class="text-center" style="width: 100px;"> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr <?php if($product['quantity'] <= $low_stock_threshold): ?> class="table-warning" <?php endif; ?>>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-fluid img-thumbnail rounded-circle" src="uploads/products/no_image.png" alt="Product Image">
                  <?php else: ?>
                  <img class="img-fluid img-thumbnail rounded-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="Product Image">
                <?php endif; ?>
                </td>
                <td> <?php echo remove_junk($product['name']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                <td class="text-center"> 
                  <?php echo remove_junk($product['quantity']); ?>
                  <?php if($product['quantity'] <= $low_stock_threshold): ?>
                    <span class="badge bg-danger">Low Stock!</span>
                  <?php endif; ?>
                </td>
                <td class="text-center"> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center"> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center">
                  <div class="btn-group" role="group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-warning btn-sm"  title="Edit">
                      <i class="bi bi-pencil-square"></i> Edit
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-sm"  title="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
                      <i class="bi bi-trash"></i> Delete
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
