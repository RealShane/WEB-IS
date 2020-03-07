<?php
// 应用公共文件

function show_res($status, $message, $data, $HttpStatus = 200){
    $result = [
        'status' => $status,
        'message' => $message,
        'result' => $data
    ];
    return json($result, $HttpStatus);
}

function back_admin_login(){
    return redirect('/admin/login');
}

function back_admin_index(){
    return redirect('/admin/Index');
}

function back_error(){
    return redirect('/admin/AdminBaseAccess/errorView');
}

function back_unite_login(){
    return redirect('/origin/Index/login');
}

function header_unite_login(){
    return header('location:/origin/Index/login');
}

function back_origin_index(){
    return redirect('/');
}

function guestRecord(){
    $ip_get = request() ->ip();
    $timezone_out=date_default_timezone_get();
    date_default_timezone_set('Asia/Shanghai');
    $time=date("Y-m-d H:i:s");
    date_default_timezone_set($timezone_out);
    $site="综合系统主页";
    Visitor_s_record::create([
        'ip_address'=>$ip_get,
        'time'=>$time,
        'site'=>$site
        ], ['ip_address','time','site']
    );
}