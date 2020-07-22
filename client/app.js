(function (angular) {
  'use strict';
  var app = angular.module(
    'app',
    [
      'ui.router'
    ]
  ).config(
    [
      '$logProvider',
      function($logProvider) {
        $logProvider.debugEnabled(true);
      }
    ]
  ).run(
    [
      '$log',
      '$rootScope',
      'loader',
      function($log, $rootScope, loader) {
        $log.debug("app Initialize");
        loader.stop();
      }
    ]
  )
})(angular);