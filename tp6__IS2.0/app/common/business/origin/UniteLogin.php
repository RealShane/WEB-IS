<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/26 下午7:12
 *
 */


namespace app\common\business\origin;


use PHPMailer\PHPMailer\PHPMailer;
use app\common\model\mysql\origin\IsUniteUser as IsUniteUserModel;
use think\db\exception\DbException;
use think\facade\Db;

class UniteLogin
{

    public function getAllClasses(){
        try {
            $str = "SELECT * FROM `second_class_classes`";
            return Db::query($str);
        }catch (DbException $exception){
            return $exception -> getMessage();
        }

    }

    public function activeRegisterByEmail($email){
        $isUniteUserModel = new IsUniteUserModel();
        $isExist = $isUniteUserModel -> activeAccount($email);
        if(!$isExist){
            return config("status.failed");
        }
        return config("status.success");

    }

    public function uniteLoginRegister($data){
        $isUniteUserModel = new IsUniteUserModel();
        $isExist = $isUniteUserModel -> getUnActiveUserByStudentId($data["student_id"]);
        if(!empty($isExist)){
            return config("status.sign_exist");
        }
        $isExist = $isUniteUserModel -> getUnActiveUserByEmail($data["email"]);
        if(!empty($isExist)){
            return config("status.sign_exist");
        }

        $data_with_salt = $this -> passwordAddSalt($data);

        try {
            $isUniteUserModel -> add($data_with_salt);
        }catch (\Exception $exception){
            $isUniteUserModel -> rollback();
            return $exception -> getMessage();
        }
        $token = $this -> createLoginToken($data_with_salt['email']);
        if(($this -> sendActiveEmail($data_with_salt['email'], $token)) != config("status.success")){
            return config("status.failed");
        }
        $isRedis = cache(config("redis.active_pre").$token, ['email' => $data_with_salt['email']], config("redis.active_expire"));

        if(!$isRedis){
            return config("status.failed");
        }
        return config("status.success");
    }

    public function loginByPassword($data){
        $isUniteUserModel = new IsUniteUserModel();
        try {
            $user = $isUniteUserModel -> getUserByEmail($data["email"]);
            if(!$user){
                return config("status.none_user");
            }
            if($user == "停用"){
                return config("status.forbidden_user");
            }
            $password = md5($user["password_salt"].$data["password"].$user["password_salt"]);
            if($password != $user["password"]){
                return config("status.failed");
            }

            $this -> updateLoginInfo($data["email"]);
            $token = $this -> createLoginToken($user['email']);

            return $this -> setLoginTokenInfo($user, $token) ? ["token" => $token, "id" => $user['id'], "name" => $user['name']] : false;
        }catch (\Exception $exception){
            return "不可预知的错误";
        }
    }

    public function loginByEmail($data){
        $redisRandom = cache(config("redis.code_pre").$data['email']);
        if(empty($redisRandom) || $redisRandom != $data['random']){
            return config("status.failed");
        }
        $isUniteUserModel = new IsUniteUserModel();
        $user = $isUniteUserModel -> getUserByEmail($data['email']);
        if(!$user){
            return config("status.none_user");
        }
        if($user == "停用"){
            return config("status.forbidden_user");
        }

        $this -> updateLoginInfo($data["email"]);
        $token = $this -> createLoginToken($user['email']);

        return $this -> setLoginTokenInfo($user, $token) ? ["token" => $token, "id" => $user['id'], "name" => $user['name']] : false;
    }

    public function sendRandom($email){
        $random = rand(100000, 999999);
        if(($this -> sendRandomEmail($email, $random)) != config("status.success")){
            return config("status.failed");
        }
        $isRedis = cache(config("redis.code_pre").$email, $random, config("redis.code_expire"));

        if(!$isRedis){
            return config("status.failed");
        }
        return config("status.success");
    }

    public function sendActiveEmail($target, $token){
        $title = '工学部综合系统--注册激活';
        $body = '<h1>汇华的同学你好：</h1><br>&nbsp;&nbsp;Shane帮你想好了你应该去哪里激活你的账号(尽快激活，24小时有效时间)：https://serv.huihuagongxue.top/origin/Index/active?token='.$token;
        $alt_body = '汇华的同学你好：Shane帮你想好了你应该去哪里激活你的账号(尽快激活，24小时有效时间)：https://serv.huihuagongxue.top/origin/Index/active?token='.$token;
        return $this -> sendEmail($target, $title, $body, $alt_body);
    }

    public function sendRandomEmail($target, $random){
        $title = '工学部综合系统--登陆验证';
        $body = '<h1>汇华的同学你好：</h1><br>&nbsp;&nbsp;验证码Shane帮你想好了(尽快登陆，2分钟有效时间)：'.$random;
        $alt_body = '汇华的同学你好：验证码Shane帮你想好了(尽快登陆，2分钟有效时间)：'.$random;
        return $this -> sendEmail($target, $title, $body, $alt_body);
    }

    public function sendEmail($target, $title, $body, $alt_body){
        $mailer = new PHPMailer();
        try {
            $mailer -> CharSet ="UTF-8";
            $mailer -> SMTPDebug = 0;
            $mailer -> isSMTP();
            $mailer -> Host = 'smtp.163.com';
            $mailer -> SMTPAuth = true;
            $mailer -> Username = 'redleafshane@163.com';
            $mailer -> Password = 'SJWZyHHf3sYxcSGN';
            $mailer -> SMTPSecure = 'ssl';
            $mailer -> Port = 465;

            $mailer -> setFrom('redleafshane@163.com', 'Shane');
            $mailer -> addAddress($target);
            $mailer -> addReplyTo('redleafshane@163.com', 'Shane');

            $mailer -> isHTML(true);
            $mailer -> Subject = "$title";
            $mailer -> Body    = "$body";
            $mailer -> AltBody = "$alt_body";

            $mailer -> send();
            return config("status.success");
        } catch (Exception $exception) {
            return $exception -> getMessage();
        }
    }

    public function setLoginTokenInfo($user, $token){

        $redisData = [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email'],
            "student_id" => $user['student_id'],
            "classes_id" => $user['classes_id']
        ];
        return cache(config("redis.token_pre").$token, $redisData, config("redis.token_expire"));
    }

    public function createLoginToken($str){
        $tokenSalt = md5(uniqid(md5(microtime(true)), true));
        return sha1($tokenSalt.$str);
    }

    public function updateLoginInfo($key){
        $loginTimeAndIp = [
            'last_login_time' => time(),
            'last_login_ip' => request() ->ip()
        ];
        $execute = new IsUniteUserModel();
        try {
            $execute -> updateLoginTimeAndIp($loginTimeAndIp, $key);
        }catch (\Exception $exception){
            return "不可预知的错误";
        }
    }

    public function passwordAddSalt($data){

        if(!is_array($data)){

            return $this -> show(
                config("status.failed"),
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