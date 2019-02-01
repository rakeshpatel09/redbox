network_app.controller('loginController', ['$scope', '$http' , '$window','$localStorage', function ($scope,$http,$window,$localStorage) {
  $scope.users;
  $scope.userData = {};
  console.log(location.host);
  $scope.login_check = function() {
    
    $http({
            method: 'POST',
            url: 'http://'+location.host+'/login',
            data: $scope.users
        })
      .then(
        function (response) {
        //if successfull login redirect users
        if(response.data.status === 200) {
          console.log(response.data.users_id);
          $localStorage.users_data =  {
              'users_id' : response.data.user_data.users_id,
              'users_name' : response.data.user_data.user_name,
              'profile_pic' : response.data.user_data.adhar_photo,
              'mobile_no' : response.data.user_data.mobile_no,
              'email' : response.data.user_data.email,
          };
          $window.location.href = 'http://'+location.host+'/user_index';
        }
        else {
          bootbox.alert({ 
            title : 'Error',
            message :'<span class="text-success">'+response.data.message+'</span>',
            size : 'medium'
           
            });
        }
        },
        function (error){
          console.log(error);
        }
      );
    }  
}]);
