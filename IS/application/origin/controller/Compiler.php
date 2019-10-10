<?php
namespace app\origin\controller;
use think\Controller;
use think\Db;
use think\Cookie;
class Compiler extends Controller{
	public function input($input="",$name="",$class=""){
		if($input!=""&&$name!=""&&$class!=""){
			$dir_path="D:\AppServ\www\IS\public/compiler/".$class."/"."$name";
			if (!is_dir($dir_path)) {
				mkdir($dir_path,0777,true);
			}
			$path=$dir_path."/"."compiler.txt";
			$fp=fopen($path,'w+');//打开文件
			if(!$fp){
				echo "打开文件失败";
			}
			$temp=fwrite($fp, $input);	//用户输入写入文件
			if(!$temp){
				echo("写入失败");
			}
			fclose($fp);
			$cmd_str = __DIR__."compiler.txt";//命令语句
			exit;
			exec($cmd_str, $arr);	//执行命令将输出结果放到数组arr里面
			for($i = 0; $i < count($arr); $i++){
				echo $arr[$i]."/n";
			}
		}
		
	}
	
	
}

