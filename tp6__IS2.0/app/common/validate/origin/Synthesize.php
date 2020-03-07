<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/28 下午3:57
 *
 */


namespace app\common\validate\origin;


use think\Validate;

class Synthesize extends Validate
{

    protected $rule = [
        'type' => 'require|max:12',
        'target' => 'require|max:10',
        'mark' => 'require|between:70,100',
        'user_id' => 'require',

        'pin_kun_message' => 'require',
        'pin_kun_situation' => 'require',
        'ban_wei_message' => 'require',
        'ban_wei_situation' => 'require',

    ];

    protected $message = [
        'type.require' => '类型不为空',
        'type.max' => '类型不超过12个字符',
        'target.require' => '打分目标不为空',
        'target.max' => '打分目标不超过10个字符',
        'mark.require' => '分数不为空',
        'mark.max' => '分数必须大于70小于100',
        'user_id.require' => 'token过期，请重新登陆',

        'pin_kun_message.require' => '信息不为空',
        'pin_kun_situation.require' => '情况不为空',
        'ban_wei_message.require' => '信息不为空',
        'ban_wei_situation.require' => '情况不为空',
    ];

    protected $scene = [
        'pin_kun' => ['type', 'target', 'user_id'],
        'ban_wei' => ['type', 'target', 'user_id'],
        'pin_kun_sign' => ['type', 'user_id', 'pin_kun_message', 'pin_kun_situation'],
        'ban_wei_sign' => ['type', 'user_id', 'ban_wei_message', 'ban_wei_situation'],
        'zong_ce' => ['type', 'target', 'user_id', 'mark']
    ];

}