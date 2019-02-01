user_app.controller('upTreeController', ['$scope', '$http' , '$window', '$localStorage', function ($scope,$http,$window , $localStorage) {
  $scope.users = {};
  $scope.users_id = $localStorage.users_data.users_id;
  $scope.users_name = $localStorage.users_data.users_name;
  
  $http({
            method: 'POST',
            url: 'http://'+location.host+'/fetchUpTree',
            data: {'users_id' : $scope.users_id}
        }).then(
        function (response) {
          //$scope.users_data = angular.copy(response.data);

          //IF data is present then show chart
              if(response.data.length > 1) {

                var chart_data = [];

                //for Top level sponsor
                var node = { 
                        id: response.data[0].users_id, title: response.data[0].user_name, name: response.data[0].users_id, img: "../../upload/profile/"+response.data[0].profile_pic
                     };

                chart_data.push(node);

                for (var i = 1; i < response.data.length; i++) {
                  
                  var node = { 
                        id: response.data[i].users_id, pid : response.data[i-1].users_id , title: response.data[i].user_name, name: response.data[i].users_id, img: "../../upload/profile/"+response.data[i].profile_pic
                     };

                     chart_data.push(node);
                }
                console.log(chart_data);

                  var chart = new OrgChart(document.getElementById("orgchart"), {

                    nodeMouseClickBehaviour: BALKANGraph.action.none,
                    showYScroll: BALKANGraph.scroll.visible, 
            mouseScroolBehaviour: BALKANGraph.action.yScroll,
                     template: "diva",
                    enableSearch: false,
                    nodeBinding: {
                        field_0: "name",
                        field_1: "title",
                        img_0: "img"
                    },
                    nodes: chart_data
                });
            }
            //else Data Not Found
            else
            {
              angular.element('#orgchart').html('<h1>Data Not Found</h1>');
            }
        }, function(error) {
          console.log(error);
        });

  }]);
