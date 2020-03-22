
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin Panel</title>

  <link rel="stylesheet" href="/css/app.css">
  <style>
    /* width */
    ::-webkit-scrollbar {
      width: 2px;
    }
    
    /* Track */
    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey; 
      border-radius: 10px;
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: blue; 
      border-radius: 10px;
    }
    
    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #b30000; 
     
    }
    .router-link-active{border:1px solid white;}
    .menu-close {background:black;}
    .menu-close .router-link-active{background:grey;}
    #trasha{margin:auto;
            color:green;
            display:flex; 
            align-items: center;
            justify-content: center;
            padding-top:40%;
            width:1%;}
    </style>
       <style>
        /*****************************************
      upload button styles
    ******************************************/
    .file-upload {
      position: relative;
      display: inline-block;
    }
    
    .file-upload__label {
      display: block;
      padding: 5px 15px;
      color: #fff;
      background-color: #2176bd;
      border-color: #1f6fb2;
      border-radius: .4em;
      transition: background .3s;
      
      &:hover {
         cursor: pointer;
         background: #000;
      }
    }
        
    .file-upload__input {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        font-size: 1;
        width:0;
        height: 100%;
        opacity: 0;
    }
    .read{
color:lightblue;
    }
.pull-right{color:red;font-size:10px}
.pull-left{color:blue;float:right;font-size:10px}
#error_box{color:red;font-size:12px;}
.sales_div{width:100%;}
.sales_table {border:1px solid lightgrey; padding-top:2px}
.sales_table td {margin-top:0;border:1px}
.chat-message-content{background:url('image/messagebackground.png');background-color:white;}
        </style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-circle "></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
            <img src="{{asset('image/icon.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          
          <div class="dropdown-divider"></div>
         
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('image/logo.png') }}" alt="AdminLTE Logo" class="brand-image img elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"> '</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('image/icon.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <router-link to="/profile"  class="d-block"> {{ Auth::user()->name }}</router-link>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
            <p>
            Dashboard
            </p>
        </router-link>
        </li>    
          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user text-green"></i>
              <p>
                Profile
              </p>
            </route-link>
          </li>
          <li class="nav-item has-treeview menu-close">
            <a link to="#" class="nav-link ">
              <i class="nav-icon fab fa-buromobelexperte"></i>
              <p>
                Sales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/make-sales" class="nav-link ">
                  <i class="fas fa-cart-plus nav-icon"></i>
                  <p>Make Sales</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/view-sales" class="nav-link">
                  <i class="fas fa-notes-medical nav-icon"></i>
                  <p>View Sales</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/today-sales" class="nav-link">
                  <i class="fas fa-notes-medical nav-icon"></i>
                  <p>Today Sales</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/create-product" class="nav-link">
                  <i class="fas fa-grip-vertical nav-icon"></i>
                  <p> Product</p>
                </router-link>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <router-link to="/chat" class="nav-link">
              <i class="nav-icon fas fa-comments text-cyan"></i>
              <p>
                Chat
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/users" class="nav-link">
                <i class="nav-icon fas fa-users text-purple"></i>
                <p>
                Employee
                </p>
            </router-link>
          </li>  
          <li class="nav-item">
            <router-link to="/task" class="nav-link">
                <i class="nav-icon fas fa-flask text-yellow"></i>
                <p>
                Task
                </p>
            </router-link>
            </li>    
            <li class="nav-item">
              <router-link to="/setting" class="nav-link">
                  <i class="nav-icon fas fa-cog text-orange"></i>
                  <p>
                  Setting
                  </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                  <i class="nav-icon fas fa-toolbox text-pink"></i>
                  <p>
                  Dev Tools
                  </p>
              </router-link>
            </li>
             
          <li class="nav-item has-treeview menu-close">
            <a link to="#" class="nav-link ">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Management Tools
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/calendar" class="nav-link ">
                  <i class="fas fa-calendar-week nav-icon"></i>
                  <p>Calender</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/to-do" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>To do List</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/calculator" class="nav-link">
                  <i class="fas fa-calculator nav-icon"></i>
                  <p>Calculator</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/notebook" class="nav-link">
                  <i class="fas fa-sticky-note nav-icon"></i>
                  <p>NoteBook</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/phonebook" class="nav-link">
                  <i class="fas fa-phone-square-alt nav-icon"></i>
                  <p>PhoneBook</p>
                </router-link>
              </li>
            </ul>
          </li>
         
          <li class="nav-item">
            <a href="{{ route('logout') }}"  class="nav-link"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
             <i class="nav-icon fas fa-power-off text-red"></i>
              <p>
                Log Out
              </p>
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
         
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
  
      
        
<vue-progress-bar></vue-progress-bar>
<router-view></router-view>


        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script src="/js/app.js"></script>
</body>
</html>
