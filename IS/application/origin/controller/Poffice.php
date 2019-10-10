<?php
namespace app\origin\controller;
use think\Controller;
use app\origin\model\Openletter;
use app\origin\model\Futureletter;
use app\origin\model\Forum_user;
use think\Db;
use think\Cookie;
class Poffice extends Controller{
	public function login($name="",$myid="",$password=""){
		if($name!=""&&$myid!=""&&$password!=""){
			//登录
			$login_selecter=Forum_user::where('username',$name)
											->where('myid',$myid)
											->where('password',$password)
											->find();
			if($login_selecter){
				$rand_num=rand(00000000,99999999);
				Forum_user::where('id', $login_selecter["id"])->update(['rand_num' => $rand_num]);
				$echoer=[];
				$echoer["status"]=0;
				$echoer["user"]["rand_num"]=$rand_num;
				$echoer["user"]["id"]=$login_selecter["id"];
				$echoer["user"]["name"]=$login_selecter["name"];
				$echoer["user"]["myid"]=$login_selecter["myid"];
				$echoer["user"]["classes"]=$login_selecter["classes"];
				$echoer["user"]["type"]=$login_selecter["type"];
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
	public function write_openletter($name="",$myid="",$classes="",$title="",$message="",$user_type=""){
		if($name!=""&&$myid!=""&&$classes!=""&&$title!=""&&$message!=""&&$user_type!=""){
			$time=date("Y-m-d H:i:s");
			$insert=Openletter::create([
								'name'=>$name,
								'myid'=>$myid,
								'classes'=>$classes,
								'title'=>$title,
								'letter'=>$message,
								'time'=>$time,
								'type'=>$user_type
						], ['name', 'myid','classes','title','letter','time','type']);
			if($insert){
				echo json_encode(0);
			}else{
				echo json_encode(1);
			}
		}
	}
	public function future_letter($name="",$myid="",$classes="",$title="",$message="",$timer=""){
		if($name!=""&&$myid!=""&&$classes!=""&&$title!=""&&$message!=""&&$timer!=""){
			$time=date("Y-m-d");
			$insert=Futureletter::create([
								'name'=>$name,
								'myid'=>$myid,
								'classes'=>$classes,
								'title'=>$title,
								'letter'=>$message,
								'time'=>$time,
								'futuretime'=>$timer
						], ['name', 'myid','classes','title','letter','time','futuretime']);
			if($insert){
				echo json_encode(0);
			}else{
				echo json_encode(1);
			}
		}
	}
	public function letter_list($name="",$myid="",$classes=""){
		if($name!=""&&$myid!=""&&$classes!=""){
			$time=time();
			$article_get=Futureletter::where('name',$name)
											->where('myid',$myid)
											->where('classes',$classes)
											->select();
			$length=count($article_get);
			$temp=[];
			for($i=0;$i<$length;$i++){
				$future_time=strtotime($article_get[$i]["futuretime"]);
				if($future_time<$time){
					$temp[$i]=$article_get[$i];
				}else{
					$temp[$i]["name"]=$name;
					$temp[$i]["classes"]=$classes;
					$temp[$i]["title"]=$article_get[$i]["title"];
					$temp[$i]["time"]=$article_get[$i]["time"];
					$temp[$i]["futuretime"]=$article_get[$i]["futuretime"];
					$temp[$i]["letter"]="<small><span style='color: rgb(132, 99, 0);'><strong>收信日期到达后，信件会在下方显示！</strong></span></small>";
				}
			}
			$result=[];
			$result["info"]["name"]=$name;
			$result["info"]["classes"]=$classes;
			$length=count($temp);
			$j=$length-1;
			for($i=0;$i<$length;$i++){
				$result["list"][$i]=$temp[$j];
				$j--;
			}
			echo json_encode($result);
		}
	}
	public function open_letter(){
		$letter_fetch=Openletter::all();
		$length=count($letter_fetch);
			$j=$length-1;
			$letter_back=[];
			for($i=0;$i<$length;$i++){
				$letter_back[$i]=$letter_fetch[$j];
				$j--;
			}
		echo json_encode($letter_back);
	}
	public function letter_info($id=""){
		if($id!=""){
			$article_get=Openletter::where('id',$id)->find();
			echo json_encode($article_get);
		}
	}
}



?>