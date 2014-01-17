<?php
class libFollowSociety extends spModel
{
    var $pk = "id"; // 数据表的主键
    var $table = "follow_society"; // 数据表的名称
    var $linker = array(
        array(
                'type' => 'hasone',   // 关联类型，这里是一对一关联
                'map' => 'societyDetail',    // 关联的标识
                'mapkey' => 'sa_id', // 本表与对应表关联的字段名
                'fclass' => 'libSocietyAccount', // 对应表的类名
                'fkey' => 'id',    // 对应表中关联的字段名
                'enabled' => true     // 启用关联
        )
    );

    public function isFav($uid='',$sid=''){
        if($uid && $sid){
            $conditions = array('uid'=>$uid,'sa_id'=>$sid);
            if($this->find($conditions)){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}