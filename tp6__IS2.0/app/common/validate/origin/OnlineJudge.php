<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/2/2 下午11:17
 *
 */


namespace app\common\validate\origin;


use think\Validate;

class OnlineJudge extends Validate
{

    protected $rule = [
        'paper_id' => 'require',
        'status' => 'require'

    ];

    protected $message = [
        'paper_id.require' => '试卷id不为空',
        'status.require' => '试卷状态不为空'
    ];

}