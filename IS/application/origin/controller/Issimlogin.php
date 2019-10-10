<?php
namespace app\origin\controller;
use think\Controller;
use app\origin\model\Forum_user;
use think\Db;
use think\Cookie;
class Issimlogin extends Controller{
	public function is_sim_login($id="",$rand_num=""){
		if($id!=""&&$rand_num!=""){
			$info_fetch=Forum_user::where('id',$id)
											->where('rand_num',$rand_num)
											->find();
			if($info_fetch!=""){
				$echoer=[];
				$echoer["is_sim_login"]=false;
				echo json_encode($echoer);
			}else{
				$echoer=[];
				$echoer["is_sim_login"]=true;
				echo json_encode($echoer);
			}
		}else{
			$echoer=[];
			$echoer["is_sim_login"]="empty";
			echo json_encode($echoer);
		}
	}
}



?>