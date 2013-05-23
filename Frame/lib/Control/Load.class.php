<?php
class load{
    // 保存类实例在此属性中
    private static $instance;
       // 构造方法声明为private，防止直接创建对象
    private function __construct() 
    {
    }
    // singleton 方法
    public static function getinstance() 
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
        return self::$instance;
    }
    // 阻止用户复制对象实例
    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
}
?>