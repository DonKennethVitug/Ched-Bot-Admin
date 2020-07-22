(function (angular) {

  'use strict';

  var app = angular.module('app');

  app.controller(

    'stress.test.controller',

    [

      '$log',

      'adminService',

      '$timeout',

      'loader',

      '$interval',

      function($log, adminService, $timeout, loader, $interval) {

        var stc = {};

        stc.model = {};

        stc.model.logs = [];

        stc.model.finished = false;

        stc.model.setFinished = function() {
          stc.model.finished = !stc.model.finished;
          console.log(stc.model.finished );
        }

        stc.model.logs = [];

        stc.model.test = function() {

            var i = 0;

            $interval(function() {

              if(stc.model.finished) {

                adminService.test(i).then(

                  function(res) {

                    console.log(res);

                      var today = new Date();

                      var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                      var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                      var dateTime = date+' '+time;

                      res.data = "Date: "+dateTime+".......attempt "+i+".......SUCCESS!";

                      stc.model.logs.push({text:res.data});             

                  },

                  function(err) {

                    console.log(err);

                    var today = new Date();

                    var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    var dateTime = date+' '+time;

                    var res = {};

                    res.data = "Date: "+dateTime+".......attempt "+i+".......FAILED!";

                    stc.model.logs.push({text:res.data}); 

                  }

                )

                i++;

              }

            }, 1000)

        }

        var init = function() {

          $log.debug("stress.test.controller initialize");

        };

        init();

        angular.extend(this, {

          model: stc.model

        });

      }

    ]

  )



})(angular)