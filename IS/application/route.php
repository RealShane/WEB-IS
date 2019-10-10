<?php

// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    //别名配置,别名只能是映射到控制器且访问时必须加上请求的方法
    '__alias__'   => [
		'secondscript'=>'origin/secondscript/add_up',
		'secondcourse'=>'origin/secondscript/add_course',
		'issimlogin'=>'origin/issimlogin/is_sim_login',
		'Register'=>'origin/index/register',
		//Android
		'Android_Course'=>'origin/Androidsecondclass/course',
		'Android_Lectures'=>'origin/Androidsecondclass/lecturers',
		'Android_Classes'=>'origin/Androidsecondclass/classes',
		//Compiler
		'input'=>'origin/Compiler/input',
		//自律委
		'data_show'=>'origin/sdc/data_show',//显示所有班级和人员信息
		'insert_absent'=>'origin/sdc/insert_absent',//记录未到
		'login_sdc'=>'origin/sdc/login',//登录
		'classlists'=>'origin/sdc/lists',//班级列表
		'SDC'=>'origin/sdcfetch/index',//查勤首页
		'LoginSDC'=>'origin/sdcfetch/login_sdc',//查勤登录
		'Absent'=>'origin/sdcfetch/record_info',//缺席记录
		//第二课堂
		'course'=>'origin/secondclass/course',//course方法
		'classes'=>'origin/secondclass/classes',//classes方法
		'sign'=>'origin/secondclass/sign',//course方法
		'singleshowclass'=>'origin/secondclass/singleshowclass',//singleshowclass方法
		'singleshowpro'=>'origin/secondclass/singleshowpro',//singleshowpro方法
		'check'=>'origin/secondclass/search',//search方法
		'lec'=>'origin/secondclass/lecturers',//lecturers方法
		'tutorial_list'=>'origin/secondclass/tutorial_list',//tutorial_list方法
		'tutorial_info'=>'origin/secondclass/tutorial_info',//tutorial_info方法
		'tutorial_sign'=>'origin/secondclass/tutorial_sign',//tutorial_sign方法
		'secondclass'=>'origin/secondfetch/index',//第二课堂主页渲染视图方法
		'singlesign'=>'origin/secondfetch/singlesign',//第二课堂单个课程渲染视图方法
		'search'=>'origin/secondfetch/search',//第二课堂报名查询渲染视图方法
		'lecturers'=>'origin/secondfetch/lecturers',//第二课堂讲师列表渲染视图方法
		'tutorial'=>'origin/secondfetch/tutorial',//第二课堂小课渲染视图方法
		'tutoriallist'=>'origin/secondfetch/tutoriallist',//第二课堂小课列表渲染视图方法
		//综合测评
		'login'=>'origin/origin/login',//login方法
		'show'=>'origin/origin/show',//show方法
		'score'=>'origin/origin/score',//score方法
		'signpk'=>'origin/origin/sign_pk',//sign_pk方法
		'showpk'=>'origin/origin/showpk',//show_pk方法
		'showsingle'=>'origin/origin/showsingle',//showsingle方法
		'showsinglepk'=>'origin/origin/showsinglepk',//showsinglepk方法
		'scorepk'=>'origin/origin/scorepk',//scorepk方法
		'showbw'=>'origin/origin/showbw',//showbw方法
		'showsinglebw'=>'origin/origin/showsinglebw',//showsinglebw方法
		'scorebw'=>'origin/origin/scorebw',//scorebw方法
		'signbw'=>'origin/origin/signbw',//signbw方法
		'origin'=>'origin/originfetch/index',//综合测评主页渲染视图方法
		'origin_PK'=>'origin/originfetch/indexpk',//贫困生主页渲染视图方法
		'origin_BW'=>'origin/originfetch/indexbw',//班委主页渲染视图方法
		'login_ZC'=>'origin/originfetch/loginzc',//综合测评登录渲染视图方法
		'sign_PK'=>'origin/originfetch/signpk',//贫困生报名渲染视图方法
		'score_ZC'=>'origin/originfetch/scorezc',//综合测评打分渲染视图方法
		'score_PK'=>'origin/originfetch/scorepk',//贫困生打分渲染视图方法
		'score_BW'=>'origin/originfetch/scorebw',//班委打分渲染视图方法
		//时光邮局
		'TimePoffice'=>'origin/pofficefetch/index',//时光邮局主页(公开信)
		'login_PO'=>'origin/pofficefetch/loginpo',//时光邮局登录
		'openletter'=>'origin/pofficefetch/openletter',//公开信
		'WriteOpenLetter'=>'origin/pofficefetch/writeopenletter',//公开信书写
		'TimeLetter'=>'origin/pofficefetch/futureletter',//时光信件书写
		'FutureLetterList'=>'origin/pofficefetch/futureletterfetch',//信件列表
		'open'=>'origin/poffice/open_letter',//公开信方法
		'letter_info'=>'origin/poffice/letter_info',//公开信单个信件获取方法
		'loginpo'=>'origin/poffice/login',//公开信单个信件获取方法
		'write_openletter'=>'origin/poffice/write_openletter',//公开信写信方法
		'future_letter'=>'origin/poffice/future_letter',//写信方法
		'letter_list'=>'origin/poffice/letter_list',//读取信件方法
		//论坛
		'forum'=>'origin/forumfetch/index',//论坛首页
		'forum_list'=>'origin/forumfetch/forum_list',//文章列表首页
		'arctic_info'=>'origin/forumfetch/arctic_info',//文章内容首页
		'arctic_write'=>'origin/forumfetch/arctic_write',//写文章首页
		'forum_login'=>'origin/forumfetch/forum_login',//论坛登录首页
		'list'=>'origin/forum/forum_list',//文章列表方法
		'module_get'=>'origin/forum/index',//论坛模块方法
		'info'=>'origin/forum/info',//文章列表方法
		'write'=>'origin/forum/write',//文章列表方法
		'comment_show'=>'origin/forum/comment_show',//评论显示方法
		'comment'=>'origin/forum/comment',//评论方法
		'register'=>'origin/forum/registerfunc',//注册方法
		'f_login'=>'origin/forum/login'//论坛登录方法
    ],
    //变量规则
    '__pattern__' => [
    ],
//        域名绑定到模块
//        '__domain__'  => [
//            'admin' => 'admin',
//            'api'   => 'api',
//        ],
];
