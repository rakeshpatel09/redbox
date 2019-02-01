<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="{{ asset('image/redbox_icon.jpeg')}}" type="image/ico" />

    <title> RedBox | </title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendor/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendor/admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendor/admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{ asset('vendor/admin/vendors/iCheck/skins/flat/green.css') }}" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="{{ asset('vendor/admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{ asset('vendor/admin/vendors/jqvmap/dist/jqvmap.min.css') }}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendor/admin/vendors/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading-bar.css') }}" rel="stylesheet">
  </head>

  <body ng-app="user_app" class="nav-md" ng-controller="user_index">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;background-image:url({{ asset('image/redbox_logo.jpeg')}});background-size: cover;">
              <a class="site_title"></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img ng-cloak src="@{{ users_data.users_pic }}" alt="not found" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2 ng-cloak> @{{ users_data.users_name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->
            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a><i class="fa fa-user"></i> Profile <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li ui-sref-active="active"><a ui-sref="view_profile">View</a></li>
                      <li ui-sref-active="active"><a ui-sref="user_profile">Edit</a></li>                      
                    </ul>
                  </li>

                  <li><a><i class="fa fa-users"></i> Team Details <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a ui-sref="direct_tree" ui-sref-active="active">Direct Tree</a></li>
                      <li><a ui-sref="up_tree" ui-sref-active="active">UP Tree</a></li>
                      <li><a ui-sref="up_tree" ui-sref-active="active">Full Tree</a></li>
                      <li><a ui-sref="generateSponsorPdf" ui-sref-active="active">Download pdf Tree</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-envelope"></i> Message <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index.html">Dashboard</a></li>                      
                    </ul>
                  </li>
                  <li><a ui-sref="uploadPayment" ui-sref-active="active"><i class="fa fa-money"></i> Payments</a></li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li><a ui-sref="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- UI Routing pages load -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <ui-view></ui-view>          
        </div>
        
        <footer>
          <div class="pull-right">
            RedBox.com
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <script type="text/javascript">
    var public_path = "{{ asset('/') }}";
    console.log(public_path);
  </script>  

  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>

    <script src="{{ asset('js/angular.min.js') }}"></script>
    <script src="{{ asset('js/ui_router.js') }}"></script>
    <script src="{{ asset('js/state_event.js') }}"></script>
    <script src="{{ asset('js/ngStorage.min.js') }}"></script>
	  <script src="{{ asset('js/network_user_app.js') }}"></script>
    <script src="{{ asset('js/orgchart.js') }}"></script>

	<script src="{{ asset('angular/user/logoutController.js') }}"></script>
	<script src="{{ asset('angular/user/userController.js') }}"></script>
	<script src="{{ asset('angular/user/viewController.js') }}"></script>
  <script src="{{ asset('angular/user/directTreeController.js') }}"></script>
  <script src="{{ asset('angular/user/upTreeController.js') }}"></script>


    <!-- jQuery -->
    <script src="{{ asset('vendor/admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendor/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js
"></script>
    <!-- FastClick -->
    <script src="{{ asset('vendor/admin/vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendor/admin/vendors/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    <script src="{{ asset('vendor/admin/vendors/Chart.js/dist/Chart.min.js') }}"></script>
    <!-- gauge.js -->
    <script src="{{ asset('vendor/admin/vendors/gauge.js/dist/gauge.min.js') }}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('vendor/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('vendor/admin/vendors/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->
    <script src="{{ asset('vendor/admin/vendors/skycons/skycons.js') }}"></script>
    <!-- Flot -->
    <script src="{{ asset('vendor/admin/vendors/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/Flot/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/Flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/Flot/jquery.flot.resize.js') }}"></script>
    <!-- Flot plugins -->
    <script src="{{ asset('vendor/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/flot-spline/js/jquery.flot.spline.min.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/flot.curvedlines/curvedLines.js') }}"></script>
    <!-- DateJS -->
    <script src="{{ asset('vendor/admin/vendors/DateJS/build/date.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('vendor/admin/vendors/jqvmap/dist/jquery.vmap.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js') }}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{ asset('vendor/admin/vendors/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/admin/vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{ asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/ng-file-upload-shim.min.js') }}"></script> 
    <script src="{{ asset('js/ng-file-upload.min.js') }}"></script>
    <script src="{{ asset('js/loading-bar.js') }}"></script>


</body>


