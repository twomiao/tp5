<?php
namespace app\helper;

class MailHelper
{
    /**
     * @param array $data
     * 通知注册邮件
     */
    public static function to(array $data): bool {
    // twomiao6666:twomiao66666:twomiao6666
        $transport = (new \Swift_SmtpTransport(config('mail')['host'], config('mail')['port'], 'ssl'))
            ->setUsername(config('mail')['user'])
            ->setPassword(config('mail')['password']);
        // Create the Mailer using your created Transport
        $mailer = new \Swift_Mailer($transport);
        // Create a message
        $message = (new \Swift_Message($data['subject']))
            ->setFrom([$data['from'] => $data['from']])
            ->setTo($data['to'])
            ->setBody($data['body']);
        // Send the message
        $result = $mailer->send($message);
        if ($result === 1)
        {
            return true;
        }
        return false;
    }
}