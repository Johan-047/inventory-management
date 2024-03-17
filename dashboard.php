<?php 
session_start();
extract($_REQUEST);
include('afunctions.php');

if(!isset($_SESSION['id']))
{
    echo "<script>window.location.assign('index.php')</script>";
}
$uid=$_SESSION["id"];
$ulevel=$_SESSION["ulevel"]; 
$name=$_SESSION["name"];
if($ulevel ==1){
	$dass="sdash.php";
}elseif($ulevel ==2){
	$dass="rdash.php";
}elseif($ulevel ==3 or $ulevel ==6){
	$dass="ddash.php";
}elseif($ulevel ==4){
	$dass="sddash.php";
	}
 
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta
      name="SEB AP"
    />
    <meta
      name="description"
      content=" SEB AP"
    />
    <meta name="robots" content="noindex,nofollow" />
    <title>SEB AP</title>
    <!-- Favicon icon -->
    <link
      rel="icon"
      type="image/png"
      sizes="16x16"
      href="assets/images/favicon.png"
    />
     <link
      href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
      rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<style>
.scroll-sidebar {
  position: sticky;
  top: 0;
  height: calc(100vh - 60px); /* Adjust the height to accommodate the topbar height */
  overflow-y: auto;
}
</style>
  <body>
 
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div
      id="main-wrapper"
      data-layout="vertical"
      data-navbarbg="skin5"
      data-sidebartype="full"
      data-sidebar-position="absolute"
      data-header-position="absolute"
      data-boxed-layout="full"
    >
      <!-- ============================================================== -->
      <!-- Topbar header - style you can find in pages.scss -->
      <!-- ============================================================== -->
      <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
          <div class="navbar-header" data-logobg="skin5">
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="<?=$dass;?>">
              <!-- Logo icon -->
              <b class="logo-icon ps-2">
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <img
                  src="images/logo.png"
                  alt="homepage"
                  class="light-logo"
                  width="25"
                />
              </b>
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text ms-2">
                <!-- dark Logo text -->
                 SEB AP
              </span>
              <!-- Logo icon -->
              <!-- <b class="logo-icon"> -->
              <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
              <!-- Dark Logo icon -->
              <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

              <!-- </b> -->
              <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a
              class="nav-toggler waves-effect waves-light d-block d-md-none"
              href="javascript:void(0)"
              ><i class="ti-menu ti-close"></i
            ></a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <div
            class="navbar-collapse collapse"
            id="navbarSupportedContent"
            data-navbarbg="skin5"
          >
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-start me-auto">
              <li class="nav-item d-none d-lg-block">
                <a
                  class="nav-link sidebartoggler waves-effect waves-light"
                  href="javascript:void(0)"
                  data-sidebartype="mini-sidebar"
                  ><i class="mdi mdi-menu font-24"></i
                ></a>
              </li>
              <!-- ============================================================== -->
              <!-- create new -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="d-none d-md-block" >SEB  AP <i class="fa fa-angle-down"> </i></span>
                  <span class="d-block d-md-none" ><i class="fa fa-plus"></i></span>
                </a>
				<?php if($ulevel ==4 OR $ulevel ==5 ){ ?>	
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="create_case.php">Add Case Details</a></li>
                  <li><a class="dropdown-item" href="view_case.php"> View Case Details</a></li>
                   
                </ul>
				<?php } ?>
              </li>
              <!-- ============================================================== -->
              <!-- Search -->
              <!-- ============================================================== -->
              <li class="nav-item search-box">
                <a
                  class="nav-link waves-effect waves-dark"
                  href="javascript:void(0)"
                  ><i class="mdi mdi-magnify fs-4"></i
                ></a>
                <form class="app-search position-absolute">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Search &amp; enter"
                  />
                  <a class="srh-btn"><i class="mdi mdi-window-close"></i></a>
                </form>
              </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-end">
              <!-- ============================================================== -->
              <!-- Comment -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="mdi mdi-bell font-24"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#"> </a></li>
                  <li><a class="dropdown-item" href="#"> </a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a class="dropdown-item" href="#"> </a>
                  </li>
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- End Comment -->
              <!-- ============================================================== -->
             
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
              <li class="nav-item dropdown">
                <a
                  class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <img
                    src="assets/images/users/1.jpg"
                    alt="user"
                    class="rounded-circle"
                    width="31"
                  /> <strong> <?=$name;?></strong> 
                </a>
                <ul
                  class="dropdown-menu dropdown-menu-end user-dd animated"
                  aria-labelledby="navbarDropdown"
                >
                  <a class="dropdown-item" href="javascript:void(0)"
                    ><i class="mdi mdi-account me-1 ms-1"></i> My Profile</a>
                
                 
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="javascript:void(0)"
                    ><i class="mdi mdi-settings me-1 ms-1"></i> Account
                    Setting</a>
                  <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php"
                    > <i class="fa fa-power-off me-1 ms-1"></i>Logout</a
                  >
                  <div class="dropdown-divider"></div>
                  <div class="ps-4 p-10">
                    <a
                      href="profile.php"
                      class="btn btn-sm btn-success btn-rounded text-white"
                      >View Profile</a
                    >
                  </div>
                </ul>
              </li>
              <!-- ============================================================== -->
              <!-- User profile and search -->
              <!-- ============================================================== -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- ============================================================== -->
      <!-- End Topbar header -->
      <!-- ============================================================== -->
      <!-- ============================================================== -->
      <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->
      <aside class="left-sidebar" data-sidebarbg="skin5">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
          <!-- Sidebar navigation-->
          <nav class="sidebar-nav">
            <ul id="sidebarnav" class="pt-4">
              <li class="sidebar-item">
                <a
                  class="sidebar-link waves-effect waves-dark sidebar-link"
                  href="<?=$dass;?>"
                  aria-expanded="false"
                  ><i class="mdi mdi-view-dashboard"></i
                  ><span class="hide-menu">Dashboard</span></a
                >
              </li>
               
              <?php
                if(true){ ?>			  
              <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="dashboard.php"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu"> STATION DSR</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="sdsr_view.php" class="sidebar-link"
                      ><i class="mdi mdi-note-outline"></i
                      ><span class="hide-menu">View Station DSR</span></a
                    >
                  </li>
 
                  <li class="sidebar-item">
                    <a href="summary_station_dsr.php" class="sidebar-link"
                      ><i class="mdi mdi-note-plus"></i
                      ><span class="hide-menu">View Station DSR Summary</span></a
                    >
                  </li>				 
				  
                </ul>
              </li>
               <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-face"></i
                  ><span class="hide-menu">NCRB DATA </span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="nbw_create.php" class="sidebar-link"
                      ><i class="mdi mdi-emoticon"></i
                      ><span class="hide-menu"> Add NCRB Data</span></a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="nbw_view.php" class="sidebar-link"
                      ><i class="mdi mdi-emoticon-cool"></i
                      ><span class="hide-menu"> View NCRB Data</span></a
                    >
                  </li>
                </ul>
              </li>
			  <li class="sidebar-item">
                <a
                  class="sidebar-link has-arrow waves-effect waves-dark"
                  href="javascript:void(0)"
                  aria-expanded="false"
                  ><i class="mdi mdi-receipt"></i
                  ><span class="hide-menu">TS Elections</span></a
                >
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="mlc_form.php" class="sidebar-link"
                      ><i class="mdi mdi-note-outline"></i
                      ><span class="hide-menu">TS Elections Form</span></a
                    >
                  </li>
				  <li class="sidebar-item">
                    <a href="mlcabstract.php" class="sidebar-link"
                      ><i class="mdi mdi-note-outline"></i
                      ><span class="hide-menu">View TS Elections Abstract</span></a
                    >
                  </li>
                  </ul>
                  </li>
			  
			  <?php
			}?>
		
               
            </ul>
          </nav>
          <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
      </aside>
      <!-- ============================================================== -->
      <!-- End Left Sidebar - style you can find in sidebar.scss  -->
      <!-- ============================================================== -->