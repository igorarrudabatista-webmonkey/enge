<?php

require_once '../config/config.php';
require_once NORNAS_PATH . 'Autoloader.php';
require_once SITE_PATH . '/vendor/phpmailer/PHPMailerAutoload.php';
require_once SITE_PATH . '/vendor/wideimage/WideImage.php';
require_once APP_PATH . 'autoload.php';
require_once APP_PATH . 'routes.php';

try {
    \Nornas\RouteMap::run();
} catch (\Exception $e) {
    Echo $e->getMessage();
}
