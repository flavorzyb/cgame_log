<?php
if (!defined('__CONFIG_LOG_'))
{
    define('__CONFIG_LOG_', true);
    //设置时区
    date_default_timezone_set('Asia/Shanghai');
    
    define('__CONFIG_LOG_PATH', '/data0/logs/cgame');
    
    define('__CONFIG_LOG_MAX_SIZE', 1024*1024*300);
}
