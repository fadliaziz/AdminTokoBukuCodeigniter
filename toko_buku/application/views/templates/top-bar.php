<body>
<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<div class="preloader">
<div class="lds-ripple">
<div class="lds-pos"></div>
<div class="lds-pos"></div>
</div>
</div>
<!-- ============================================================== -->
<!-- Main wrapper - style you can find in pages.scss -->
<!-- ============================================================== -->
<div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar" data-navbarbg="skin5">
<nav class="navbar top-navbar navbar-expand-md navbar-dark">
<div class="navbar-header" data-logobg="skin5">
<!-- ============================================================== -->
<!-- Logo -->
<!-- ============================================================== -->
<a class="navbar-brand" href="<?php echo base_url('admin/p/home') ?>">
<!-- Logo icon -->
<b class="logo-icon">
<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
<!-- Dark Logo icon -->
</b>
<!--End Logo icon -->
<!-- Logo text -->
<span class="logo-text">
<!-- dark Logo text -->
<h3 class="dark-logo">FlizStore's| Books</h3>
<h3 class="light-logo-logo">FlizStore's| Books</h3>
</span>
</a>
<!-- ============================================================== -->
<!-- End Logo -->
<!-- ============================================================== -->
<!-- This is for the sidebar toggle which is visible on mobile only -->
<a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
</div>
<!-- ============================================================== -->
<!-- End Logo -->
<!-- ============================================================== -->
<div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
<!-- ============================================================== -->
<!-- toggle and nav items -->
<!-- ============================================================== -->
<ul class="navbar-nav float-left mr-auto">
<!-- ============================================================== -->
<!-- Search -->
<!-- ============================================================== -->
<!-- <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
<form class="app-search position-absolute">
<input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
</form>
</li> -->
</ul>
<!-- ============================================================== -->
<!-- Right side toggle and nav items -->
<!-- ============================================================== -->
<ul class="navbar-nav float-right">
<!-- ============================================================== -->
<!-- User profile and search -->
<!-- ============================================================== -->
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url() ?>assets/images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>
<div class="dropdown-menu dropdown-menu-right user-dd animated">
<a class="dropdown-item" href="<?php echo base_url('init/logout') ?>"><i class="mdi mdi-power m-r-5 m-l-5"></i> Logout</a>
<!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-wallet m-r-5 m-l-5"></i> My Balance</a> -->
<!-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-email m-r-5 m-l-5"></i> Inbox</a> -->
</div>
</li>
<!-- ============================================================== -->
<!-- User profile and search -->
<!-- ============================================================== -->
</ul>
</div>
</nav>
</header>