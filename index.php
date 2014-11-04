<?php
require_once 'config.php';
$year   = date('Y');
$month  = date('m');
$day    = date('d');
$time   =date('Y-m-d H:i:s');

$server 	= isset($_POST['server']) ? $_POST['server'] : "";
$log    	= isset($_POST['log']) ? $_POST['log'] : "";
$errorlog	= isset($_POST['error_log']) ? $_POST['error_log'] : "";

if (($server == "") || ($log == ""))
{
    die("-1");
}

$logPath = sprintf("%s/%s/%d/%d", __CONFIG_LOG_PATH, $server, $year, $month);
$isDir   = true;

if (!is_dir($logPath))
{
    $isDir = @mkdir($logPath, 0777, true);
}

if ($isDir == true)
{
    $filePath = $logPath . "/djsg_" .$day . ".log";
    if (strlen($errorlog) > 0)
    {
        $filePath = $logPath . "/djsg_" .$day . ".error_log";
		$log = $errorlog;
    }

    if (is_file($filePath) && filesize($filePath) > __CONFIG_LOG_MAX_SIZE)
    {
        @rename($filePath, $filePath."_".date('H_i_s'));
    }
    
    $fp = @fopen($filePath, "ab+");
    if (!$fp)
    {
        die("-2");
    }
    
    $msg = $time ."\n";
    $msg .= $log."\n";
    $msg .= "----------------------------------------------------------------------------------------------------------------------------------------\n";
    fwrite($fp, $msg);
    fclose($fp);
    
    echo "0";
}
else
{
    echo "-3";
}
