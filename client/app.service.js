(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.factory(
    'appService',
    [
      '$log',
      function ($log) {
        var appService = {};

        return appService;
      }
    ]
  );

  app.factory(
    'loader',
    [
      function () {

        var loader = {};

        loader.start = function() {
          angular.element(document.querySelector("#loader")).removeClass("hidden");
          angular.element(document.querySelector("#page-container")).addClass("hidden");
        }

        loader.stop = function() {
          angular.element(document.querySelector("#loader")).addClass("hidden");
          angular.element(document.querySelector("#page-container")).removeClass("hidden");
        }
        
        return loader;
      }
    ]
  );

})(angular);