<?php
$serv = new swoole_server("127.0.0.1", 9502, SWOOLE_BASE);

$serv->set(array(
    'worker_num' => 1,
    'task_worker_num' => 1,
));

/**
 * 用户进程实现了广播功能，循环接收管道消息，并发给服务器的所有连接
 */
$process = new Swoole\Process(function($process) use ($serv) {
    while (true) {
        $data = array(
            'id' => 1,
            'name' => 'tangsan'
        );
        $serv->task(json_encode($data));
        sleep(3);
    }
});

$serv->addProcess($process);

$serv->on('Receive', function(swoole_server $serv, $fd, $from_id, $data) {

});

$serv->on('Task', function (swoole_server $serv, $task_id, $from_id, $data) {
    var_dump("[From worker message]={$data}".PHP_EOL);
    $serv->finish($data);
});

$serv->on('Finish', function (swoole_server $serv, $task_id, $data) {
    var_dump("[From task message]={$data}".PHP_EOL);
});

$serv->on('workerStart', function($serv, $worker_id) {
    if ($serv->taskworker === false)
    {
//        $serv->task('哈哈哈');
    }
});

$serv->start();