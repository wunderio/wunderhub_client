(function() {
  var app = angular.module('wunderhub-client', ['angular.filter']);

  app.controller('WHTeamController', function ($scope, $http, $log) {
    $scope.Team = [];
    var url = Drupal.settings.wunderhubClient.team_url,
        req = {
          method: 'GET',
          url: url,
          headers: {
            Accept: 'application/hal+json'
          }
        };

    $http(req)
      .success(function (data, status, headers, config) {
        data.forEach(function (item) {
          item.path = Drupal.settings.basePath + 'team/' + item.uid;
          item.randomSort = 0.5 - Math.random();
        });

        $scope.Team = data;

        $scope.Group = Drupal.settings.wunderhubClient.group;
        $scope.Sort = Drupal.settings.wunderhubClient.sort;
      })
      .error(function (data, status, headers, config) {
        $log.error('Could not retrieve data from ' + url);
      });
  });

  app.controller('WHTeamMemberController', function ($scope, $http, $log) {
    $scope.TeamMember = [];

    var id = Drupal.settings.wunderhubClient.id,
        url = Drupal.settings.wunderhubClient.team_url + '/' + id,
        req = {
          method: 'GET',
          url: url,
          headers: {
            Accept: 'application/hal+json'
          }
        };

    $http(req)
      .success(function (data, status, headers, config) {
        $scope.TeamMember = data.pop();
      })
      .error(function (data, status, headers, config) {
        $log.error('Could not retrieve data from ' + url);
      });
  });
})();
