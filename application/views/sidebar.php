<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">CHHAI</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="index.html">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Records
</div>

<!-- Units Nav -->
<li class="nav-item <?php echo $nav == "units" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo base_url('admin/units') ?>">
    <i class="fas fa-fw fa-home"></i>
    <span>House</span></a>
</li>

<!-- Members Nav -->
<li class="nav-item <?php echo $nav == "members" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo base_url('admin/members') ?>">
    <i class="fas fa-fw fa-users"></i>
    <span>Members</span></a>
</li>

<!-- Cars Nav -->
<li class="nav-item <?php echo $nav == "cars" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo base_url('admin/cars') ?>">
    <i class="fas fa-fw fa-car-side"></i>
    <span>Cars</span></a>
</li>

<!-- Helpers -->
<li class="nav-item <?php echo $nav == "helpers" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo base_url('admin/members') ?>">
    <i class="fas fa-fw fa-hands-helping"></i>
    <span>Helpers</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  System
</div>

<!-- Settings Collapse -->
<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Settings</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">System Settings</h6>
      <a class="collapse-item" href="buttons.html">Buttons</a>
      <a class="collapse-item" href="cards.html">Cards</a>
    </div>
  </div>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->