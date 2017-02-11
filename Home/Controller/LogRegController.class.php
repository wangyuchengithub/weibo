<?php
/* 
* @Author: ealiwood
* @Date:   2017-01-16 09:07:17
* @Last Modified by:   anchen
* @Last Modified time: 2017-01-18 13:49:19
*/
namespace Home\Controller;

use Think\Controller;

class LogRegController extends Controller
{
    public function index()
    {
        if (session('uid')) {
            $this->success('您已登入，正在跳转中。。。', U('Home/Index/index'));
            die;
        }
        $this->display();
    }

    public function runLogin()
    {
        $autoCheck = I('autoCheck');
        $account = I('account');
        $password = I('password', '', 'md5');
        $where = array('account' => $account);
        $user = M('user')->where($where)->find();

        if (!$user || $password != $user['password']) {
            $this->error('密码错误');
        }
        if ($autoCheck) {
            $ip = get_client_ip();
            $value = $account . '|' . $ip;
            $enc = encryption($value);
            cookie('auto', $enc, 86400);

        }
        session('uid', $user['id']);
        $this->success('登入成功', U('Home/Index/index'));
    }


    public function runRegis()
    {
        $data = array(
            'account' => I('account'),
            'password' => I('password', '', 'md5'),
            'registime' => time(),
            'userinfo' => array(
                'username' => I('username'),
            )

        );

        if (IS_POST) {
            $id = D('UserRelation')->insert($data);
            if ($id) {
                session('uid', $id);
                $this->success('注册成功', U('Home/Index/index'));

            } else {
                $this->error('注册失败');
            }

            return;
        }


    }


    public function verify()
    {
        $config = array(
            'fontSize' => 40,    // 验证码字体大小
            'length' => 4,     // 验证码位数
            'useNoise' => true, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    public function checkVerify()
    {
        $verify = new \Think\Verify();
        $verifyVal = I('post.verify');
        if ($verify->check($verifyVal)) {
            $this->ajaxReturn(array('valid' => true));
        } else {
            $this->ajaxReturn(array('valid' => false));
        }
    }

    /*
        1、是否为ajax请求，否则抛出大E方法
        2、以htmlspecialchars过滤接收post过来的数据
        3、getField判断该数据是否存在数据库
        4、返回对应的validate插件的格式

        bootstrapValidator返回格式为valid：true/false  json格式
     */
    public function checkUsername()
    {
        if (!IS_AJAX) {
            E("页面不存在");
//            原3.1版本中的halt方法已经废弃，请使用E函数代替。
//            isajax()方法已经弃用

        }
        //$account=htmlspecialchars($_POST['account']);
        $username = I('post.username', '', 'htmlspecialchars');

        $where = array('username' => $username);
        $compare = M('userinfo')->where($where)->getField('id');
        if (!$compare) {
            $this->ajaxReturn(array('valid' => true));
        } else {
            $this->ajaxReturn(array('valid' => false, 'message' => '昵称已存在'));
        }
    }

    public function checkAccount()
    {
        if (!IS_AJAX) {
            E("页面不存在");
//            原3.1版本中的halt方法已经废弃，请使用E函数代替。
//            isajax()方法已经弃用

        }
        //$account=htmlspecialchars($_POST['account']);
        $account = I('post.account', '', 'htmlspecialchars');

        $where = array('account' => $account);
        $compare = M('user')->where($where)->getField('id');
        if (!$compare) {
            $this->ajaxReturn(array('valid' => true));
        } else {
            $this->ajaxReturn(array('valid' => false, 'message' => '账号已存在'));
        }
    }


}