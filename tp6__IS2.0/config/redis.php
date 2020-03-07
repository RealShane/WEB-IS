<?php
/**
 *
 *
 * @description:  我起了，一枪秒了，有什么好说的XD
 * @author: shenzheng
 * @time: 2020/1/26 下午9:54
 *
 */

return[

    //邮箱验证码前缀
    "code_pre" => "is_code_pre_",
    //邮箱验证码持续时间(2分钟)
    "code_expire" => 120,
    //登陆Token
    "token_pre" => "is_unite_login_token_pre_",
    //登陆Token持续时间(一天)
    "token_expire" => 24*3600,
    //账号激活Active
    "active_pre" => "is_unite_register_active_pre_",
    //账号激活持续时间(一天)
    "active_expire" => 24*3600,
    //队列redis选课前缀
    "queue_course_pre" => "is_second_class_queue_course_pre_",
    //集合redis选课前缀
    "set_course_pre" => "is_second_class_set_course_pre_"

];