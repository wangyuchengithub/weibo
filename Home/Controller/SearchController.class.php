<?php
namespace Home\Controller;

use Think\Controller;

class SearchController extends CommonController
{

    public function searchUser()
    {
        $keyword = I('searching');
        $this->assign('keyword', $keyword);
        $session = session('uid');
        $where = array(
            'username' => array('LIKE', '%' . $keyword . '%'),
            'uid' => array('NEQ', $session)
        );
        $result = $this->_setPage('userinfo', $where, 4);

        $this->_assignMutual('searchList', $result);
        $userGroup = M('group')->where(array('uid' => $session))->order('id asc')->select();
        $this->assign('userGroup', $userGroup);
        $this->display();
    }

    public function addGroup()
    {
        if (!IS_AJAX) {
            E('错误');
        }
        $groupName = I('groupName', '', 'htmlspecialchars');
        $session = session('uid');
        $data = array(
            'name' => I('groupName', '', 'htmlspecialchars'),
            'uid' => session('uid')
        );
        $db = M('group');
        $id = $db->add($data);
        if ($id) {
            $userGroup = $db->find($id);
            // echo $userGroup;
            $this->ajaxReturn(array('stats' => 1, 'msg' => '添加分组成功！', 'newGroup' => $userGroup));
        } else {
            $this->ajaxReturn(array('stats' => 0, 'msg' => '添加分组失败，请重试...'));
        }

    }

    public function follow()
    {
        if (!IS_AJAX) {
            E('错误');
        }
        $data = array(
            'follow' => I('uid'),
            'fans' => session('uid'),
            'gid' => I('gid')
        );
        if (M('follow')->add($data)) {
            $this->ajaxReturn(array('newFollowed' => 1, 'msg' => '关注成功'));
        } else {
            $this->ajaxReturn(array('newFollowed' => 0, 'msg' => '关注失败，请重试'));
        }
    }

    public function removFollow()
    {
        if (!IS_AJAX) {
            E('错误');
        }
        $where = array(
            'follow' => I('uid'),
            'fans' => session('uid')
        );
        $db = M('follow');
        $checkDelNum = $db->where($where)->delete();
        if ($checkDelNum) {
            $this->ajaxReturn(array('deleted' => 1, 'msg' => '取消关注成功'));
        } else {
            $this->ajaxReturn(array('deleted' => 0, 'msg' => '取消关注失败'));
        }

    }

    // public function getGroup(){
    //     if (!IS_AJAX){
    //         E('错误');
    //     }

    //     $session=session('uid');

    //     $userGroup=M('group')->where(array('uid'=>session('uid')))->select();
    //     $this->ajaxReturn($userGroup);


    // }

    public function searchTweet()
    {

    }

    // 查询需分页的数据
    private function _setPage($pageDb, $where, $num)
    {
        $db = M($pageDb);
        $count = $db->where($where)->count('id');
        $page = new \Think\Page($count, $num);
        $page->setConfig('theme', '
            <ul class="pagination">
            <li>%UP_PAGE%</li>
            <li>%FIRST%</li>
            <li >%LINK_PAGE%</li>
            <li>%END%</li>
            <li>%DOWN_PAGE%</li>
            </ul>'
        );
        $limit = $page->firstRow . ',' . $page->listRows;
        $show = $page->show();
        $this->assign('show', $show);
        return $db->where($where)->limit($limit)->select();

    }

    //查询关注并获得最终结果
    private function _assignMutual($assignName, $result)
    {
        $db = M('follow');
        foreach ($result as $k => $v) {
            $sql = '(SELECT `follow` FROM `ly_follow` WHERE `follow` = ' . $v['uid'] . ' AND `fans` = ' . session('uid') . ') 
            UNION (SELECT `follow` FROM `ly_follow` WHERE `follow` = ' . session('uid') . ' AND `fans` = ' . $v['uid'] . ')';
            $mutual = $db->query($sql);
            $mutualStats = count($mutual);
            if ($mutualStats == 2) {
                $result[$k]['followStats'] = 2;
            } else {
                $where = array(
                    'follow' => $v['uid'],
                    'fans' => session('uid')
                );
                if ($db->where($where)->count()) {
                    $result[$k]['followStats'] = 1;
                }
            }
        }
        $this->assign($assignName, $result);
    }


}



