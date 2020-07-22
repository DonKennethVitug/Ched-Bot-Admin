(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.factory(
    'adminService', 
    [
      '$log',
      '$http',
      function($log, $http) {
        var adminService = {};

        adminService.fetchSchoolsByRegion = function(region) {
          return $http({
            url: "../server/admin_api/admin_getSchoolsByRegion",
            data: {
              region: region
            },
            method: "POST"
          })
        }

        adminService.fetchCoursesBySchoolId = function(school_id) {
          return $http({
            url: "../server/admin_api/admin_getCoursesBySchoolId",
            data: {
              school_id: school_id
            },
            method: "POST"
          })
        }

        adminService.fetchCoursesOffered = function(school_id) {
          return $http({
            url: "../server/admin_api/admin_getAllCoursesOffered",
            method: "POST"
          })
        }

        adminService.fetchSchools = function() {
          return $http({
            url: "../server/admin_api/admin_getAllSchools",
            method: "POST"
          })
        }

        adminService.fetchCourses = function() {
          return $http({
            url: "../server/admin_api/admin_getAllCourses",
            method: "POST"
          })
        }

        adminService.admin_saveCourseOffered = function(school_id, course_id, description) {
          return $http({
            url: "../server/admin_api/admin_saveCourseOffered",
            method: "POST",
            data: {
              school_id: school_id,
              course_id: course_id,
              description: description
            }
          })
        }

        adminService.deleteCourse = function(id) {
          return $http({
            url: "../server/admin_api/admin_deleteCourses",
            method: "POST",
            data: {
              id: id
            }
          })
        }

        adminService.updateCourse = function(id, school_id, course_id, description) {
          return $http({
            url: "../server/admin_api/admin_updateCourses",
            method: "POST",
            data: {
              id: id,
              school_id: school_id,
              course_id: course_id,
              description: description
            }
          })
        }

        adminService.seeder = function(index) {
          return $http({
            url: "http://bini101.com/ched-test/public/seeder.php?contact_index="+index,
            method: "GET"
          })
        }

        adminService.test = function(index) {
          return $http({
            url: "../server/admin_api/admin_ched_stress_test",
            method: "POST"
          })
        }
        
        return adminService;
      }
    ]
  )

})(angular)