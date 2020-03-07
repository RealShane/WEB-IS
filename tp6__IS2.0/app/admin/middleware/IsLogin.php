<?php
declare (strict_types = 1);

namespace app\admin\middleware;

class IsLogin
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next){

        $user = session(config('admin.session_user'));
        $isLogin = (!preg_match('/login/', $request -> pathinfo()) && !preg_match('/adminLogin/', $request -> pathinfo()));

        if(empty($user) && $isLogin){
            return back_admin_login();
        }


        return $next($request);
    }
}
