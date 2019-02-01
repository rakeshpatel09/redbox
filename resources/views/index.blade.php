<head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
            <link href="{{ asset('vendor/admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/loading-bar.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style type="text/css">
            .disabled {
                opacity: 0.4;
            }
            .market-input {
              width: 48% !important;
              margin: 1% !important;
              float: left;
            }
        </style>
</head>
<body ng-app="network_app" >
  <div class="wrapper fadeInDown" ng-controller="loginController">
  
    <!-- Tabs Titles -->
    <div ui-view="">      
  </div>
  
</div>

</body>
<script src="{{ asset('js/angular.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.3/angular-ui-router.js"></script> 
<script src="{{ asset('js/ngStorage.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.20/stateEvents.js"></script>
<script src="{{ asset('js/network_app.js') }}"></script>
<script src="{{ asset('js/loading-bar.js') }}"></script>
<script src="{{ asset('angular/loginController.js') }}"></script>
<script src="{{ asset('angular/registerController.js') }}"></script>
<script src="{{ asset('vendor/admin/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendor/admin/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js
"></script>
