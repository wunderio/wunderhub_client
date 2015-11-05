(function ($, Drupal, drupalSettings) {

  "use strict";

  var app = angular.module('wunderhub-client', ['angular.filter']);

  // We need that to use Angular inside Twig templates.
  app.config(function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  });

  app.controller('WHTeamController', function($scope, $http, $log) {
    $scope.Team = [];

    var url = drupalSettings.wunderhubClient.url,
        req = {
          method: 'GET',
          url: url,
          headers: {
            Accept: 'application/hal+json'
          }
        };

    $http(req)
      .success(function(data, status, headers, config) {
        data.forEach(function (item) {
          item.path = drupalSettings.path.baseUrl + 'team/' + item.uid;
        });

        $scope.Team = data;
      })
      .error(function(data, status, headers, config) {
        $log.error('Could not retrieve data from ' + url);
      });
  });

  app.controller('WHTeamMemberController', function($scope, $http, $sce, $window, $log) {
    $scope.TeamMember = [];

    var id = drupalSettings.wunderhubClient.id,
        url = drupalSettings.wunderhubClient.url + '/' + id,
        req = {
          method: 'GET',
          url: url,
          headers: {
            Accept: 'application/hal+json'
          }
        };

    $http(req)
      .success(function(data, status, headers, config) {
        $scope.TeamMember = data.pop();
        if (typeof $scope.TeamMember === 'undefined') {
          $window.location.href = '/system/404';
        }
      })
      .error(function(data, status, headers, config) {
        $log.error('Could not retrieve data from ' + url);
        $window.location.href = '/system/404';
      });

    $scope.toTrustedHTML = function( html ) {
      return $sce.trustAsHtml( html );
    };
  });

})(jQuery, Drupal, drupalSettings);
