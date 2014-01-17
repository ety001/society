<?php
class libSocietyAccount extends spModel
{
    var $pk = "id"; // 数据表的主键
    var $table = "society_account"; // 数据表的名称
    // 我们定义自己的验证规则
    var $addrules = array(
                        'isLoginNameExist' => array('libSocietyAccount','checkLoginNameExist') //  '规则名称' => '验证函数名'
                    );
    // 定义验证规则
    var $verifierReg = array(
                        "rules" => array( // 规则
                            'society_login_name' => array(  // 这里是对society_login_name的验证规则
                                'notnull' => TRUE, // society_login_name不能为空
                                'isLoginNameExist' => TRUE,//society_login_name
                                'minlength' => 2,  // society_login_name长度不能小于2
                                'maxlength' => 40, // society_login_name长度不能大于40
                            ),
                            'password' => array(   // 这里是对password的验证规则
                                'notnull' => TRUE, // password不能为空
                                'minlength' => 8,  // password长度不能小于8
                            ),
                            're_password' => array(  // 这里是对第二次输入的密码的验证规则
                                'equalto' => 'password', // 要等于'password'，也就是要与上面的密码相等
                            ),   
                            'email' => array(   // 这里是对email的验证规则
                                'notnull' => TRUE, // email不能为空
                                'email' => TRUE,   // 必须要是电子邮件格式
                            ),
                            'society_name' => array(   // 这里是对society_name的验证规则
                                'notnull' => TRUE, // society_name不能为空
                                'maxlength' => 40, // society_name长度不能大于40
                            )
                        ),
                        "messages" => array( // 规则
                            'society_login_name' => array(
                                'notnull' => '登陆名不能为空',
                                'isLoginNameExist' => '登陆名已经存在',
                                'minlength' => '登陆名长度不能小于2',
                                'maxlength' => '登陆名长度不能大于40'
                            ),
                            'password' => array(
                                'notnull' => '密码不能为空',
                                'minlength' => '密码长度不能小于8'
                            ),
                            're_password' => array(
                                'equalto' => '两次密码不同'
                            ),   
                            'email' => array(
                                'notnull' => 'email不能为空',
                                'email' => '必须要是电子邮件格式'
                            ),
                            'society_name' => array(
                                'notnull' => '社团名不能为空',
                                'maxlength' => '社团名长度不能大于40'
                            )
                        )
                    );
    var $verifierLogin = array(
                        "rules" => array( // 规则
                            'society_login_name' => array(  // 这里是对society_login_name的验证规则
                                'notnull' => TRUE // society_login_name不能为空
                            ),
                            'password' => array(   // 这里是对password的验证规则
                                'notnull' => TRUE, // password不能为空
                            )
                        ),
                        "messages" => array( // 规则
                            'society_login_name' => array(
                                'notnull' => '登陆名不能为空'
                            ),
                            'password' => array(
                                'notnull' => '密码不能为空'
                            )
                        )
                    );
    var $verifierSocietyInfoSave = array(
                        "rules" => array( // 规则
                            'logo' => array(
                                'notnull' => TRUE // Logo不能为空
                            ),
                            'desp' => array(
                                'notnull' => TRUE, // desp不能为空
                            )
                        ),
                        "messages" => array( // 规则
                            'logo' => array(
                                'notnull' => '社团Logo不能为空'
                            ),
                            'desp' => array(
                                'notnull' => '社团简介不能为空'
                            )
                        )
                    );
    public function checkLoginNameExist($input, $right){
        $result = $this->findBy('society_login_name',$input);
        if($right == $result){
            return FALSE;
        } else {
            return TRUE;
        }
    }
}