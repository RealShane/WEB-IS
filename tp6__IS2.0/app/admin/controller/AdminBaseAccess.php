<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/24 上午12:23
 *
 */


namespace app\admin\controller;

use app\common\business\admin\AdminUser as AdminUserBusiness;
use app\common\business\lib\BaseMethod;
use app\common\validate\admin\AdminLogin;
use think\exception\ValidateException;
use think\facade\View;

class AdminBaseAccess extends BaseMethod
{

    public function adminUserLogin(){
        $this -> isLogin();
        return View::fetch('index/login');
    }

    public function indexView(){
        return View::fetch('index/index');
    }

    public function indexWelcome(){
        return View::fetch('index/welcome');
    }

    public function errorView(){
        return View::fetch('public/404');
    }

    public function adminInfo(){

        if(!(request()->isPost())){
            return back_admin_login();
        }
        $adminUserBusiness = new AdminUserBusiness();
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $adminUserBusiness -> getLoginInfo()
        );
    }
    /**管理员退出
     * @return \think\response\Redirect
     */
    public function adminQuit(){
        session(config('admin.session_user'), NULL);
        return back_admin_login();
    }

    /**管理员登陆
     * @return string|\think\response\Json
     * @throws \Exception
     *
     */
    public function adminLogin(){

        if(!(request()->isPost())){
            return back_admin_login();
        }
        $data["username"] = $this -> request -> param("username", '', 'trim');
        $data["password"] = $this -> request -> param("password", '', 'trim');
        $data["validate"] = $this -> request -> param("validate", '', 'trim');

        try{
            validate(AdminLogin::class) -> check($data);
        }catch (ValidateException $exception){

            $judge = $exception -> getMessage();
            //为空或验证码错误
            return $this -> show(
                config("status.error"),
                config("message.error"),
                $judge
            );
        }
        $adminUserBusiness = new AdminUserBusiness();
        $result = $adminUserBusiness -> adminLogin($data);

        if($result == NULL){
            //用户不存在
            return $this -> show(
                config("status.error"),
                config("message.error"),
                config("message.user_not_exist")
            );
        }else if($result == config("status.failed")){
            //密码错误
            return $this -> show(
                config("status.error"),
                config("message.failed"),
                config("message.password_fault")
            );
        }else if($result == config("status.success")){
            //登陆成功
            return $this -> show(
                config("status.success"),
                config("message.success"),
                $result
            );
        }


    }

    /**获取所有生成表
     * @return \think\response\Json|\think\response\Redirect
     */
    public function seeAllTable(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_admin_generator')
        );
    }

    /**获取所有目录
     * @return \think\response\Json|\think\response\Redirect
     */
    public function seeAllCatalogue(){
        if(!(request()->isPost())){
            return back_admin_index();
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $this -> throwAll('z_catalogue')
        );
    }

    /**
     * 判断是否登陆
     */
    public function isLogin(){
        $user = session(config('admin.session_user'));

        if(!empty($user)){
            return header('location:/admin/Index');
        }
    }
}