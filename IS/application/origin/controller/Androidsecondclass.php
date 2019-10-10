<?php
namespace app\origin\controller;
use think\Controller;
use app\origin\model\Dbsign;
use app\origin\model\Dblimit;
use app\origin\model\Dbclasses;
use app\origin\model\Dbcourse;
use app\origin\model\Dblecturers;
use app\origin\model\Tutorial_sign;
use app\origin\model\Tutorial_release;
use think\Db;
use think\Cookie;
class Androidsecondclass extends Controller{
	//抛出所有的课程到secondclass视图
	public function course(){
		$all_course=Dbcourse::all();
		for($i=0;$i<count($all_course);$i++){
			$all_course[$i]["imgimage"]="https://serv.huihuagongxue.top/IS/public".$all_course[$i]["imgimage"];
		}
		$Android_course=[];
		$Android_course["all_course"]=$all_course;
		echo json_encode($Android_course);
	}
	
	
	//讲师列表抛出
	public function lecturers(){
		$all_lecture=Dblecturers::all();
		for($i=0;$i<count($data);$i++){
			$all_lecture[$i]["imgimage"]="https://serv.huihuagongxue.top/IS/public".$all_lecture[$i]["imgimage"];
		}
		$Android_lecture=[];
		$Android_lecture["all_lectures"]=$all_lecture;
		echo json_encode($Android_lecture);
	}
	
	//班级列表抛出
	public function classes(){
		$all_classes=Dbclasses::all();
		$Android_classes=[];
		$Android_classes["all_classes"]=$all_classes;
		echo json_encode($Android_classes);
	}
	
	
}
?>