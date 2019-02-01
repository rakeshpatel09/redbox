user_app.controller('viewController', ['$scope', '$http' , '$window', '$localStorage', function ($scope,$http,$window , $localStorage) {
  $scope.users = {};

  console.log($localStorage.users_data.users_id);

  $http({
            method: 'POST',
            url: 'http://'+location.host+'/fetchProfile',
            data: {'users_id' : $localStorage.users_data.users_id}
        })
      .then(
        function (response) {
          //console.log(response);
        //if successfull login redirect users
        if(response.data.status === 200)
          $scope.users = angular.copy(response.data.data[0]);
          console.log($scope.users.user_name);
        },
        function (error){
          console.log(error, 'can not get data.');
        }
      );

  //angular.$extend($scope,[
    $scope.doTheBack = function() {
      //console.log($scope.users);
      $window.history.back();
    
    }
  //]);
    
}]);
