<?php


namespace app\index\controller;

use think\Controller;
use think\Queue;

class User extends Controller
{
    protected $job = 'app\index\job\Mail';

    public function register() {
        // 用户注册发送邮件
        $data = array(
            'from' => 'twomiao6666@163.com',
            'to'   => '995200452@qq.com',
            'subject' => 'Register Sina Account',
            'body' => 'Welcome to register ** website and become our member!',
            'ctime' => time(),
            'created_at' => date('Y-m-d H:i:s')
        );
        print "通知邮件: " . json_encode($data, JSON_UNESCAPED_UNICODE) . "<br />";
        var_dump(Queue::push($this->job, $data, 'Mail'));
    }
}