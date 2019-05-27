<?php

namespace app\index\job;

use app\helper\MailHelper;
use app\index\model\Mailbox;
use think\queue\Job;

class Mail
{
    public function fire(Job $job, $data)
    {
        // 任务重试次数,失败
        if ($job->attempts() > 3) {
            $this->failed($data);
        }

        try {
            if (MailHelper::to($data) === true) {
                //如果任务执行成功后 记得删除任务，不然这个任务会重复执行，直到达到最大重试次数后失败后，执行failed方法

                $job->delete();
                // 成功日志记录
                (new Mailbox())->setType(Mailbox::SUCCESS)->log($data);
                return true;
            }
            // 失败日志记录
            (new Mailbox())->setType(Mailbox::ERROR)->log($data);
        } catch (\Throwable $e) {
//            var_dump($e->getMessage());
        }
        // 也可以重新发布这个任务
//        $Job->release($delay); //$delay为延迟时间
    }

    // ...任务达到最大重试次数后，失败了
    public function failed($data)
    {

    }
}