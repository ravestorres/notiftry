<?php
$page_title = 'Sale Report';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(3);
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
        <div class="card-header">
          <h5>Generate Sale Report</h5>
        </div>
        <div class="card-body">
          <form method="post" action="sale_report_process.php">
            <!-- Date Range Section -->
            <div class="mb-3">
              <label for="start-date" class="form-label">Date Range</label>
              <div class="input-group">
                <input type="text" class="form-control datepicker" id="start-date" name="start-date" placeholder="From">
                <span class="input-group-text"><i class="bi bi-arrow-right-circle"></i></span>
                <input type="text" class="form-control datepicker" id="end-date" name="end-date" placeholder="To">
              </div>
            </div>
            <!-- Submit Button -->
            <div class="mb-3">
              <button type="submit" name="submit" class="btn btn-primary">Generate Report</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('layouts/footer.php'); ?>

<!-- Initialize Flatpickr -->
<script>
  flatpickr("#start-date", {
    dateFormat: "Y-m-d",
  });
  flatpickr("#end-date", {
    dateFormat: "Y-m-d",
  });
</script>
