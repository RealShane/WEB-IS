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
class Secondclass extends Controller{
	public function classes(){
		$classes=Dbclasses::all();
		echo json_encode($classes);
	}
	//抛出所有的课程到secondclass视图
	public function course(){
		$all_course=Dbcourse::all();
		echo json_encode($all_course);
	}
	//单个课程显示班级返回此课程页面
	public function singleshowclass($id=""){
		if($id!=""){
			$time=date('Y',time());
			$j=0;
			//查找此课程所有适配的班级并返回
			$res=Dblimit::all();
			$length=count($res);
			for($i=0;$i<$length;$i++){
				$splte=explode(',',$res[$i]["course_ids"]);
				$splte_length=count($splte);
				for($x=0;$x<$splte_length;$x++){
					if($splte[$x]==$id){
						echo json_encode($res[$i]);
						$data[$j]=$res[$i];
						$j++;
					}
				}
			}
			$check=[];
			$length=count($data);
			for($i=0;$i<$length;$i++){
				$factor=$data[$i]["classes_id"];
				$check=Dbclasses::where('id', "$factor")->find();
				$tester=$check["year"];
				$cut=$time-$tester;
				//如果是已毕业年级则不显示
				if($cut>4){
					//什么事都不做
				}else{
					$result[$j]=$check;
					$j++;
				}
			}
		}
  		echo json_encode($result); 
	}
	//显示单个课程信息
	public function singleshowpro($id=""){
		$showpro=Dbcourse::where('id',"$id")->select();
		$this->assign('data',$showpro);
		echo(json_encode($showpro,true));
	}
	
	//报名情况查询
	public function search($studentid="",$classes=""){
		if($studentid!=NULL&&$classes!=NULL){
			//查询学号所在的班级
        	$class=Dbsign::where('studentid',"$studentid")->find();
			$temp_class=$class["classes_id"];
			//匹配classes表适配班级的id并返回名称
			$user_class=Dbsign::hasWhere('Dbclasses',['id'=>"$temp_class"])->find();
			//将返回的数组中的课程名字符串赋值（并非课程id）
			$result["class"]=$user_class->Dbclasses->name;
			//查询学号所选的课程
        	$course=Dbsign::where('studentid',"$studentid")->column('course_id');
			$temp_course=$course[0];
			//匹配course表适配课程的id并返回名称
			$user_course=Dbsign::hasWhere('Dbcourse',['id'=>"$temp_course"])->find();
			//将返回的数组中的课程名字符串赋值（并非课程id）
			$result["course"]=$user_course->Dbcourse->name;
			
			
			$str="SELECT * FROM `sign$classes` WHERE `myid`=$studentid";
			$data=Db::query($str);
			$result["info"]=$data;
			echo json_encode($result);
		}else{
			echo(json_encode("1",true));
		}
    }
	
	//讲师列表抛出
	public function lecturers(){
		$data=Dblecturers::all();
		echo json_encode($data);
	}
	
	//报名方法sign方法
	public function sign($name="",$select="",$pro="",$id=""){
		//输入禁止为空
		if($name!=""&&$select!=""&&$pro!=""&&$id!=""){
			//查询课程剩余量
			$receiver=Dbcourse::where('id',"$pro")
				->lock(true)
				->select();
			$limitsize=$receiver[0]["limitsize"];
			$limitid=$receiver[0]["limitid"];
			//如果课程没报满继续执行
			if($limitid<$limitsize){
				//查询班级和学号是否已被注册
				$judge=Dbsign::where('classes_id',"$select")
							->where('studentid',"$id")
							->find();
				if($judge==NULL){
 					//获取当前服务器时间
					date_default_timezone_set('Asia/Shanghai');
					$time=date('Y',time());
					//执行插入操作
					$insert=Dbsign::create([
    					'studentname'  =>  "$name",
    					'classes_id'  =>  "$select",
    					'course_id' =>  "$pro",
						'studentid'  =>  "$id",
						'year'=>"$time"
						], ['studentname','classes_id','course_id','studentid','year']
					);
					//报名成功使id加1
					$limitid++;
					//使course表里该课程现在报名人数加1
					$changelimitid=Dbcourse::where('id',"$pro")
								->update(['limitid' => "$limitid"]);
					if($changelimitid){
						echo json_encode(0);
					}else{
						echo json_encode(1);
					}
				}else{
					echo json_encode(2);
				}
			}else{
				echo json_encode(3);
			}
		}else{
			echo json_encode(4);
		}
    }
	
	public function tutorial_list(){
		$list_get=Tutorial_release::all();
		$length=count($list_get);
		$j=$length-1;
		$data=[];
		for($i=0;$i<$length;$i++){
			$data[$i]=$list_get[$j];
			$j--;
		}
		echo json_encode($data);
	}
	public function tutorial_info($id=""){
		if($id!=""){
			$article_get=Tutorial_release::where('id',$id)->find();
			$classes_get=Dbclasses::all();
			$back=[];
			$back["list"]=$article_get;
			$back["classes"]=$classes_get;
			echo json_encode($back);
		}
	}
	public function tutorial_sign($name="",$select="",$pro="",$id=""){
		if($name!=""&&$select!=""&&$pro!=""&&$id!=""){
			$article_get=Tutorial_release::where('title',$pro)->find();
			$limit_size=$article_get["limit_size"];
			$limit_now=$article_get["limit_now"];
			if($limit_now<$limit_size){
				$judge=Tutorial_sign::where('type',"$pro")
							->where('myid',"$id")
							->find();
				if($judge==NULL){
					//获取当前服务器时间
					date_default_timezone_set('Asia/Shanghai');
					$time=date('Y',time());
					$insert=Tutorial_sign::create([
    					'name'  =>  $name,
    					'classes_id'  =>  "$select",
    					'type' =>  "$pro",
						'myid'  =>  "$id"
						], ['name','classes_id','type','myid']
					);
					$limit_now++;
					$changelimit_now=Tutorial_release::where('title',$pro)
								->update(['limit_now' => "$limit_now"]);
					if($changelimit_now){
						echo json_encode(0);
					}else{
						echo json_encode(1);
					}
				}else{
					echo json_encode(1);
				}
			}else{
				echo json_encode(1);
			}
		}else{
			echo json_encode(1);
		}
	}
	
	
	
	
	
	
	
}
?>