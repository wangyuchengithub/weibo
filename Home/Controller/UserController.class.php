<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends CommonController
{
    public function index()
    {
        $id=I('id');
//        $this->assign('test',$id);
        echo $id;
        echo '<br/>';
        replaceContent();
    }

    public function _empty($name)
    {
//        echo $name;
        $this->_userUrl($name);
    }

    Private function _userUrl($name){
        $where=array('username'=>$name);
        $uid=M('userinfo')->where($where)->getField('uid');
//        $me=session('uid');
//        $this->redirect('/'.$uid);
        if(!$uid){
            $this->redirect('Index/index');
        }else{
            $this->redirect('/'.$uid);
        }
    }
}