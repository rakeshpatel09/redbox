user_app.controller('userController', ['$scope', '$http' , '$window','$localStorage','$state','$location','Upload', function ($scope,$http,$window , $localStorage,$state,$location,Upload) {
  $scope.users = {};
  $scope.users.user_name = $localStorage.users_data.users_id;
  console.log($localStorage.users_data.users_id);
  $http({
            method: 'POST',
            url: 'http://'+location.host+'/fetchProfile',
            data: {'users_id' : $localStorage.users_data.users_id }
        })
      .then(
        function (response) {
         
        //if successfull login redirect users
        if(response.data.status === 200)
          $scope.users = angular.copy(response.data.data[0]);
          
        },
        function (error){
          console.log(error, 'can not get data.');
        }
      );

    if($state.current.name === "generateSponsorPdf") {

        $window.location.href = 'http://'+location.host+'/sponsorPdf/'+$localStorage.users_data.users_id+'';
//console.log("Hiiii");
    }

    if($state.current.name === "uploadPayment") {


      }

  
  angular.extend($scope,{
    
    uploadPayment : function() {
        console.log("Hiiii");
          $scope.payment.user_id = $localStorage.users_data.users_id;
          Upload.upload({
                url: 'http://'+location.host+'/uploadPayment',
                data: $scope.payment
            })
          .then(
            function (response) {
            //if successfull login redirect users
            if(response.data.status === 200) {
              bootbox.alert({ 
                title : 'Success',
                message :'<span class="text-success">'+response.data.message+'</span>',
                size : 'medium',
                callback : function(){ 
                  $state.go('view_profile');
                 }
                });
             }              
            },
            function (error){
              console.log(error, 'can not get data.');
            }
          );    
    },
    updateProfile : function() {
      console.log($scope.users);
      //$scope.users.adhar_file = $scope.file;
      //$scope.users.pic_file = $scope.file;
      Upload.upload({
            url: 'http://'+location.host+'/updateProfile',
            data: $scope.users
        })
      .then(
        function (response) {
        //if successfull login redirect users
        if(response.data.status === 200) {
          bootbox.alert({ 
            title : 'Success',
            message :'<span class="text-success">'+response.data.message+'</span>',
            size : 'medium',
            callback : function(){ 
              $state.go('view_profile');
             }
            });

        }
          //$scope.users = angular.copy(response.data.data[0]);
          //alert(response.data.message);
        },
        function (error){
          console.log(error, 'can not get data.');
        }
      );    
    },
  });
    
}]);
