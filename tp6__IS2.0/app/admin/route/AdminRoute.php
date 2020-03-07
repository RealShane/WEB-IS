<?php
use think\facade\Route;

Route::rule('Index', '/admin/AdminBaseAccess/indexView', 'GET');
Route::rule('login', '/admin/AdminBaseAccess/adminUserLogin', 'GET');