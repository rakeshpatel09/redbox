var user_app = angular.module('user_app', ['ui.router','ui.router.state.events','ngStorage','ngFileUpload','angular-loading-bar'])
user_app.config(['$stateProvider', '$urlRouterProvider','$locationProvider', function($stateProvider, $urlRouterProvider, $locationProvider) {

      $stateProvider      
        .state('home', {
          url: '/home',  
          templateUrl: "public/template/admin/home.html"
        })
        .state('index', {
          url: '/',         
          templateUrl: "public/template/admin/home.html"
        })

        .state('add_memeber', {
          url: '/add_member',         
          templateUrl: "public/template/admin/add_member.html"
        })

        .state('user_profile', {
          url: '/user_profile',         
          templateUrl: "public/template/admin/user_profile.html",
          controller : 'userController'
        })

        .state('direct_tree', {
          url: '/direct_tree',         
          templateUrl: "public/template/admin/direct_tree.html",
          controller : 'directTreeController'
        })

        .state('up_tree', {
          url: '/up_tree',         
          templateUrl: "/template/admin/up_tree.html",
          controller : 'upTreeController'
        })

        .state('generateSponsorPdf', {
          url: '/generate_pdf',         
          controller : 'userController'
        })

        .state('uploadPayment', {
          url: '/upload_payment',      
          templateUrl: "/template/admin/payment_upload.html",   
          controller : 'userController'
        })

        .state('view_profile', {
          url: '/view_profile',         
          templateUrl: "/template/admin/view_profile.html",
          controller : 'viewController'
        })

        .state('logout', {
          url: '/logout',         
          controller:'logoutController'
        })

        .state('addUser', {
          url: '/adduser',  
          templateUrl: "/template/admin/user.html"
        })

      $urlRouterProvider.otherwise("/");
    }
]);

user_app.controller('user_index', ['$scope', '$localStorage' , function ($scope , $localStorage) {

  $scope.users_data = $localStorage.users_data;
  $scope.public_path = public_path; // public_path variable creted in user_index.blade.php
  $scope.users_data.users_pic =  $scope.public_path+"upload/adhar/"+$scope.users_data.profile_pic;
}]);

/*user_app = angular.module('sampleApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });*/