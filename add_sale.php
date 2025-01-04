<?php
  $page_title = 'Add Sale';
  require_once('includes/load.php');
  page_require_level(3);
?>

<?php
  if (isset($_POST['add_sale'])) {
    // Required fields for sale
    $req_fields = array('s_id', 'quantity', 'price', 'total', 'date');
    validate_fields($req_fields);
    
    // If there are no validation errors
    if (empty($errors)) {
      // Escape user inputs
      $s_id      = $db->escape((int)$_POST['s_id']);
      $s_qty     = $db->escape((int)$_POST['quantity']);
      $s_total   = $db->escape($_POST['total']);
      $date      = $db->escape($_POST['date']);
      $s_date    = make_date(); // Get current date for sale

      // SQL query to insert sale record into the database
      $sql  = "INSERT INTO sales (product_id, qty, price, date) ";
      $sql .= "VALUES ('{$s_id}', '{$s_qty}', '{$s_total}', '{$s_date}')";

      if ($db->query($sql)) {
        update_product_qty($s_qty, $s_id); // Update product quantity
        $session->msg('s', "Sale added successfully.");
        redirect('add_sale.php', false); // Redirect to the same page
      } else {
        $session->msg('d', 'Sorry, failed to add the sale!');
        redirect('add_sale.php', false); // Redirect to the same page
      }
    } else {
      $session->msg("d", $errors);
      redirect('add_sale.php', false); // Redirect with error messages
    }
  }
?>

<?php include_once('layouts/header.php'); ?>

<div class="container mt-4">
  <div class="row">
    <div class="col-12">
      <?php echo display_msg($msg); ?>
      
      <!-- Product Search Form (AJAX) -->
      <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="input-group mb-3">
          <button type="submit" class="btn btn-primary">Find It</button>
          <input type="text" id="sug_input" class="form-control" name="title" placeholder="Search for product name">
        </div>
        <div id="result" class="list-group"></div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5>Add Sale</h5>
        </div>
        <div class="card-body">
          <!-- Main Sale Form -->
          <form method="post" action="add_sale.php">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="product_info">
                <!-- Product rows will be added here dynamically by JavaScript -->
              </tbody>
            </table>
            <button type="submit" name="add_sale" class="btn btn-success btn-sm">Add Sale</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<!-- Add your custom JS below -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

function suggestion() {
    $('#sug_input').keyup(function(e) {
        var formData = {
            'product_name' : $('input[name=title]').val()
        };

        if(formData['product_name'].length >= 1){
            // Process the form
            $.ajax({
                type        : 'POST',
                url         : 'ajax.php',
                data        : formData,
                dataType    : 'json',
                encode      : true
            })
            .done(function(data) {
                $('#result').html(data).fadeIn();
                $('#result li').click(function() {
                    $('#sug_input').val($(this).text());
                    $('#result').fadeOut(500);
                });

                $("#sug_input").blur(function(){
                    $("#result").fadeOut(500);
                });
            });
        } else {
            $("#result").hide();
        };

        e.preventDefault();
    });
}

$('#sug-form').submit(function(e) {
    var formData = {
        'p_name' : $('input[name=title]').val()
    };

    // Process the form
    $.ajax({
        type        : 'POST',
        url         : 'ajax.php',
        data        : formData,
        dataType    : 'json',
        encode      : true
    })
    .done(function(data) {
        $('#product_info').html(data).show();
        total();
        $('.datePicker').datepicker('update', new Date());
    }).fail(function() {
        $('#product_info').html(data).show();
    });

    e.preventDefault();
});

function total() {
    $('#product_info input').change(function(e) {
        var price = +$(this).closest('tr').find('input[name=price]').val() || 0;
        var qty   = +$(this).closest('tr').find('input[name=quantity]').val() || 0;
        var total = qty * price;
        $(this).closest('tr').find('input[name=total]').val(total.toFixed(2));
    });
}

$(document).ready(function() {
    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('.submenu-toggle').click(function () {
        $(this).parent().children('ul.submenu').toggle(200);
    });

    // Suggestion for finding product names
    suggestion();

    // Calculate total amount
    total();

    $('.datepicker')
       .datepicker({
           format: 'yyyy-mm-dd',
           todayHighlight: true,
           autoclose: true
       });
});
</script>
