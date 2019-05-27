<?php


namespace app\index\model;


use think\Model;

class Mailbox extends Model
{

    /**
     * 状态已删除
     */
    const OK_DELETED = 1;
    const NOT_DELETED = 0;

    /**
     * 发送是否成功
     */
    const ERROR = 1;
    const SUCCESS = 0;

    /**
     * @var int
     * 发送是否成功
     */
    protected $logType = 0;

    /**
     * @var string
     * 邮件日志表
     */
    protected $table = 'sp_mail_log';


    public function setType($type) {
        $this->logType = $type;
        return $this;
    }

    /**
     * @param array $data
     * @return false|int
     * 记录日志接口
     */
    public function log(array $data) {
        $this->from = $data['from'];
        $this->to = $data['to'];
        $this->subject = $data['subject'];
        $this->body = $data['body'];
        $this->errors =  $this->logType;
        $this->is_deleted = static::NOT_DELETED;
        $this->ctime = time();
        return $this->save();
    }
}