<?php
namespace app\origin\controller;
use think\Controller;
use app\origin\model\Sdc_data;
use app\origin\model\Sdc_user;
use think\Db;
use think\Cookie;
class Sdc extends Controller{
	public function lists(){
		$classes_all=Sdc_data::distinct(true)->column('classes');
		echo json_encode($classes_all);
	}
	public function data_show($classes=""){
		if($classes!=""){
			$classes_get=Sdc_data::where('classes',$classes)->select();
			echo json_encode($classes_get);
		}
	}
	public function login($user="",$pass=""){
		if($user!=""&&$pass!=""){
			$judge=Sdc_user::where('user',$user)
								->where('pass',$pass)
								->find();
			if($judge){
				$echoer=[];
				$echoer["status"]=200;
				$echoer["user"]["name"]=$judge["name"];
				echo json_encode($echoer);
			}else{
				$echoer=[];
				$echoer["status"]=1;
				echo json_encode($echoer);
			}
		}else{
			$echoer=[];
			$echoer["status"]=2;
			echo json_encode($echoer);
		}
	}
	public function insert_absent($name="",$myid="",$classes="",$is_afl="",$judge="",$ps=""){
		$checkDayStr = date('Y-m-d ',time());
    	$timeBegin1 = strtotime($checkDayStr."07:00".":00");
		$timeEnd1 = strtotime($checkDayStr."08:00".":00");
   		$curr_time = time();
   		if($curr_time >= $timeBegin1 && $curr_time <= $timeEnd1){
			$judge_day=0;
    	}else{
			$judge_day=1;
		}
		$checkDayStr = date('Y-m-d ',time());
    	$timeBegin1 = strtotime($checkDayStr."19:00".":00");
		$timeEnd1 = strtotime($checkDayStr."20:00".":00");
   		$curr_time = time();
   		if($curr_time >= $timeBegin1 && $curr_time <= $timeEnd1){
			$judge_night=0;
    	}else{
			$judge_night=1;
		}
		
		if($judge_day==0||$judge_night==0){
			if($name!=""&&$myid!=""&&$classes!=""&&$is_afl!=""&&$judge!=""&&$ps!=""){
				$timezone_out=date_default_timezone_get();
      			date_default_timezone_set('Asia/Shanghai');
      			$time=date("Y-m-d H:i:s");
      			date_default_timezone_set($timezone_out);
				if($classes=="18计科一班"){
					$str="INSERT INTO `sdc1801`(`name`, `myid`, `classes`, `ps`, `is_afl`, `time`, `judge`) VALUES ('$name','$myid','$classes','$ps','$is_afl','$time','$judge')";
					$insert=Db::execute($str);
				}else if($classes=="18计科二班"){
					$str="INSERT INTO `sdc1802`(`name`, `myid`, `classes`, `ps`, `is_afl`, `time`, `judge`) VALUES ('$name','$myid','$classes','$ps','$is_afl','$time','$judge')";
					$insert=Db::execute($str);
				}else if($classes=="18计科三班"){
					$str="INSERT INTO `sdc1803`(`name`, `myid`, `classes`, `ps`, `is_afl`, `time`, `judge`) VALUES ('$name','$myid','$classes','$ps','$is_afl','$time','$judge')";
					$insert=Db::execute($str);
				}else if($classes=="18通信工程"){
					$str="INSERT INTO `sdc1804`(`name`, `myid`, `classes`, `ps`, `is_afl`, `time`, `judge`) VALUES ('$name','$myid','$classes','$ps','$is_afl','$time','$judge')";
					$insert=Db::execute($str);
				}else if($classes=="18网络工程"){
					$str="INSERT INTO `sdc1805`(`name`, `myid`, `classes`, `ps`, `is_afl`, `time`, `judge`) VALUES ('$name','$myid','$classes','$ps','$is_afl','$time','$judge')";
					$insert=Db::execute($str);
				}else if($classes=="18物联网工程"){
					$str="INSERT INTO `sdc1806`(`name`, `myid`, `classes`, `ps`, `is_afl`, `time`, `judge`) VALUES ('$name','$myid','$classes','$ps','$is_afl','$time','$judge')";
					$insert=Db::execute($str);
				}else if($classes=="18汽车服务工程"){
					$str="INSERT INTO `sdc1807`(`name`, `myid`, `classes`, `ps`, `is_afl`, `time`, `judge`) VALUES ('$name','$myid','$classes','$ps','$is_afl','$time','$judge')";
					$insert=Db::execute($str);
				}
				if($insert){
					echo json_encode(0);
				}
			}else{
				echo json_encode(1);
			}
		}else{
			echo json_encode(2);
		}
	}
}



?>