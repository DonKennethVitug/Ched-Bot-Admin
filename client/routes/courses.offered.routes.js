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
            name: 'courses_offered',
            url: '/courses_offered',
            authenticate: false,
            views: {
              'content@': {
                templateUrl: 'views/course.offered.html',
                controller: 'courses.offered.controller',
                controllerAs: 'coc'
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