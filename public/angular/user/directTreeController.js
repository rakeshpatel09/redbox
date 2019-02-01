user_app.controller('directTreeController', ['$scope', '$http' , '$window', '$localStorage', function ($scope,$http,$window , $localStorage) {
  $scope.users = {};
  $scope.sponsor_id = $localStorage.users_data.users_id;
  console.log($scope.sponsor_id);
  $http({
            method: 'POST',
            url: 'http://'+location.host+'/fetchTree',
            data: {'sponsor_id':$scope.sponsor_id}
        })
        .then(
              function (response) {
                console.log(response);

                var chart_data =[];
                
                 var node = { id: $scope.sponsor_id, title: 'Current', name: $scope.sponsor_id, img: "https://balkangraph.com/js/img/2.jpg" };

                 chart_data.push(node);                     

                 // fetching the available direct users
                  for (var i = 0; i <response.data.length; i++) {
                        
                        var node = { 
                              id: response.data[i].users_id, pid : $scope.sponsor_id , title: response.data[i].user_name, name: response.data[i].users_id, img: "../../upload/profile/"+response.data[i].profile_pic
                           };

                           chart_data.push(node);
                      }

                  //if direct users are less than 3 then add dummy users 
                  if(response.data.length < 3) {

                    var diff = 3 - response.data.length;

                    for (var i = 0; i <diff; i++) {
                        
                        var node = { 
                              id:i, pid : $scope.sponsor_id , title: "Add Member", name: "none", img: "https://img.icons8.com/color/1600/circled-user-male-skin-type-1-2.png"
                           };

                           chart_data.push(node);
                      }
                  }    

                      console.log(chart_data);

                      var chart = new OrgChart(document.getElementById("orgchart"), {
                        nodeMouseClickBehaviour: BALKANGraph.action.none,
                         template: "diva",
                        enableSearch: false,
                        nodeBinding: {
                            field_0: "name",
                            field_1: "title",
                            img_0: "img"
                        },
                        nodes: chart_data
                    });
            
              },
          function(error) {
            console.log(error);
          });

  }]);
