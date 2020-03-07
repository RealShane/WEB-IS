<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/13 上午10:24
 *
 */


namespace app\common\business\admin;
use app\common\model\mysql\admin\AdminUser as AdminUserModel;
use think\facade\Db;

class AdminUser
{


    public function getLoginInfo(){
        $user = session(config('admin.session_user'));
        $group = Db::table('z_admin_auth_access')->where('username', $user)->find();
        $group_name = Db::table('z_admin_auth_group')->where('id', $group['group'])->find();
        $data = [];
        $data['username'] = $user;
        $data['group'] = $group_name['name'];
        $data['group_id'] = $group_name['rules'];
        return $data;
    }
    /**更新登陆信息
     * @param $data
     * @param $key
     * @return string
     */
    public function updateLoginInfo($data, $key){

        $execute = new AdminUserModel();
        try {
            $execute -> updateLoginTimeAndIp($data, $key);
        }catch (\Exception $exception){
            return "不可预知的错误";
        }
    }

    /**管理员登陆
     * @param $data
     * @return mixed|string|void
     */
    public function adminLogin($data){

        $execute = new AdminUserModel();
        try {
            $isSuccess = $execute -> findUserByUserName($data["username"]);
        }catch (\Exception $exception){
            return "不可预知的错误";
        }
        if($isSuccess == NULL){
            return;
        }
        $password = md5($isSuccess["password_salt"].$data["password"].$isSuccess["password_salt"]);

        if($password != $isSuccess["password"]){
            return config("status.failed");
        }

        $loginTimeAndIp = [
            'last_login_time' => time(),
            'last_login_ip' => request() ->ip()
        ];

        $this -> updateLoginInfo($loginTimeAndIp, $data["username"]);
        session(config('admin.session_user'), $data["username"], 24*3600);

        return config("status.success");
    }

    public function passwordAddSalt($data){

        if(!is_array($data)){

            return $this -> show(
                config("status.error"),
                config("message.key_fault"),
                NULL
            );
        }

        $salt = $this -> salt();
        $ip = request() -> ip();

        $data['password'] = md5($salt.$data['password'].$salt);
        $data['password_salt'] = $salt;
        $data['last_login_ip'] = $ip;
        $data['last_login_time'] = time();

        return $data;
    }

    public function add($data){

        $execute = new AdminUserModel();
        try {
            $isSuccess = $execute -> add($data);
        }catch (\Exception $exception){
            $execute -> rollback();
            return "用户名重复";
        }

        return $isSuccess;

    }

    public function salt() {
        // 盐字符集
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for($i = 0; $i < 5; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

}