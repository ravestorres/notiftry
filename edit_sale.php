<?php
  $page_title = 'Edit sale';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(3);
?>
<?php
$sale = find_by_id('sales', (int)$_GET['id']);
if(!$sale){
  $session->msg("d", "Missing product id.");
  redirect('sales.php');
}
?>
<?php $product = find_by_id('products', $sale['product_id']); ?>
<?php

  if(isset($_POST['update_sale'])){
    $req_fields = array('title', 'quantity', 'price', 'total', 'date');
    validate_fields($req_fields);
        if(empty($errors)){
          $p_id      = $db->escape((int)$product['id']);
          $s_qty     = $db->escape((int)$_POST['quantity']);
          $s_total   = $db->escape($_POST['total']);
          $date      = $db->escape($_POST['date']);
          $s_date    = date("Y-m-d", strtotime($date));

          $sql  = "UPDATE sales SET";
          $sql .= " product_id= '{$p_id}', qty={$s_qty}, price='{$s_total}', date='{$s_date}'";
          $sql .= " WHERE id ='{$sale['id']}'";
          $result = $db->query($sql);
          if( $result && $db->affected_rows() === 1){
                    update_product_qty($s_qty, $p_id);
                    $session->msg('s', "Sale updated.");
                    redirect('edit_sale.php?id=' . $sale['id'], false);
                  } else {
                    $session->msg('d', ' Sorry failed to update!');
                    redirect('sales.php', false);
                  }
        } else {
           $session->msg("d", $errors);
           redirect('edit_sale.php?id=' . (int)$sale['id'], false);
        }
  }

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
          <h5>Edit Sale</h5>
          <a href="sales.php" class="btn btn-primary btn-sm">Show all sales</a>
        </div>
        
        <div class="card-body">
          <form method="post" action="edit_sale.php?id=<?php echo (int)$sale['id']; ?>">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Product title</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="product_info">
                <tr>
                  <td>
                    <input type="text" class="form-control" name="title" value="<?php echo remove_junk($product['name']); ?>">
                  </td>
                  <td>
                    <input type="number" class="form-control" name="quantity" value="<?php echo (int)$sale['qty']; ?>" min="1">
                  </td>
                  <td>
                    <input type="text" class="form-control" name="price" value="<?php echo remove_junk($product['sale_price']); ?>" >
                  </td>
                  <td>
                    <input type="text" class="form-control" name="total" value="<?php echo remove_junk($sale['price']); ?>">
                  </td>
                  <td>
                    <input type="date" class="form-control" name="date" value="<?php echo remove_junk($sale['date']); ?>">
                  </td>
                  <td>
                    <button type="submit" name="update_sale" class="btn btn-primary btn-sm">Update sale</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>
