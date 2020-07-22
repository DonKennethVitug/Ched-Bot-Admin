<?php

namespace Controllers;

use Models\AdminModel as Model;

class AdminController {

	public function admin_samp($request, $response){
		$model = new Model();
		$output = $model->admin_samp($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_ched_stress_test($request, $response){
		$model = new Model();
		$output = $model->admin_ched_stress_test($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_updateCourses($request, $response){
		$model = new Model();
		$output = $model->admin_updateCourses($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_deleteCourses($request, $response){
		$model = new Model();
		$output = $model->admin_deleteCourses($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_getAllCourses($request, $response){
		$model = new Model();
		$output = $model->admin_getAllCourses($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_getAllCoursesOffered($request, $response){
		$model = new Model();
		$output = $model->admin_getAllCoursesOffered($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_getAllSchools($request, $response){
		$model = new Model();
		$output = $model->admin_getAllSchools($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_getSchoolsByRegion($request, $response){
		$model = new Model();
		$output = $model->admin_getSchoolsByRegion($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

	public function admin_saveCourseOffered($request, $response){
		$model = new Model();
		$output = $model->admin_saveCourseOffered($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}


	public function admin_getCoursesBySchoolId($request, $response){
		$model = new Model();
		$output = $model->admin_getCoursesBySchoolId($request);
		if($output){
			return $response->withStatus(200)
							->withHeader('Content-Type', 'application/json')
							->write(Model::$data);
		}
		else{
			return $response->withStatus(400);
		}
	}

}