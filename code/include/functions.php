<?php
//获取设备类型
function get_device_type(){
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $pattern = '/iphone|android/';
    preg_match($pattern, $agent, $matches);
    if($matches[0]){
        return false;
    } else {
        return true;
    }
}