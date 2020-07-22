<?php

date_default_timezone_set("Asia/Manila");

require 'vendor/autoload.php';

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Middleware\EnsureAuthenticated;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->post('/admin_samp', "Controllers\AdminController:admin_samp");
$app->post('/admin_getAllCourses', "Controllers\AdminController:admin_getAllCourses");
$app->post('/admin_getAllCoursesOffered', "Controllers\AdminController:admin_getAllCoursesOffered");
$app->post('/admin_getAllSchools', "Controllers\AdminController:admin_getAllSchools");
$app->post('/admin_getSchoolsByRegion', "Controllers\AdminController:admin_getSchoolsByRegion");
$app->post('/admin_getCoursesBySchoolId', "Controllers\AdminController:admin_getCoursesBySchoolId");
$app->post('/admin_saveCourseOffered', "Controllers\AdminController:admin_saveCourseOffered");
$app->post('/admin_deleteCourses', "Controllers\AdminController:admin_deleteCourses");
$app->post('/admin_updateCourses', "Controllers\AdminController:admin_updateCourses");
$app->post('/admin_ched_stress_test', "Controllers\AdminController:admin_ched_stress_test");

$app->run();