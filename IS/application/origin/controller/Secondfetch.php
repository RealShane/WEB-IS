<?php
namespace app\origin\controller;
use app\origin\model\Visitor_s_record;
use think\Controller;
class Secondfetch extends Controller{
	public function index(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="第二课堂主页";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->主页
	}
	public function singlesign(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="第二课堂报名";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->报名
	}
	public function lecturers(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="第二课堂讲师列表";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->讲师列表
	}
	public function search(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="第二课堂成绩查询";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->报名情况查询
	}
	public function tutorial(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="讲座/微课堂报名";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->小课报名
	}
	public function tutoriallist(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="讲座/微课堂列表";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->小课列表
	}
}
?>