(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.controller(
    'home.controller',
    [
      '$log',
      function($log) {
        var hc = {};

        hc.model = [];

        var init = function() {
          $log.debug("home.controller initialize");
        };
        init();

        angular.extend(this, {
          model: hc.model
        });
      }
    ]
  )

})(angular)