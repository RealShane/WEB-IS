<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/30 上午3:44
 *
 */


namespace app\common\validate\origin;


use think\Validate;

class TimePostal extends Validate
{

    protected $rule = [
        'title' => 'require|max:50',
        'letter' => 'require',
        'delivery_time' => 'require|date',
        'status' => 'require|max:4',
        'name' => 'require',
        'email' => 'require',
        'validate' => 'require|captcha'
    ];

    protected $message = [
        'title.require' => '标题不为空',
        'title.max' => '标题不超过50个字符',
        'letter.require' => '信件内容不为空',
        'delivery_time.require' => '取信时间不为空',
        'delivery_time.date' => '取信时间格式不正确',
        'status.require' => '信件类型不为空',
        'status.max' => '请勿修改信件类型',
        'name.require' => 'token过期，请重新登陆',
        'email.require' => 'token过期，请重新登陆',
        'validate.require' => '验证码不为空',
        'validate.captcha' => '验证码错误',
    ];

    protected $scene = [
        '公开信' => ['title', 'letter', 'status', 'name', 'email', 'validate'],
        '时光信件' => ['title', 'letter', 'delivery_time', 'status', 'name', 'email', 'validate'],
    ];

}