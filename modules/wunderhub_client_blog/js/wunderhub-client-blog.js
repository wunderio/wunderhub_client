(function ($, Drupal, drupalSettings) {

    "use strict";

    var app = angular.module('wunderhub-client-blog', ['angular.filter']);

    // We need that to use Angular inside Twig templates.
    app.config(function($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    });

    app.controller('WHBlogController', function($scope, $http, $sce, $log) {
        $scope.Team = [];
        $scope.tagText = [];
        $scope.tagText.slug = Drupal.t('Topic: ');

        var url = drupalSettings.wunderhubClientBlog.url,
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
                    item.path = drupalSettings.path.baseUrl + 'blog/' + item.uuid;
                });

                $scope.Blog = data;
            })
            .error(function(data, status, headers, config) {
                $log.error('Could not retrieve data from ' + url);
            });

        $scope.toTrustedHTML = function( html ) {
            return $sce.trustAsHtml( html );
        };
        $scope.toTagText = function( html ) {
            if (html.length) {
                return $scope.tagText.slug + html;
            }
            return;
        };
    });

    app.controller('WHBlogEntryController', function($scope, $http, $sce, $log) {
        $scope.BlogEntry = [];

        var id = drupalSettings.wunderhubClientBlogEntry.uuid,
            url = drupalSettings.wunderhubClientBlogEntry.url + '/' + id,
            req = {
                method: 'GET',
                url: url,
                headers: {
                    Accept: 'application/hal+json'
                }
            };

        $http(req)
            .success(function(data, status, headers, config) {
                $scope.BlogEntry = data.pop();
            })
            .error(function(data, status, headers, config) {
                $log.error('Could not retrieve data from ' + url);
            });

        $scope.toTrustedHTML = function( html ) {
            return $sce.trustAsHtml( html );
        };
    });

})(jQuery, Drupal, drupalSettings);
