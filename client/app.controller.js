(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.controller(
    'app.controller',
    [
      '$log',
      function($log) {

        var ac = {};

        var init = function() {
          $log.debug("app.controller initialize");
        };
        init();

        angular.extend(this, {

        });
      }
    ]
  )

})(angular)