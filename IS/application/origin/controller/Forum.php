<?php
namespace app\origin\controller;
use think\Controller;
use app\origin\model\Forum_module;
use app\origin\model\Forum_user;
use app\origin\model\Forum_comment;
use app\origin\model\Article;
use think\Db;
use think\Cookie;
class Forum extends Controller{
	public function index(){
		$module_get=Forum_module::all();
		echo json_encode($module_get);
	}
	public function write($name="",$classes="",$title="",$txt="",$type=""){
		if($name!=""&&$classes!=""&&$title!=""&&$txt!=""&&$type!=""){
			$time=date("Y-m-d");
			$insert=Article::create([
								'author'=>$name,
								'classes'=>$classes,
								'titlecontent'=>$title,
								'txtcontent'=>$txt,
								'type'=>$type,
								'time'=>$time
						], ['author','classes','titlecontent','txtcontent','type','time']);
			if($insert){
				echo json_encode(0);
			}else{
				echo json_encode(1);
			}
		}
	}
	public function login($name="",$myid="",$password=""){
		if($name!=""&&$myid!=""&&$password!=""){
			$login_selecter=Forum_user::where('username',$name)
											->where('myid',$myid)
											->where('password',$password)
											->find();
			if($login_selecter){
				//登录成功
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
	public function forum_list($id=""){
		if($id!=""){
			$module_info=Forum_module::where('type',$id)->find();
			$article_get=Article::where('type',$id)->where('verify','通过')->select();
			
			$length=count($article_get);
			$j=$length-1;
			$data=[];
			for($i=0;$i<$length;$i++){
				$data[$i]=$article_get[$j];
				$j--;
			}
			
			$back=[];
			$back["title"]=$module_info["module"];
			$back["p"]=$module_info["description"];
			$back["list"]=$data;
			echo json_encode($back);
		}
	}
	public function info($id=""){
		if($id!=""){
			$article_get=Article::where('id',$id)->where('verify','通过')->find();
			echo json_encode($article_get);
		}
	}
	public function comment_show($id=""){
		if($id!=""){
			$comment_get=Forum_comment::where('belong',$id)->order('id desc')->select();
			echo json_encode($comment_get);
		}
	}
	public function comment($name="",$classes="",$creed="",$comment="",$type=""){
		if($name!=""&&$classes!=""&&$creed!=""&&$comment!=""&&$type!=""){
			$timezone_out=date_default_timezone_get();
      		date_default_timezone_set('Asia/Shanghai');
      		$time=date("Y-m-d H:i:s");
      		date_default_timezone_set($timezone_out);
			$insert=Forum_comment::create([
								'name'=>$name,
								'classes'=>$classes,
								'comment'=>$comment,
								'belong'=>$creed,
								'time'=>$time,
								'type'=>$type
						], ['name','classes','comment','belong','time','type']);
			if($insert){
				echo json_encode(0);
			}else{
				echo json_encode(1);
			}
		}
	}
	public function registerfunc($username="",$password="",$email="",$name="",$classes="",$myid=""){
		if($username!=""&&$password!=""&&$email!=""&&$name!=""&&$classes!=""&&$myid!=""){
			$is_sim_name=Forum_user::where('name',$name)->find();
			$is_sim_username=Forum_user::where('username',$username)->find();
			$is_sim_myid=Forum_user::where('myid',$myid)->find();
			$is_sim_email=Forum_user::where('email',$email)->find();
			if($is_sim_name==NULL){
				if($is_sim_username==NULL){
					if($is_sim_myid==NULL){
						if($is_sim_email==NULL){
							$insert=Forum_user::create([
											'username'=>$username,
											'password'=>$password,
											'email'=>$email,
											'name'=>$name,
											'classes'=>$classes,
											'myid'=>$myid,
											'type'=>"正式成员",
											'comment'=>"可以"
										], ['username','password','email','name','classes','myid','type','comment']);
							if($insert){
								$echoer=[];
								$echoer["message"]="注册成功！";
								$echoer["is_success"]=0;
								echo json_encode($echoer);
							}else{
								$echoer=[];
								$echoer["message"]="网络原因注册失败！";
								$echoer["is_success"]=1;
								echo json_encode($echoer);
							}
						}else{
							$echoer=[];
							$echoer["message"]="邮箱已被注册！";
							$echoer["is_success"]=1;
							echo json_encode($echoer);
						}
					}else{
						$echoer=[];
						$echoer["message"]="学号已被注册！";
						$echoer["is_success"]=1;
						echo json_encode($echoer);
					}
				}else{
					$echoer=[];
					$echoer["message"]="用户名已被注册！";
					$echoer["is_success"]=1;
					echo json_encode($echoer);
				}
			}else{
				$echoer=[];
				$echoer["message"]="姓名已被注册！";
				$echoer["is_success"]=1;
				echo json_encode($echoer);
			}
		}else{
			$echoer=[];
			$echoer["message"]="禁止填写为空！";
			$echoer["is_success"]=1;
			echo json_encode($echoer);
		}
	}
}



?>