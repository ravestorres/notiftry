<ul class="nav flex-column">
  <li class="nav-item">
    <a href="home.php" class="nav-link">
      <i class="bi bi-house-door"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item">
    <a href="#salesMenu" class="nav-link collapsed" data-bs-toggle="collapse" aria-expanded="false">
      <i class="bi bi-cart"></i>
      <span>Sales</span>
    </a>
    <ul class="collapse nav flex-column ms-3" id="salesMenu">
      <li><a href="sales.php" class="nav-link">Manage Sales</a></li>
      <li><a href="add_sale.php" class="nav-link">Add Sale</a></li>
    </ul>
  </li>
  <li class="nav-item">
    <a href="#salesReportMenu" class="nav-link collapsed" data-bs-toggle="collapse" aria-expanded="false">
      <i class="bi bi-bar-chart"></i>
      <span>Sales Report</span>
    </a>
    <ul class="collapse nav flex-column ms-3" id="salesReportMenu">
      <li><a href="sales_report.php" class="nav-link">Sales by dates</a></li>
      <li><a href="monthly_sales.php" class="nav-link">Monthly sales</a></li>
      <li><a href="daily_sales.php" class="nav-link">Daily sales</a></li>
    </ul>
  </li>
</ul>
