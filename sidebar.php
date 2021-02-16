   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
        <i class="fas fa-gas-pump"></i>
    </div>
    <div class="sidebar-brand-text mx-3" style="font-size:20px">میاں پٹرولیم سروسز</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>ڈیش بورڈ</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Users
</div>

<!-- Nav Item - Pages Employee Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>ملازمین</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Employees:</h6>
            <a class="collapse-item" href="employees.php"> نیا ملازم شامل کریں</a>
            <a class="collapse-item" href="employee_sale.php">ملازم روزانہ سیل</a>
        </div>
    </div>
</li>

<!-- Nav Item - Customers Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-users"></i>
        <span>گاهک</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Customers:</h6>
            <a class="collapse-item" href="customers.php"> نیا گاهک شامل کریں</a>
            <a class="collapse-item" href="customer_borrow.php">  گاهک کا قرض شامل کریں</a>
            <a class="collapse-item" href="borrow_payment.php">قرض ادائیگی گاهک</a>
        </div>
    </div>
</li>

<!-- Nav Item - Sales -->
<li class="nav-item">
    <a class="nav-link" href="accounts.php">
        <i class="fas fa-fw fa-user"></i>
        <span>صارف اکاؤنٹس</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Inventory
</div>

<!-- Nav Item - Stock Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseStock"
        aria-expanded="true" aria-controls="collapseStock">
        <i class="fas fa-fw fa-boxes"></i>
        <span>اسٹاک</span>
    </a>
    <div id="collapseStock" class="collapse" aria-labelledby="headingStock"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Stock:</h6>
            <a class="collapse-item" href="stock2.php"> نیا اسٹاک شامل کریں</a>
            <a class="collapse-item" href="stock_sale.php">فروخت اسٹاک</a>
        </div>
    </div>
</li>
<!-- Nav Item - Stocks -->
<li class="nav-item">
    <a class="nav-link" href="stock.php">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>ڈپ</span></a>
</li>


<!-- Nav Item - Expenses -->
<li class="nav-item">
    <a class="nav-link" href="expenses.php">
        <i class="fas fa-fw fa-boxes"></i>
        <span>اخراجات</span></a>
</li>
<!-- Nav Item - Owner Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOwner"
        aria-expanded="true" aria-controls="collapseOwner">
        <i class="fas fa-fw fa-users"></i>
        <span>مالک</span>
    </a>
    <div id="collapseOwner" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Manage Customers:</h6>
            <a class="collapse-item" href="owners.php"> نیا مالک شامل کریں</a>
            <a class="collapse-item" href="owner_borrow.php">  مالک کا قرض شامل کریں</a>
            <a class="collapse-item" href="owner_payment.php">قرض ادائیگی مالک</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link" href="cash_hand.php">
        <i class="fas fa-fw fa-hand-holding-usd"></i>
        <span>ہاتھ میں نقد</span></a>
</li>


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>



</ul>
<!-- End of Sidebar -->