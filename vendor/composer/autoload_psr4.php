<?php

// autoload_psr4.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'think\\worker\\' => array($vendorDir . '/topthink/think-worker/src'),
    'think\\oracle\\' => array($vendorDir . '/topthink/think-oracle/src'),
    'think\\mongo\\' => array($vendorDir . '/topthink/think-mongo/src'),
    'think\\migration\\' => array($vendorDir . '/topthink/think-migration/src'),
    'think\\helper\\' => array($vendorDir . '/topthink/think-helper/src'),
    'think\\composer\\' => array($vendorDir . '/topthink/think-installer/src'),
    'think\\captcha\\' => array($vendorDir . '/topthink/think-captcha/src'),
    'think\\' => array($baseDir . '/thinkphp/library/think', $vendorDir . '/topthink/think-image/src', $vendorDir . '/topthink/think-queue/src'),
    'app\\' => array($baseDir . '/application'),
    'Workerman\\' => array($vendorDir . '/workerman/workerman'),
    'Symfony\\Polyfill\\Php72\\' => array($vendorDir . '/symfony/polyfill-php72'),
    'Symfony\\Polyfill\\Mbstring\\' => array($vendorDir . '/symfony/polyfill-mbstring'),
    'Symfony\\Polyfill\\Intl\\Idn\\' => array($vendorDir . '/symfony/polyfill-intl-idn'),
    'Symfony\\Polyfill\\Iconv\\' => array($vendorDir . '/symfony/polyfill-iconv'),
    'Phinx\\' => array($vendorDir . '/topthink/think-migration/phinx/src/Phinx'),
    'Egulias\\EmailValidator\\' => array($vendorDir . '/egulias/email-validator/EmailValidator'),
);
