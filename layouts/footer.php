</div>
  </div>

  <!-- Include Bootstrap 5 JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <!-- Optional: Include Bootstrap 5 datepicker JS (ensure compatibility) -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

  <!-- Your custom JS -->
  <script type="text/javascript" src="libs/js/functions.js"></script>
</body>
</html>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        <?php foreach ($lowStockProducts as $product): ?>
            const productId = <?php echo $product['id']; ?>;
            const productName = '<?php echo $product['name']; ?>';
            const stockQty = <?php echo $product['quantity']; ?>;
            
            // Add event listener for product click
            document.getElementById('product-<?php echo $product['id']; ?>').addEventListener('click', function() {
                if (stockQty < <?php echo $threshold; ?>) {
                    alert('The product "' + productName + '" is low on stock: Only ' + stockQty + ' left!');
                }
            });
        <?php endforeach; ?>
    });
</script>

<?php if (isset($db)) { $db->db_disconnect(); } ?>
