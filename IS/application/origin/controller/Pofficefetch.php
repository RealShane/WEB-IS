<?php
namespace app\origin\controller;
use app\origin\model\Visitor_s_record;
use think\Controller;
class Pofficefetch extends Controller{
	public function index(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="时光邮箱主页";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->主页
	}
	public function openletter(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="时光邮箱公开信";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->主页
	}
	public function writeopenletter(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="时光邮箱写公开信";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->公开信书写
	}
	public function futureletter(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="时光邮箱写时光信件";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->写时光信件
	}
	public function futureletterfetch(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="时光邮箱时光信件列表";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->时光信件列表
	}
	public function loginpo(){
		$ip_get = $_SERVER["REMOTE_ADDR"];
		$timezone_out=date_default_timezone_get();
      	date_default_timezone_set('Asia/Shanghai');
      	$time=date("Y-m-d H:i:s");
      	date_default_timezone_set($timezone_out);
		$site="时光邮箱登录";
		Visitor_s_record::create([
    			'ip_address'=>$ip_get,
    			'time'=>$time,
				'site'=>$site
			], ['ip_address','time','site']
		);
		return $this->fetch();//渲染视图->时光邮箱登录
	}
}
?>