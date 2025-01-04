<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<br>
<?php
$product = find_by_id('products', (int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if (!$product) {
  $session->msg("d", "Missing product id.");
  redirect('product.php');
}
?>
<?php
if (isset($_POST['product'])) {
  $req_fields = array('product-title', 'product-categorie', 'product-quantity', 'buying-price', 'saleing-price');
  validate_fields($req_fields);

  if (empty($errors)) {
    $p_name = remove_junk($db->escape($_POST['product-title']));
    $p_cat = (int)$_POST['product-categorie'];
    $p_qty = remove_junk($db->escape($_POST['product-quantity']));
    $p_buy = remove_junk($db->escape($_POST['buying-price']));
    $p_sale = remove_junk($db->escape($_POST['saleing-price']));
    if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }
    $query = "UPDATE products SET";
    $query .= " name ='{$p_name}', quantity ='{$p_qty}',";
    $query .= " buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}', media_id='{$media_id}'";
    $query .= " WHERE id ='{$product['id']}'";
    $result = $db->query($query);
    if ($result && $db->affected_rows() === 1) {
      $session->msg('s', "Product updated ");
      redirect('product.php', false);
    } else {
      $session->msg('d', ' Sorry failed to update!');
      redirect('edit_product.php?id=' . $product['id'], false);
    }
  } else {
    $session->msg("d", $errors);
    redirect('edit_product.php?id=' . $product['id'], false);
  }
}
?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <div class="col-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>

<div class="row">
  <div class="col-md-7">
    <div class="card">
      <div class="card-header">
        <strong>Edit Product</strong>
      </div>
      <div class="card-body">
        <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
          <div class="mb-3">
            <label for="product-title" class="form-label">Product Title</label>
            <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="product-categorie" class="form-label">Category</label>
            <select class="form-select" name="product-categorie" required>
              <option value="">Select a category</option>
              <?php foreach ($all_categories as $cat): ?>
                <option value="<?php echo (int)$cat['id']; ?>" <?php if ($product['categorie_id'] === $cat['id']) : echo "selected"; endif; ?>>
                  <?php echo remove_junk($cat['name']); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="product-photo" class="form-label">Product Image</label>
            <select class="form-select" name="product-photo">
              <option value="">No image</option>
              <?php foreach ($all_photo as $photo): ?>
                <option value="<?php echo (int)$photo['id']; ?>" <?php if ($product['media_id'] === $photo['id']) : echo "selected"; endif; ?>>
                  <?php echo $photo['file_name']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3 row">
            <div class="col-md-4">
              <label for="product-quantity" class="form-label">Quantity</label>
              <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>" required>
            </div>
            <div class="col-md-4">
              <label for="buying-price" class="form-label">Buying Price</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($product['buy_price']); ?>" required>
              </div>
            </div>
            <div class="col-md-4">
              <label for="saleing-price" class="form-label">Selling Price</label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']); ?>" required>
              </div>
            </div>
          </div>
          <button type="submit" name="product" class="btn btn-primary">Update Product</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
