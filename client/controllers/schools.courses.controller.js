(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.controller(
    'schools.courses.controller',
    [
      '$log',
      'adminService',
      function($log, adminService) {
        var sc = {};

        sc.model = {};

        sc.model.schools = [];

        var fetchSchools = function(region) {
          adminService.fetchSchoolsByRegion(region).then(
            function(res) {
              sc.model.schools = res.data;
            },
            function(err) {

            }
          )
        }

        var init = function() {
          $log.debug("schools.courses.controller initialize");
        };
        init();

        angular.extend(this, {
          model: sc.model,
          fetchSchools: fetchSchools
        });
      }
    ]
  )

})(angular)