<?php
/**
 * @desc 单例模式是一种常用的软件设计模式。在它的核心结构中只包含一个被称为单例的特殊类。通过单例模式可以保证系统中一个类只有一个实例
 * 参考资料
 * @link http://php.net/manual/zh/language.oop5.magic.php 
 * @link https://wwphp-fb.github.io/articles/object-oriented-programming/design-patterns/singleton/
 * @link http://www.phptherightway.com/pages/Design-Patterns.html
 */
class Singleton{
    //私有变量用来保存单例
    private static $_instance;
    //私有化析构函数  只能自己调用，不能通过new 实例化
    private final function __construct(){}
    /**
     * @desc 只能通过这个接口来获取实例
     * @return singleTon 返回实例类
     */
    public static function getInstance(){
        if(!self::$_instance instanceof  self){
            self::$_instance = new singleTon();   
        }
        return self::$_instance;
    }
    /**
     * @desc 防止通过克隆对象造成多个实例  或者 private 私有化当前函数
     * @return Exception 异常抛出
     */
    public function __clone(){
        throw new Exception('You cannot clone singleton object');
    }
    /**
     * @desc 防止序列化克隆对象造成多个实例 或者 private 私有化当前函数
     * @return Exception 异常抛出
     */
    public function __wakeup(){
        throw new Exception('You cannot unserializing singleton object');
    }
    /**
     * @desc 公共函数服务 用来测试
     * @return __FUNCTION__ 返回当前函数名
     */
    public function funcOne(){
        return __FUNCTION__;
    }
}
$instance = Singleton::getInstance();
/**
 * 测试序列化
$serlizeObj = serialize($instance);
$objOne     = unserialize($serlizeObj);
$objTwo     = unserialize($serlizeObj);
var_dump($objOne === $objTwo); //return false 序列化可以造成多个示例
**/

/**
 * $b = new Singleton();
 * return fatal error 不能被实例化 只能通过自身实例
 */

/** 测试代码
$instance = Singleton::getInstance();
$instance_clone = clone $instance;
var_dump($instance === $instance);  //return false clone可以造成多个示例
*/
