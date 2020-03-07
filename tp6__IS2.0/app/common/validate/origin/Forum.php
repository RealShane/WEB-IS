<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/30 下午3:11
 *
 */


namespace app\common\validate\origin;
use think\Validate;

class Forum extends Validate
{
    protected $rule = [
        'id' => 'require',
        'comment' => 'require|max:200',
        'name' => 'require',
        'email' => 'require',

        'type' => 'require',
        'title' => 'require',
        'content' => 'require',
        'author' => 'require',


        'validate' => 'require|captcha'
    ];

    protected $message = [
        'id.require' => '文章id不为空',
        'comment.require' => '评论不为空',
        'comment.max' => '评论不超过200个字符',
        'name.require' => 'token过期，请重新登陆',
        'email.require' => 'token过期，请重新登陆',

        'type.require' => '版块所属不为空',
        'title.require' => '标题不为空',
        'content.require' => '内容不为空',
        'author.require' => 'token过期，请重新登陆',


        'validate.require' => '验证码不为空',
        'validate.captcha' => '验证码错误',
    ];

    protected $scene = [
        'comment' => ['id', 'comment', 'name', 'email', 'validate'],
        'article' => ['type', 'title', 'content', 'validate', 'author', 'email'],
    ];
}