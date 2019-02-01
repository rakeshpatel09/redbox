angular.module('network_app', ['ui.router'])
    .config(['$stateProvider', '$urlRouterProvider','$locationProvider', function($stateProvider, $urlRouterProvider, $locationProvider) {

      //$locationProvider.hashPrefix('');
      
      $stateProvider      
        .state('home', {
          url: '/home',
          template : "<h1>Hello</h1>"  
          //templateUrl: "/template/admin/home.html"
        })
        .state('index', {
          url: '/',         
          templateUrl: "/template/login.html"
        })
        .state('upload_payment', {
          url: '/upload_payment',         
          template: "<h1>Hello</h1>"
        })
        .state('add_user', {
          url: '/',         
          templateUrl: "/template/admin/add_user.html"
        })
  
      $urlRouterProvider.otherwise("/");
    }
]);