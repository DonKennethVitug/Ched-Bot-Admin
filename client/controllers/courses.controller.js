(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.filter('reverse', function() {
    return function(items) {
      if(items) {
        return items.slice().reverse();  
      }
    };
  });

  app.controller(
    'courses.controller',
    [
      '$log',
      function($log, adminService) {
        var sc = {};

        sc.model = {};

        sc.model.courses = [];

        var fetchCourses = function(schoolId) {
          adminService.fetchCoursesBySchoolId(schoolId).then(
            function(res) {
              sc.model.courses = res.data;
            },
            function(err) {

            }
          )
        }

        var init = function() {
          $log.debug("courses.controller initialize");
          //fetchCourses("all");
        };
        init();

        angular.extend(this, {
          model: sc.model,
          fetchCourses: fetchCourses
        });
      }
    ]
  )

})(angular)