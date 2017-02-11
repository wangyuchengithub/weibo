<?php
namespace Home\Controller;

use Think\Controller;

class CommonController extends Controller
{


//    function __construct(){
//        parent::__construct();  //若用该方法必须调用父类的构造方法，否则父类函数无法使用
//
//    }
    // 加密


    /**
     * 判断自动登入逻辑
     * 1、判断cookies存在，session不存在，执行下一步
     * 2、解密cookies
     * 3、explode将cookies拆分
     * 4、判断当前客户端IP与cookiesIP是否一致，一致则下一步，get_client_ip
     * 5、判断用户是否lock，lock状态则将session删除并且返回提示
     *
     *
     */
// 初始化
    public function _initialize()
    {
//        echo __ROOT__;die;
        // 若勾选自动登入判断cookie并自动登入
        $cookie = cookie('auto');
        $session = session('uid');
        if (!$session) {
            $this->redirect('Home/LogReg/index');
        }
        // ccc($session);
        if ($cookie && !$session) {
            $decode = encryption($cookie, 1);
            $arr = explode('|', $decode);
            $ip = get_client_ip();
            if ($arr[1] == $ip) {
                $where = array('account' => $arr[0]);
                $user = M('user')->where($where)->field(array('id', 'lock'))->find();
                if ($user && !$user['lock']) {
                    $session = session('uid', $user['id']);
                    //ccc($session);
                }
            }
        }
        // $session=session('uid');


        $where = array('id' => $session);
        $where1 = array('uid' => $session);
        $field1 = array('username', 'face180', 'face80', 'face50');
        $userAccount = M('user')->where($where)->getfield('account');
        $userMainInfo = M('userinfo')->where($where1)->field($field1)->find();
        $this->userAccount = $userAccount;
        $this->userMainInfo = $userMainInfo;

    }


}