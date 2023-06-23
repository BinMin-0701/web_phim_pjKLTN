<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
  <title> Admin Web Phim </title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Admin Web Phim" />
  <script type="application/x-javascript">
    addEventListener("load", function() {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- Bootstrap Core CSS -->
  <link href="{{asset('backend/css/bootstrap.css')}}" rel="stylesheet" type="text/css" />
  <!-- Custom CSS -->
  <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" type="text/css" />
  <!-- font-awesome icons CSS -->
  <link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet" />
  <!-- //font-awesome icons CSS-->
  <!-- side nav css file -->
  <link href="{{asset('backend/css/SidebarNav.min.css')}}" media="all" rel="stylesheet" type="text/css" />

  <link rel="" type="" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <!-- //side nav css file -->
  <!-- js-->
  <script src="{{asset('backend/js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('backend/js/modernizr.custom.js')}}"></script>
  <!--webfonts-->
  <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet" />
  <!--//webfonts-->
  <!-- chart -->
  <script src="{{asset('backend/js/Chart.js')}}"></script>
  <!-- //chart -->
  <!-- Metis Menu -->
  <script src="{{asset('backend/js/metisMenu.min.js')}}"></script>
  <script src="{{asset('backend/js/custom.js')}}"></script>
  <link href="{{asset('backend/css/custom.css')}}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/8e47a4543e.js" crossorigin="anonymous"></script>
  <!--//Metis Menu -->
  <style>
    #chartdiv {
      width: 100%;
      height: 295px;
    }
  </style>
</head>

<body class="cbp-spmenu-push">
  @yield('content_login')
  
</body>

</html>