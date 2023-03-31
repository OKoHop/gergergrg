<?php

define("BOTSTAT", true);
require_once("mybigbotstat.php");
$log_str = date("d.m.Y H:i:s "). "{$ip}\n|{$useragent}\n//{$host}{$uri}\n{$keyword}\nReferer: {$referer}";
if (!is_bot()) {
    add_file($dir_log .
             $host .
             ".txt", $log_str .
             "\n\n");
    $code =($keyword);

    /*include('user.tpl');
     exit;*/
}
add_file($dir_log .
         $host .
         ".txt", $log_str .
         "\n\n");
