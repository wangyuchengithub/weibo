<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController
{
    public function index()
    {
        $view = D('TweetView');
        // $uid存放当前用户和当前用户关注的用户id
        $uid = array(session('uid'));
        $followStats = M('follow')->where(array('fans' => session('uid')))->field('follow')->select();
        foreach ($followStats as $k => $v) {
            $uid[] = $v['follow'];
        }
        $where = array('uid' => array('IN', $uid));
        $result = $view->getAllBlog($where);
        $this->assign('weiboContent', $result);
        $this->display();
    }


    // 评论
    public function sendComment()
    {
        if (!IS_AJAX) {
            E('错误');
        }
        $wid=I('wid');
        $uid=session('uid');
        $data=array(
            'content'=>I('commentVal'),
            'wid'=>$wid,
            'uid'=>$uid,
            'time'=>time()
        );
        $myCommentId=M('comment')->add($data);
        if($myCommentId){
            M('tweet')->where(array('id'=>$wid))->setInc('comment');

            $myComment = D('CommentView')->find($myCommentId);
            $this->ajaxReturn(array('stats'=>'1','myComment'=>$myComment));
        }else{
            $this->ajaxReturn(array('stats'=>'0'));
        }

    }

    //异步获取评论
    public function getComment()
    {
        if (!IS_AJAX) {
            E('错误');
        }
        $wid = I('wid', '', 'intval');
        $where = array('wid' => $wid);
        $comment = D('CommentView')->where($where)->order('time DESC')->select();
        foreach ($comment as $k => $v) {
            $comment[$k]['time'] = timeFormat($comment[$k]['time']);
            $comment[$k]['content']=replaceContent($comment[$k]['content']);
        }
        $this->ajaxReturn($comment);
    }



    // 转推
    public function turnBlog()
    {
//        ccc($_POST);
        $turnTime = time();
        $turnContent = I('turnContent');
        $tweetDb = M('tweet');
        $commentDb=M('comment');
        $oriWid=I('oriWid');
        $secWid=I('secWid');
        $data = array(
            'content' => $turnContent,
            'time' => time(),
            'isturn' => $oriWid,
            'uid' => session('uid')
        );
        $tweetDb->add($data);
        $tweetDb->where(array('id' => $oriWid))->setInc('turn', 1);
//        判断是否是二次转发
        if($secWid){
            $tweetDb->where(array('id' => $secWid))->setInc('turn', 1);
//            判断是否选中评论当前推
            if (I('turnComment')) {
                $commentData = array(
                    'time' => $turnTime,
                    'content' => $turnContent,
                    'uid' => session('uid'),
                    'wid' => $secWid
                );
                $commentDb->add($commentData);
                $tweetDb->where(array('id'=>$secWid))->setInc('comment',1);
            }
        }
//            判断是否选中评论原推
        if(I('turnCommentOri')){
            $commentData=array(
                'time'=>$turnTime,
                'content'=>$turnContent,
                'uid'=>session('uid'),
                'wid'=>$oriWid
            );
            $commentDb->add($commentData);
            $tweetDb->where(array('id'=>$oriWid))->setInc('comment',1);
        }
        $this->redirect('Home/Index/index', 1);
    }

    // 发推
    public function sendBlog()
    {
        // 判断是否添加了图片
        if (I('weiboImgPath')) {
            $test = I('weiboImgPath');
            $tempPic = APP_PATH . $test;
            $randomid = uniqid();
            $newPic = APP_PATH . 'Uploads/pic/' . $randomid . '.jpg';
            $thumbPic = APP_PATH . 'Uploads/pic/' . $randomid . '_thumb.jpg';
            if (copy($tempPic, $newPic)) {
                unlink($tempPic);
                $image = new \Think\Image();
                $image->open($newPic);
                $image->thumb(120, 120)->save($thumbPic);
                $data['pic'] = $newPic;
                $data['thumbpic'] = $thumbPic;
            }
        }
        $db = M('tweet');
        $data['content'] = I('content');
        $data['time'] = time();
        $data['uid'] = session('uid');
        // ccc($data);

        if ($db->add($data)) {
            $this->success('发布成功');
        } else {
            $this->error('发布失败');
        }
    }


    // 推文配图预览
    public function weiboPicPreview()
    {
        $session = session('uid');
        $upload = new \Think\Upload();
        $upload->maxSize = 2000000;
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');
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


    // 登出
    public function logout()
    {
        session('uid', null);
        cookie('auto', null);
        $this->redirect('Home/Index/Index');
    }
}