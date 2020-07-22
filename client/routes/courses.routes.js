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
            name: 'courses',
            url: '/courses',
            authenticate: false,
            views: {
              'content@': {
                templateUrl: 'views/courses.html',
                controller: 'courses.controller',
                controllerAs: 'cc'
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