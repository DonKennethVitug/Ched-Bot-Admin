(function (angular) {
  'use strict';
  var app = angular.module('app');
  app.config(
    [
      '$stateProvider',
      '$urlRouterProvider',
      function($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise("stress-test");
        var states = [
          {
            name: 'home',
            url: '/home',
            authenticate: false,
            resolve: {

            },
            views: {
              'content': {
                templateUrl: 'views/home.html',
                controller: 'home.controller',
                controllerAs: 'hc'
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