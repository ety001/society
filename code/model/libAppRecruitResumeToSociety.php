<?php
class libAppRecruitResumeToSociety extends spModel
{
    var $pk = "id"; // 数据表的主键
    var $table = "app_recruit_resume_to_society"; // 数据表的名称
    var $linker = array(
                array(
                        'type' => 'hasone',   // 关联类型，这里是一对一关联
                        'map' => 'societyInfo',    // 关联的标识
                        'mapkey' => 'sa_id', // 本表与对应表关联的字段名
                        'fclass' => 'libSocietyAccount', // 对应表的类名
                        'fkey' => 'id',    // 对应表中关联的字段名
                        'enabled' => true     // 启用关联
                ),
                array(
                        'type' => 'hasone',   // 关联类型，这里是一对一关联
                        'map' => 'teamInfo',    // 关联的标识
                        'mapkey' => 'team_id', // 本表与对应表关联的字段名
                        'fclass' => 'libSocietyTeam', // 对应表的类名
                        'fkey' => 'id',    // 对应表中关联的字段名
                        'enabled' => true     // 启用关联
                )
            );
    function findAllRelations($conditions=null,$sort=null,$fields=null,$limit=null){
        if(!$conditions)return;
        $info = $this->spLinker()->findAll($conditions,$sort,$fields,$limit);
        foreach ($info as $k => $v) {
            $info[$k]['resume'] = unserialize($v['resume_content']);
        }
        return $info;
    }
}