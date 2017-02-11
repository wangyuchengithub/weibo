<?php
namespace Home\Model;
use Think\Model\RelationModel;
class UserRelationModel extends RelationModel{
    protected $tableName='user';

    protected $_link=array(
        'userinfo'=>array(
            'mapping_type'  =>      self::HAS_ONE,
            'foreign_key'       =>      'uid',

        )
    );

    public function insert($data=NULL){
        $data=is_null($data)?$_POST :$data;
        return $this->relation('userinfo')->add($data);
    }

}