<?php
namespace app\origin\controller;
use app\origin\model\Visitor_s_record;
use think\Controller;
class Originfetch extends Controller{
	public function index(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="综测首页";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->综合测评主页
	}
	public function indexpk(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="贫困生首页";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->贫困生主页
	}
	public function loginzc(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="综测登录";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->综合测评登录
	}
	public function scorezc(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="综测打分";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->综合测评打分
	}
	public function scorepk(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="贫困生打分";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->综合测评打分
	}
	public function signpk(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="贫困生报名";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->贫困生报名
	}
	public function indexbw(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="班委首页";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->班委主页
	}
	public function scorebw(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="班委打分";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->班委打分
	}
}
?>