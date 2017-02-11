<?php
/* 
* @Author: ealiwood
* @Date:   2017-01-16 09:07:17
* @Last Modified by:   anchen
* @Last Modified time: 2017-02-11 09:56:49
*/
return array(
    //'配置项'=>'配置值'
    'DEFAULT_THEME' => 'default',  // 默认模板主题名称 //
    'DB_TYPE' => 'mysql',     // 数据库类型
    'DB_HOST' => 'localhost',   // 服务器地址
    'DB_NAME' => 'weibo',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => '',          // 密码
    'DB_PORT' => '3306',        // 端口
    'DB_PREFIX' => 'ly_',    // 数据库表前缀
    'LAYOUT_ON' => true,
    'LAYOUT_NAME' => 'layout',

    'ENCRYPTION_KEY' => 'HSJCKKK', //加密使用的key
    'AUTO_LOGIN_TIME' => time() + 3600 * 24 * 7,  //自动登入cookies的保存时间
    'VAR_SESSION_ID' => 'session_id',     //sessionID的提交变量
    'URL_ROUTER_ON' => true,
    'URL_ROUTE_RULES' => array(
        ':id\d'=>'User/index',



    ),

);