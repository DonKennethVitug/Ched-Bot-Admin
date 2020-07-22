<?php

namespace Models;

use \PDO;
use \PDOException;
use Helpers\DB as DB;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

require 'config.php';

class AdminModel extends DB{

    public static $data;
    private $db;

    public function __construct() {
        $this->db = new Capsule;
        $this->db->addConnection([
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USERNAME,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $this->db->setAsGlobal();
        
        $this->db->bootEloquent();

    }

    public function admin_samp($request){

        $res = DB::ins()->select_fetch("bot_schools", "address");

        $res = json_decode(json_encode($res), true);

        self::$data = json_encode($res);

        return true;     

    }

    public function admin_saveCourseOffered($request){

        $req = $request->getParsedBody();

        $school_id = $req['school_id'];
        $course_id = $req['course_id'];
        $description = $req['description'];

        // $this->db->table('bot_leads_meta')->insert([
        //             'user_id' => $lead_id,
        //             'meta_key' => $key,
        //             'meta_value' => $value
        //         ]);

        $res = DB::ins()->query("INSERT INTO `bot_courses_offered` (`school_id`, `course_id`, `description`) VALUES ('".$school_id."', '".$course_id."', '".$description."')");

        //self::$data = json_encode($res);

        if($res) {
            return true;
        }

        return true;    

    }

    public function admin_deleteCourses($request){

        $req = $request->getParsedBody();

        $id = $req['id'];

        $res = DB::ins()->delete("bot_courses_offered", "id=$id");

        if($res) {
            return true;
        }

        return true;    

    }

    public function admin_updateCourses($request){

        $req = $request->getParsedBody();

        $id = $req['id'];
        $school_id = $req['school_id'];
        $course_id = $req['course_id'];
        $description = $req['description'];

        if(DB::ins()->update("bot_courses_offered", "school_id=$school_id, course_id=$course_id, description=$description", "id=$id")){
            return true;
        } else {
            return false;
        }   

    }

    public function admin_getAllCourses($request){

        $results = DB::ins()->select_fetch('v_bot_courses', '*');

        self::$data = json_encode($results);

    	return true;    

    }

    public function admin_getAllCoursesOffered($request){

        $results = DB::ins()->select_fetch('v_course_offered', '*');

        self::$data = json_encode($results);

        return true;   

    }

    public function admin_getAllSchools($request){

        $results = DB::ins()->select_fetch('bot_schools', 'school_name, id');

        self::$data = json_encode($results);

        return true;     

    }

    public function admin_getSchoolsByRegion($request){

        $request = $request->getParsedBody();

        $region = $request['region'] ? $request['region'] : "all";

        if($region == "all") {
            $res = DB::ins()->select_fetch("bot_schools", "school_name");    
        } else {
            $res = DB::ins()->select_fetch("bot_schools", "*", "region=$region");     
        }

        self::$data = json_encode($res);

        return true;    

    }

    public function admin_getCoursesBySchoolId($request){

        $request = $request->getParsedBody();

        $region = $request['school_id'] ? $request['school_id'] : false;

        if($region) {
            $res = DB::ins()->select_fetch("bot_courses", "*", "school_id=$school_id");    
        } else {
            $res = DB::ins()->select_fetch("bot_courses", "*");     
        }

        self::$data = json_encode($res);

        return true;    

    }

    public function admin_ched_stress_test($request){

        $tables = ["bot_course_category", "bot_courses", "bot_courses_offered", "bot_islands", "bot_leads", "bot_levels"];

        $count = 0;

        foreach ($tables as $table) {
            $res = DB::ins()->select_fetch($table, "*");
            if(!$res) {
                return false;
            } 
            $count += count($res);
        }  

        self::$data = json_encode([
            "count" => $count
        ]);

        return true;

    }

}