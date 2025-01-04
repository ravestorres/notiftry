<?php
  $page_title = 'Admin Home Page';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
?>

<?php
  $c_categorie     = count_by_id('categories');
  $c_product       = count_by_id('products');
  $c_sale          = count_by_id('sales');
  $c_user          = count_by_id('users');
  $products_sold   = find_higest_saleing_product('10');
  $recent_products = find_recent_product_added('5');
  $recent_sales    = find_recent_sale_added('5');
?>
<?php include_once('layouts/header.php'); ?>
<br>
<div class="row">
   <div class="col-md-6">
     <?php echo display_msg($msg); ?>
   </div>
</div>

<div class="row">
  <a href="users.php" class="col-6 col-md-3 mb-3 text-decoration-none text-dark">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <i class="bi bi-person-circle fs-2 text-secondary"></i>
        <div class="text-end">
          <h2 class="mb-0"><?php echo $c_user['total']; ?></h2>
          <p class="text-muted mb-0">Users</p>
        </div>
      </div>
    </div>
  </a>

  <a href="categorie.php" class="col-6 col-md-3 mb-3 text-decoration-none text-dark">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <i class="bi bi-folder fs-2 text-danger"></i>
        <div class="text-end">
          <h2 class="mb-0"><?php echo $c_categorie['total']; ?></h2>
          <p class="text-muted mb-0">Categories</p>
        </div>
      </div>
    </div>
  </a>

  <a href="product.php" class="col-6 col-md-3 mb-3 text-decoration-none text-dark">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <i class="bi bi-cart4 fs-2 text-primary"></i>
        <div class="text-end">
          <h2 class="mb-0"><?php echo $c_product['total']; ?></h2>
          <p class="text-muted mb-0">Products</p>
        </div>
      </div>
    </div>
  </a>

  <a href="sales.php" class="col-6 col-md-3 mb-3 text-decoration-none text-dark">
    <div class="card shadow-sm">
      <div class="card-body d-flex justify-content-between align-items-center">
        <i class="bi bi-currency-peso fs-2 text-success"></i>
        <div class="text-end">
          <h2 class="mb-0">₱<?php echo number_format($c_sale['total'], 2); ?></h2>
          <p class="text-muted mb-0">Sales</p>
        </div>
      </div>
    </div>
  </a>

</div>

<div class="row">
  <div class="col-12 col-md-4 mb-3">
    <div class="card">
      <div class="card-header">
        <strong><i class="bi bi-cart4"></i> Highest Selling Products</strong>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-sm">
            <thead>
              <tr>
                <th>Title</th>
                <th>Total Sold</th>
                <th>Total Quantity</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products_sold as $product_sold): ?>
                <tr>
                  <td><?php echo remove_junk(first_character($product_sold['name'])); ?></td>
                  <td><?php echo (int)$product_sold['totalSold']; ?></td>
                  <td><?php echo (int)$product_sold['totalQty']; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4 mb-3">
    <div class="card">
      <div class="card-header">
        <strong><i class="bi bi-bar-chart-line"></i> Latest Sales</strong>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-sm">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Total Sale</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($recent_sales as $recent_sale): ?>
                <tr>
                  <td class="text-center"><?php echo count_id(); ?></td>
                  <td><a href="edit_sale.php?id=<?php echo (int)$recent_sale['id']; ?>"><?php echo remove_junk(first_character($recent_sale['name'])); ?></a></td>
                  <td><?php echo remove_junk(ucfirst($recent_sale['date'])); ?></td>
                  <td>₱<?php echo remove_junk(first_character($recent_sale['price'])); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-4 mb-3">
    <div class="card">
      <div class="card-header">
        <strong><i class="bi bi-box"></i> Recently Added Products</strong>
      </div>
      <div class="card-body">
        <div class="list-group">
          <?php foreach ($recent_products as $recent_product): ?>
            <a class="list-group-item d-flex justify-content-between align-items-center" href="edit_product.php?id=<?php echo (int)$recent_product['id']; ?>">
              <div>
                <?php if ($recent_product['media_id'] === '0'): ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $recent_product['image']; ?>" alt="">
                <?php endif; ?>
                <?php echo remove_junk(first_character($recent_product['name'])); ?>
              </div>
              <span class="badge bg-warning text-dark">₱<?php echo (int)$recent_product['sale_price']; ?></span>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
