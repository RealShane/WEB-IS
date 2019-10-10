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
class Secondscript extends Controller{
	public function add_up(){
		$data=Dbsign::all();
		for($i=0;$i<count($data);$i++){
			$classes=$data[$i]["classes_id"];
			$myid=$data[$i]["studentid"];
			$str="SELECT * FROM `sign$classes` WHERE `myid` = $myid LIMIT 1";
			$query=Db::query($str);
			if($query==NULL){
				$tutorial_find=Tutorial_sign::where('myid',$data[$i]["studentid"])->select();
				$tutorial_mark=0;
				$tutorial_mark_str="";
				$tutorial_mark_type="";
			
				$name=$data[$i]["studentname"];
				$course_id=$data[$i]["course_id"];
				$year=$data[$i]["year"];
			
				$course_mark=$data[$i]["signmark"];
				for($j=0;$j<count($tutorial_find);$j++){
					$tutorial_mark=$tutorial_mark+$tutorial_find[$j]["signmark"];
					$tutorial_mark_str=$tutorial_mark_str."-".$tutorial_find[$j]["signmark"];
					$tutorial_mark_type=$tutorial_mark_type."-".$tutorial_find[$j]["type"];
				}
				$allmark=$course_mark+$tutorial_mark;
				$str="INSERT INTO `sign$classes`(`name`, `myid`, `course_id`, `type`, `classes_id`, `signmark`, `tutorialmark`, `allmark`, `year`) VALUES ('$name',$myid,$course_id,'$tutorial_mark_type',$classes,$course_mark,'$tutorial_mark_str',$allmark,$year)";
				$execute=Db::execute($str);
			}else{
				echo("别再执行了，执行过了</br>");
			}
		}
		$result=Tutorial_sign::all();
		//获取当前服务器时间
		date_default_timezone_set('Asia/Shanghai');
		$time=date('Y',time());
		for($i=0;$i<count($result);$i++){
			$classes=$result[$i]["classes_id"];
			$myid=$result[$i]["myid"];
			$str="SELECT * FROM `sign$classes` WHERE `myid` = $myid LIMIT 1";
			$query=Db::query($str);
			if($query==NULL){
				$find=Tutorial_sign::where('myid',$myid)->select();
				$mark=0;
				$mark_str="";
				$mark_type="";
				
				$name=$result[$i]["name"];
				
				for($j=0;$j<count($find);$j++){
					$mark=$mark+$find[$j]["signmark"];
					$mark_str=$mark_str."-".$find[$j]["signmark"];
					$mark_type=$mark_type."-".$find[$j]["type"];
				}
				$str="INSERT INTO `sign$classes`(`name`, `myid`, `type`, `classes_id`, `tutorialmark`, `allmark`, `year`) VALUES ('$name',$myid,'$mark_type',$classes,'$mark_str',$mark,$time)";
				$execute=Db::execute($str);
			}else{
				echo("别再执行了，执行过了</br>");
			}
		}
	}
	public function add_course(){
		$data=Dbsign::all();
		for($i=0;$i<count($data);$i++){
			$name=$data[$i]["studentname"];
			$class_id=$data[$i]["classes_id"];
			$course=$data[$i]["course_id"];
			$myid=$data[$i]["studentid"];
			$str="SELECT * FROM `classes` WHERE `id`= $class_id";
			$query=Db::query($str);
			echo json_encode($query);
			$classes=$query[0]["name"];
			$str="SELECT * FROM `course_$course` WHERE `myid` = $myid LIMIT 1";
			$query=Db::query($str);
			if($query==NULL){
				echo json_encode($myid);
				$str="INSERT INTO `course_$course`(`name`, `myid`, `classes`) VALUES ('$name',$myid,'$classes')";
				$execute=Db::execute($str);
			}else{
				echo("别再执行了，执行过了</br>");
			}
		}
	}
	public function insert(){
		$sheet="CREATE TABLE IF NOT EXISTS `sign1806`(
    		`id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
			`name` varchar(10) NULL COMMENT '学生姓名',
			`myid` int(10) unsigned NULL COMMENT '学生学号',
			`course_id` int(10) NULL COMMENT '所选大课课程',
			`type` text NULL COMMENT '所选小课课程',
			`classes_id` int(10) NULL COMMENT '学生所在班级id',
			`signmark` int(10) NULL COMMENT '大课分数',
			`tutorialmark` varchar(100) NULL COMMENT '小课分数',
			`allmark` varchar(10) NULL COMMENT '总分数',
			`year` int(10) NULL COMMENT '年份',
      		PRIMARY KEY (`id`)
    		)ENGINE=InnoDB
    		DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci";
		$make=Db::execute($sheet);
		echo($make);
	}
	
	
}
?>

















