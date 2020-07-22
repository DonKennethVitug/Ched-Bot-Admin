(function (angular) {
  'use strict';
  var app = angular.module('app');

  app.controller(
    'courses.offered.controller',
    [
      '$log',
      'loader',
      'adminService',
      function($log, loader, adminService) {
        var coc = {};
        coc.model = {};

        coc.model.courseOffered = [];

        coc.model.admin = [];

        var fetchCoursesOffered = function() {
          loader.start();
          adminService.fetchCoursesOffered().then(
            function(res) {
              coc.model.courseOffered = res.data;
              loader.stop();
            }
          )
        }

        var fetchSchools = function() {
          loader.start();
          adminService.fetchSchools().then(
            function(res) {
              coc.model.schools = res.data;
              loader.stop();
            }
          )
        }

        var fetchCourses = function() {
          loader.start();
          adminService.fetchCourses().then(
            function(res) {
              coc.model.courses = res.data;
              loader.stop();
            }
          )
        }

        var admin_saveCourseOffered = function(a, b, c) {
          loader.start();
          adminService.admin_saveCourseOffered(a,b,c).then(
            function(res) {
              loader.stop();
              fetchCoursesOffered();  
              coc.model.course_id = "";
              coc.model.description = "";
            },
            function() {
              loader.stop();
              alert("input incorrect!");
            }
          )
        }

        var admin_delete = function(id) {
          loader.start();
          adminService.deleteCourse(id).then(
            function(res) {
              loader.stop();
              fetchCoursesOffered();
            },
            function(err) {

            }
          )
        }

        var admin_update = function(course) {
          loader.start();
          adminService.updateCourse(course.id, course.school_id, course.course_id, course.description).then(
            function(res) {
              loader.stop();
              fetchCoursesOffered();
            },
            function(err) {

            }
          )
        }

        var init = function() {
          loader.start();
          $log.debug("courses.offered.controller initialize");
          fetchCoursesOffered();
          fetchSchools();
          fetchCourses();
        };
        init();

        angular.extend(this, {
          model: coc.model,
          admin: coc.model.admin,
          admin_saveCourseOffered: admin_saveCourseOffered,
          delete: admin_delete,
          update: admin_update
        });
      }
    ]
  )

})(angular)