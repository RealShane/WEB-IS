<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/26 下午6:50
 *
 */


namespace app\common\validate\origin;


use think\Validate;

class UniteLogin extends Validate
{
    protected $rule = [
        'password' => 'require|max:20',
        'email' => 'require|email',
        'random' => 'require|max:20',
        'validate' => 'require|captcha',

        'name' => 'require|max:20',
        'student_id' => 'require|max:10',
        'classes_id' => 'require|max:10',
    ];

    protected $message = [
        'password.require' => '密码不为空',
        'password.max' => '密码不超过20个字符',
        'email.require' => '邮箱不为空',
        'email.email' => '邮箱格式不正确',
        'random.require' => '随机码不为空',
        'random.max' => '随机码不超过20个字符',
        'validate.require' => '验证码不为空',
        'validate.captcha' => '验证码错误',

        'name.require' => '姓名不为空',
        'name.max' => '姓名不超过20个字符',
        'student_id.require' => '学号不为空',
        'student_id.max' => '学号不超过10个字符',
        'classes_id.require' => '班级不为空',
        'classes_id.max' => '班级不超过10个字符',


    ];

    protected $scene = [
        'type_password' => ['email', 'password', 'validate'],
        'type_email' => ['email', 'random', 'validate'],
        'send_email' => ['email', 'validate'],
        'register' => ['name', 'student_id', 'email', 'password', 'classes_id', 'validate'],
    ];
}