<?php

namespace Home\Controller;

use Think\Controller;

class UserSettingController extends CommonController
{
    public function index()
    {
        $session = session('uid');
        // ccc($session);

        $where = array('uid' => $session);

        $userinfo = M('userinfo')->where($where)->find();
        // $userinfo['registime']=data($)
        $this->userinfo = $userinfo;
        $this->display();

    }

    public function infoupdate()
    {
        $session = session('uid');
        $where = array('uid' => $session);
        // ccc($where);
        $data = array(
            'username' => I('username'),
            'truename' => I('truename'),
            'sex' => I('sex'),
            'location' => I('location'),
            'constellation' => I('constellation'),
            'intro' => I('intro'),

        );
        if (M('userinfo')->where($where)->save($data)) {
            $this->success('保存成功');
        } else {
            $this->error('保存失败');
        }

    }


    public function facePreview()
    {
//        echo ROOT_PATH;die;
        $session = session('uid');
        $upload = new \Think\Upload();
        $upload->maxSize = 2000000;
        $upload->exts = array('jpg', 'png', 'jpeg');
        $upload->rootPath = APP_PATH;
        $upload->savePath = '/Uploads/temp/';
        $upload->autoSub = true;        //是否分子目录
        $upload->subName = array('date', 'Ymd');     //子目录命名规则

        $info = $upload->upload();
        if (!$info) {
            $this->ajaxReturn(array('msg' => $upload->getError()));
        } else {
            foreach ($info as $file) {
                $this->ajaxReturn(array('path' => $file['savepath'] . $file['savename']));
            }
        }
    }

    public function faceEdit()
    {
        if (IS_POST) {
            $userid = session('uid');
            $where = array('uid' => $userid);
            $user = M('userinfo');
            $oldImg = $user->where($where)->field('face180', 'face80', 'face50')->find();
            @unlink($oldImg['face180']);
            @unlink($oldImg['face80']);
            @unlink($oldImg['face50']);
            $imgPath = I('imgPath');
            $image = new \Think\Image();
            $image->open(APP_PATH . $imgPath);
            $randomid = uniqid();
            $face180 = APP_PATH . 'Uploads/face/' . $randomid . '_180.jpg';
            $face80 = APP_PATH . 'Uploads/face/' . $randomid . '_80.jpg';
            $face50 = APP_PATH . 'Uploads/face/' . $randomid . '_50.jpg';
            $data = array(
                'face180' => $face180,
                'face80' => $face80,
                'face50' => $face50,
            );
            $image->thumb(180, 180, \Think\Image::IMAGE_THUMB_NORTHWEST)->save($face180);
            $image->thumb(80, 80, \Think\Image::IMAGE_THUMB_NORTHWEST)->save($face80);
            $image->thumb(50, 50, \Think\Image::IMAGE_THUMB_NORTHWEST)->save($face50);
            if ($user->where($where)->save($data)) {
                $this->success('头像上传成功');
                unlink(APP_PATH . $imgPath);
            }

        }
    }




    // public function _upload($path,$width,$height){
    // }

    public function resetpwd()
    {
        $session = session('uid');
        $password = I('password', '', 'md5');
        $resetpwd = I('resetpwd', '', 'md5');
        $resetpwd1 = I('resetpwd1', '', 'md5');
        $where = array('id' => $session);
        $newpwd = array('password' => $resetpwd);
        $user = M('user')->where($where)->find();
        if ($user['password'] == $password) {
            if (M('user')->where($where)->save($newpwd)) {
                session(null);
                cookie('auto', null);
                $this->success('修改密码成功,请重新登入', U('Home/Index/index'));
            } else {
                $this->error('修改失败');
            }
        } else {
            $this->error('密码错误');
        }
    }

}