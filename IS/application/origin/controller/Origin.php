<?php
namespace app\origin\controller;
use think\Controller;
use think\Db;
class Origin extends Controller{
	public function login($name="",$myid="",$classes=""){
		if($classes!=""&&$name!=""&&$myid!=""){
			//登录
			$str="SELECT * FROM `zc$classes` WHERE  `name` = '$name'  AND `myid` = $myid LIMIT 1";
			$login_selecter=Db::query($str);
			if($login_selecter){
				//登录成功
				$echoer=[];
				$echoer["status"]=100;
				$echoer["user"]["id"]=$login_selecter[0]["id"];
				$echoer["user"]["name"]=$login_selecter[0]["name"];
				$echoer["user"]["myid"]=$login_selecter[0]["myid"];
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
	/****************分割线****************/
	public function show($name="",$myid="",$classes=""){
		//$name$myid$classes将会由登录之后存储的cookie进行发送 如没有登录过的状态将重新登录
		if($classes!=""&&$name!=""&&$myid!=""){
			//获取此班级所有人的数据
			$str="SELECT * FROM `zc$classes` WHERE 1";
			$data=Db::query($str);
			//计算此班级人数
			$length=count($data);
			$echoer=[];
			//json数据返回计数器(从1开始的计数器)
			$j=1;
			//将重新生成数据去除登录者的信息
			for($i=1;$i<=$length;$i++){
				//按自增id遍历查找
				$str="SELECT * FROM `zc$classes` WHERE  `id` = $i LIMIT 1";
				$query=Db::query($str);
				//如果查找到的数据不是本人则加入返回器echoer内
				if($query[0]["myid"]!=$myid){
					$echoer["data"][$j]=$query;
					$j++;
				}
			}
			//返回数据个数
			$echoer["len"]=$j-1;
			//返回器返回数据
			echo json_encode($echoer);
		}else{
			echo("请先登录");
		}
	}
	public function showsingle($name="",$myid="",$classes="",$target=""){
		//$name$myid$classes将会由登录之后存储的cookie进行发送 如没有登录过的状态将重新登录
		if($classes!=""&&$name!=""&&$myid!=""&&$target!=""){
			//获取此人的数据
			$str="SELECT * FROM `zc$classes` WHERE  `myid` = $target LIMIT 1";
			$data=Db::query($str);
			//返回器返回数据
			echo json_encode($data);
		}else{
			echo("请先登录");
		}
	}
	public function score($myid="",$classes="",$target="",$mark=""){
		//$myid$classes是登录者的信息从之前登录过的cookie中获得
		if($classes!=""&&$myid!=""&&$target!=""&&$mark!=""){
			//如果登录者选择人的分数不等于null则无法再次测评
			$str="SELECT * FROM `zc$classes` WHERE  `myid` = $target LIMIT 1";
			$isnull=Db::query($str);
			$judge=$isnull[0]["zc".$myid];
			//判断是否为null
			if($judge==""){
				$str="UPDATE `zc$classes` SET `zc$myid`=$mark WHERE `myid`=$target";
				$insert=Db::execute($str);
				if($insert!=0){
					echo(0);
				}else{
					echo(3);
				}
			}else{
				echo(2);
			}
		}else{
			echo(1);
		}
	}
	/****************分割线****************/
	public function sign_pk($name="",$myid="",$classes="",$message="",$type=""){
		echo(55);exit;//截止报名方法
		if($name!=""&&$myid!=""&&$classes!=""&&$message!=""&&$type!=""){
			$str="SELECT * FROM `pk$classes` WHERE  `myid` = $myid LIMIT 1";
			$is_sign=Db::execute($str);
			if($is_sign==0){
				$str="INSERT INTO `pk$classes`(`name`, `myid`, `message`,`type`) VALUES ('$name',$myid,'$message','$type')";
				$insert=Db::execute($str);
				if($insert){
					echo(0);
				}else{
					echo(1);
				}
			}else{
				echo(2);
			}
		}else{
			echo(4);
		}
	}
	public function showpk($name="",$myid="",$classes=""){
		if($name!=""&&$myid!=""&&$classes!=""){
			//获取此班级所有人的数据
			$str="SELECT * FROM `pk$classes` WHERE 1";
			$data=Db::query($str);
			//计算此班级人数
			$length=count($data);
			$echoer=[];
			//json数据返回计数器(从1开始的计数器)
			$j=1;
			//将重新生成数据去除登录者的信息
			for($i=1;$i<=$length;$i++){
				//按自增id遍历查找
				$str="SELECT * FROM `pk$classes` WHERE  `id` = $i LIMIT 1";
				$query=Db::query($str);
				//如果查找到的数据不是本人则加入返回器echoer内
				if($query[0]["myid"]!=$myid){
					$echoer["data"][$j]=$query;
					$j++;
				}
			}
			//返回数据个数
			$echoer["len"]=$j-1;
			//返回器返回数据
			echo json_encode($echoer);
		}
	}
	public function showsinglepk($name="",$myid="",$classes="",$target=""){
		//$name$myid$classes将会由登录之后存储的cookie进行发送 如没有登录过的状态将重新登录
		if($classes!=""&&$name!=""&&$myid!=""&&$target!=""){
			//获取此人的数据
			$str="SELECT * FROM `pk$classes` WHERE  `myid` = $target LIMIT 1";
			$data=Db::query($str);
			//返回器返回数据
			echo json_encode($data);
		}else{
			echo("请先登录");
		}
	}
	public function scorepk($myid="",$classes="",$target="",$mark=""){
		//$myid$classes是登录者的信息从之前登录过的cookie中获得
		if($classes!=""&&$myid!=""&&$target!=""&&$mark!=""){
			//如果登录者选择人的分数不等于null则无法再次测评
			$str="SELECT * FROM `pk$classes` WHERE  `myid` = $target LIMIT 1";
			$isnull=Db::query($str);
			$judge=$isnull[0]["zc".$myid];
			//判断是否为null
			if($judge==""){
				$str="SELECT * FROM `pk$classes`";
				$length=Db::execute($str);
				$count=0;
				for($i=1;$i<=$length;$i++){
					$str="SELECT * FROM `pk$classes` WHERE `id`=$i";
					$query=Db::query($str);
					if($query[0]["zc".$myid]!=""){
						$count++;
					}
					if($classes==1801){
						if($count>=15){
							break;
						}
					}else if($classes==1802){
						if($count>=11){
							break;
						}
					}else if($classes==1803){
						if($count>=11){
							break;
						}
					}else if($classes==1804){
						if($count>=10){
							break;
						}
					}
				}
				if($classes==1801){
					if($count<15){
						$str="UPDATE `pk$classes` SET `zc$myid`=$mark WHERE `myid`=$target";
						$insert=Db::execute($str);
					}else{
						$insert=4;
					}
				}else if($classes==1802){
					if($count<11){
						$str="UPDATE `pk$classes` SET `zc$myid`=$mark WHERE `myid`=$target";
						$insert=Db::execute($str);
					}else{
						$insert=4;
					}
				}else if($classes==1803){
					if($count<11){
						$str="UPDATE `pk$classes` SET `zc$myid`=$mark WHERE `myid`=$target";
						$insert=Db::execute($str);
					}else{
						$insert=4;
					}
				}else if($classes==1804){
					if($count<10){
						$str="UPDATE `pk$classes` SET `zc$myid`=$mark WHERE `myid`=$target";
						$insert=Db::execute($str);
					}else{
						$insert=4;
					}
				}
				if($insert==1){
					echo(0);
				}else if($insert==4){
					echo(4);
				}else{
					echo(3);
				}
			}else{
				echo(2);
			}
		}else{
			echo(1);
		}
	}
	/****************分割线****************/
	public function showbw($name="",$myid="",$classes=""){
		if($name!=""&&$myid!=""&&$classes!=""){
			//获取此班级所有人的数据
			$str="SELECT * FROM `bw$classes` WHERE 1";
			$data=Db::query($str);
			//计算此班级人数
			$length=count($data);
			$echoer=[];
			//json数据返回计数器(从1开始的计数器)
			$j=1;
			//将重新生成数据去除登录者的信息
			for($i=1;$i<=$length;$i++){
				//按自增id遍历查找
				$str="SELECT * FROM `bw$classes` WHERE  `id` = $i LIMIT 1";
				$query=Db::query($str);
				//如果查找到的数据不是本人则加入返回器echoer内
				if($query[0]["myid"]!=$myid){
					$echoer["data"][$j]=$query;
					$j++;
				}
			}
			//返回数据个数
			$echoer["len"]=$j-1;
			//返回器返回数据
			echo json_encode($echoer);
		}
	}
	public function showsinglebw($name="",$myid="",$classes="",$target="",$type=""){
		//$name$myid$classes将会由登录之后存储的cookie进行发送 如没有登录过的状态将重新登录
		if($classes!=""&&$name!=""&&$myid!=""&&$target!=""&&$type!=""){
			//获取此人的数据
			$str="SELECT * FROM `bw$classes` WHERE  `myid` = $target AND `type`='$type' LIMIT 1";
			$data=Db::query($str);
			//返回器返回数据
			echo json_encode($data);
		}else{
			echo("请先登录");
		}
	}
	public function scorebw($myid="",$classes="",$target="",$mark="",$type=""){
		//$myid$classes是登录者的信息从之前登录过的cookie中获得
		if($classes!=""&&$myid!=""&&$target!=""&&$mark!=""&&$type!=""){
			if($type=="上一届"){
				//如果登录者选择人的分数不等于null则无法再次测评
				$str="SELECT * FROM `bw$classes` WHERE  `myid` = $target AND `type`='$type' LIMIT 1";
				$isnull=Db::query($str);
				$judge=$isnull[0]["zc".$myid];
				//判断是否为null
				if($judge==""){
					$str="UPDATE `bw$classes` SET `zc$myid`=$mark WHERE `myid`=$target AND `type`='$type'";
					$insert=Db::execute($str);
					if($insert!=0){
						echo(0);
					}else{
						echo(3);
					}
				}else{
					echo(2);
				}
			}else{
				$new_BW=[];
				$str="SELECT * FROM `bw$classes`";
				$length=Db::execute($str);
				$data=Db::query($str);
				$j=1;
				for($i=0;$i<$length;$i++){
					if($data[$i]["type"]=="新一届"){
						$new_BW[$j]=$data[$i];
						$j++;
					}
				}
				$length=count($new_BW);
				$count=0;
				for($i=1;$i<=$length;$i++){
					if($new_BW[$i]["zc".$myid]!=""){
						$count++;
					}
					if($count>=7){
						break;
					}
				}
				if($count<7){
					$str="UPDATE `bw$classes` SET `zc$myid`=$mark WHERE `myid`=$target AND `type`='$type'";
					$insert=Db::execute($str);
				}else{
					$insert=4;
				}
				if($insert==1){
					echo(0);
				}else if($insert==4){
					echo(4);
				}else{
					echo(3);
				}
			}
		}else{
			echo(1);
		}
	}
	public function signbw($name="",$myid="",$classes="",$message,$scripthood=""){
		if($classes!=""&&$name!=""&&$myid!=""&&$message!=""&&$scripthood!=""){
			$str="SELECT * FROM `bw$classes` WHERE  `myid` = $myid";
			$count=Db::execute($str);
			$is_sim=Db::query($str);
			if($count==2){
				echo(2);
			}else{
				if($is_sim==NULL){
					$str="INSERT INTO `bw$classes`(`name`, `myid`, `message`,`type`,`scripthood`) VALUES ('$name',$myid,'$message','新一届','$scripthood')";
					$insert=Db::execute($str);
					if($insert){
						echo(0);
					}else{
						echo(1);
					}
				}else{
					if($is_sim[0]["type"]=="上一届"){
						$str="INSERT INTO `bw$classes`(`name`, `myid`, `message`,`type`,`scripthood`) VALUES ('$name',$myid,'$message','新一届','$scripthood')";
						$insert=Db::execute($str);
						if($insert){
							echo(0);
						}else{
							echo(1);
						}
					}else{
						echo(2);
					}
				}
			}
		}else{
			echo(3);
		}
	}
}


?>








