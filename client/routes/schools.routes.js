(function (angular) {
  'use strict';
  var app = angular.module('app');
  app.config(
    [
      '$stateProvider',
      '$urlRouterProvider',
      function($stateProvider, $urlRouterProvider) {
        var states = [
          {
            name: 'schools',
            url: '/schools',
            authenticate: false,
            views: {
              'content@': {
                templateUrl: 'views/schools.html',
                controller: 'schools.controller',
                controllerAs: 'sc'
              }
            }
          }
        ]
        for (var i=0; i<states.length; i++) {
          $stateProvider.state(states[i]);
        }
      }
    ]
  )
}(angular))