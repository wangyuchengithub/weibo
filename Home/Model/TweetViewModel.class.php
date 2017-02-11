<?php
namespace Home\Model;
use Think\Model\ViewModel;
class TweetViewModel extends ViewModel{
    protected $viewFields=array(
    	'tweet'=>array(
    		'id','content','isturn','time','turn','collect','comment','pic','thumbpic','uid',
    		'_type'=>'LEFT'
    	),
    	'userinfo'=>array(
    		'username','sex','face80'=>'face',
    		'_on'=>'tweet.uid=userinfo.uid'
    

    	)
    );

    // 判断是否为转发微博
    public function getAllBlog($where){

    	$result=$this->where($where)->order('time DESC')->select();

        if($result){
            foreach ($result as $k=>$v) {                
                // $$result[$k]['originalTweet']=M('tweet')->where(array('id'=>$v['isturn']))->find();
                $temp=$this->find($v['isturn']);
                $result[$k]['originalTweet']=$temp;                
            }
        }

    	return $result;

    }
}