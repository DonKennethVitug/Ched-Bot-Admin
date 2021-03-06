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

            name: 'stress-test',

            url: '/stress-test',

            authenticate: false,

            views: {

              'content@': {

                templateUrl: 'views/stress.test.html',

                controller: 'stress.test.controller',

                controllerAs: 'stc'

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