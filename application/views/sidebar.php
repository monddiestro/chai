<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-clipboard"></i>
  </div>
  <!-- <div class="sidebar-brand-text mx-3">CHHAI</div> -->
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item <?php echo $nav == "dashboard" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo base_url(); ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<li class="nav-item <?php echo $nav == "inbox" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo base_url('request'); ?>">
    <i class="fas fa-fw fa-inbox"></i>
    <span>Requests</span></a>
</li>

<li class="nav-item <?php echo $nav == "archive" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo base_url('request/archive'); ?>">
    <i class="fas fa-fw fa-archive"></i>
    <span>Archive</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  Records
</div>

<!-- Units Nav -->
<li class="nav-item <?php echo $nav == "units" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo ($this->session->userdata('uac') == 'administrator') ?  base_url('admin/units') : base_url('editor/units') ?>">
    <i class="fas fa-fw fa-home"></i>
    <span>House</span></a>
</li>

<!-- Members Nav -->
<li class="nav-item <?php echo $nav == "members" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo ($this->session->userdata('uac') == 'administrator') ? base_url('admin/members') : base_url('editor/members'); ?>">
    <i class="fas fa-fw fa-users"></i>
    <span>Members</span></a>
</li>

<!-- Cars Nav -->
<li class="nav-item <?php echo $nav == "cars" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo ($this->session->userdata('uac') == 'administrator') ? base_url('admin/cars') : base_url('editor/cars') ?>">
    <i class="fas fa-fw fa-car-side"></i>
    <span>Cars</span></a>
</li>

<!-- Pets Nav -->
<li class="nav-item <?php echo $nav == "pets" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo ($this->session->userdata('uac') == 'administrator') ? base_url('admin/pets') : base_url('editor/pets') ?>">
    <i class="fas fa-fw fa-paw"></i>
    <span>Pets</span></a>
</li>

<!-- Helpers -->
<li class="nav-item <?php echo $nav == "helpers" ? 'active' : '' ?>">
  <a class="nav-link" href="<?php echo ($this->session->userdata('uac') == 'administrator') ? base_url('admin/helpers') : base_url('editor/helpers') ?>">
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
<li class="nav-item <?php echo $nav == "settings" ? 'active' : '' ?>">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Settings</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">System Settings</h6>
      <a class="collapse-item" href="<?php echo ($this->session->userdata('uac') == 'administrator') ? base_url('admin/helpers_work') : base_url('editor/helpers_work')  ?>">Helper Works</a>
      <a class="collapse-item" href="<?php echo ($this->session->userdata('uac') == 'administrator') ? base_url('admin/pet_types') :  base_url('editor/pet_types') ?>">Pet Types</a>
      <?php if($this->session->userdata('uac') == "administrator"): ?>
      <a class="collapse-item" href="<?php echo base_url('admin/account') ?>">Account</a>
      <?php endif ?>
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