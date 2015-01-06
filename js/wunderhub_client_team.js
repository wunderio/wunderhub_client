if (typeof angular !== 'undefined') {

  angular.module('wunderhub_client', [])

  .controller('WHTeamController', function ($scope, $sce, $http, $log) {
    $scope.Team = [];
    var url = Drupal.settings.wunderhub_client_team_url;

    if (url) {
      $http.jsonp(url).
        success(function(data, status, headers, config) {
          data.forEach(function(item){
            item.picture = $sce.trustAsHtml(item.picture);
            item.team_page_url = 'team/' + item.uid;
          });

          $scope.Team = data;
        }).
        error(function(data, status, headers, config) {
          $log.error('Could not retrieve data from ' + url);
        });
    }
  })

  .controller('WHTeamMemberController', function ($scope, $sce, $http, $log) {
    $scope.TeamMember = [];

    var uid = Drupal.settings.wunder_uid;
    var url = Drupal.settings.wunderhub_client_team_member_url + '/' + uid;

    if (url) {
      var req = {
        method: 'GET',
        url: url,
        headers: {
          'Accept': 'application/hal+json'
        }
      };

      $http(req).
        success(function(data, status, headers, config) {
          $scope.TeamMember = data.pop();
          $scope.TeamMember.picture = $sce.trustAsHtml($scope.TeamMember.picture);
        }).
        error(function(data, status, headers, config) {
          $log.error('Could not retrieve data from ' + url);
        });
    }
  });
}
