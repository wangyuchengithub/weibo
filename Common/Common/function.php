<?php

function ccc($arr){
    echo "<pre>";
    print_r($arr);
    die;
}

// 加密解密
function encryption($value, $type = 0)
{
    $key = md5(C('ENCRYPTION_KEY'));
    if (!$type) {
        return str_replace('=', '', base64_encode($value ^ $key));
    } else {
        $value = base64_decode($value);
        return $value ^ $key;
    }
}

//时间判断
function timeFormat($time){
	$now=time();
	$diff=$now-$time;
	switch ($time) {
		case $diff<60:
			$timeTip=$diff.'秒前';
			break;
		
		case $diff<3600:
			$timeTip=floor($diff/60).'分钟前';
			break;

		case $diff<86400:
			$timeTip=floor($diff/3600).'小时前';
			break;

		default:
			$timeTip=date('Y-m-d H:i:s',$time);
			break;
	}
	return $timeTip;
}

function replaceContent($content){
//    $content="google网址:www.google.com  @hhh ，";
    $preg='/(?:http:\/\/)?([\w.]+[\w\/]*\.[\w.]+[\w\/]*\??[\w=\&\+\%]*)/is';
    $content = preg_replace($preg, '<a href="http://\\1" target="_blank">\\1</a>', $content);
    $preg='/@(\S+)\s/is';
    $content=preg_replace($preg, '<a href="' . __APP__ . '/Home/User/\\1">@\\1 </a>',$content);
    return $content;
}


