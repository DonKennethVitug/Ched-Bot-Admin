(function (angular) {

  'use strict';

  var app = angular.module('app');



  app.controller(

    'seeder.controller',

    [

      '$log',

      'adminService',

      '$timeout',

      'loader',

      function($log, adminService, $timeout, loader) {

        var sc = {};



        sc.model = {};

        sc.model.logs = [];



        sc.model.seeder = function() {

          loader.start();

          sc.model.logs = [];

          var i = 1;

          for(i;i<=121;i+=20) {

            adminService.seeder(i).then(

              function(res) {

                

                  if(!res.data.replace(/[\s]/g, '')) {

                    res.data = "Seeder Finished";

                    loader.stop();

                  }

                  sc.model.logs.push({text:res.data});

                

              },

              function(err) {

                console.log(err);

              }

            )

          }

        }



        var init = function() {

          $log.debug("seeder.controller initialize");

        };

        init();



        angular.extend(this, {

          model: sc.model

        });

      }

    ]

  )



})(angular)