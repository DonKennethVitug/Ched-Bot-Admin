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
            name: 'schools.courses',
            url: '/courses/:school_id',
            authenticate: false,
            views: {
              'content@': {
                templateUrl: 'views/schools.courses.html',
                controller: 'schools.courses.controller',
                controllerAs: 'scc'
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