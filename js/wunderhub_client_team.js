if (typeof angular !== 'undefined') {
  angular.module('wunderhub_client', []).controller('WHTeamController', function ($scope, $sce, $http, $log) {
    $scope.Team = [];
    var url = Drupal.settings.wunderhub_client_team_url;

    if (url) {
      $http.jsonp(url).
        success(function(data, status, headers, config) {
          data.forEach(function(item){
            item.picture = $sce.trustAsHtml(item.picture);
          });

          $scope.Team = data;
        }).
        error(function(data, status, headers, config) {
          $log.error('Could not retrieve data from ' + url);
        });
    }
  });
}
