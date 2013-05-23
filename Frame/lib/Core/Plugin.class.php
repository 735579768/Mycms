<?php
class Plugin{
    public $actionList = array();    //所有插件中的函数都将保存在这里
    
    function addAction($functionName, $args=array()) {
        global $actionList;
        //$actionList中的每一项都是一个array，array的第一项是函数名，第二项是参数列表
        $actionList[] = array('function'=>$functionName, 'args'=>$args);
    }

    function doAction() {
        global $actionList;
        foreach($actionList as $action) {    //运行$actionList中的所有函数，简单起见，不用hook
            call_user_func_array($action['function'], $action['args']);
        }
    }
}
?>