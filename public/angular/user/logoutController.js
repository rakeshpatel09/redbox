user_app.controller('logoutController', ['$scope', '$http' , '$window','$state', function ($scope,$http,$window,$state) {
  //$scope.users;
  
  $window.location.href = 'http://'+location.host;
  
}]);
