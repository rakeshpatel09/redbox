network_app.controller('registerController', ['$scope', '$http' , '$window','$state', function ($scope,$http,$window,$state) {
  $scope.users;
  angular.extend($scope,{
  doRegister : function() {
    //console.log($scope.users);
        $http({
                method: 'POST',
                url: 'http://'+location.host+'/register',
                data: $scope.users
            }).then(function (response) {
        console.log(response.data);
        //if successfull login redirect users
        if(response.status === 200)
          $state.go('login');
    },function (error){
        console.log(error, 'can not get data.');
    });
  },

  checkSponsor : function(){
    $http({
                method: 'POST',
                url: 'http://'+location.host+'/checkSponsor',
                data: {'sponsor_id':$scope.users.sponsor_id}
            }).then(

              function(response)  {
                
                if(response.data.status === 201) {
                  console.log(response);
                  $scope.registerForm.sponsor_id.$setValidity('required', false);
                  alert(response.data.message);
                }
                else
                  $scope.registerForm.sponsor_id.$setValidity('required', true);
              },
              function(error) {

                console.log(error);

              }
            );
    }  
 });
}]);
