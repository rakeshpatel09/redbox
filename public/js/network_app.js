var network_app = angular.module('network_app',['ui.router','ngStorage','angular-loading-bar']);
network_app.config(['$stateProvider','$urlRouterProvider',function($stateProvider,$urlRouterProvider){
      $stateProvider.state({
        url : '/',
        name : 'default',
        templateUrl : 'template/login.html',
        controller : 'loginController'
      })

      $stateProvider.state({
        url : '/login',
        name : 'login',
        templateUrl : 'template/login.html',
        controller : 'loginController'
      })

      $stateProvider.state({
        url : '/register',
        name : 'register',
        templateUrl : 'template/register.html',
        controller : 'registerController'
      })

      $urlRouterProvider.otherwise('/')
}]);

    