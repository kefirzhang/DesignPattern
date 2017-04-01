<?php
/**
 * @desc 单例模式是一种常用的软件设计模式。在它的核心结构中只包含一个被称为单例的特殊类。通过单例模式可以保证系统中一个类只有一个实例
 * 
 */
class singleTon{
    private static $_instance;
    private final function __construct(){
        echo 'test construct';
    }
    public static function getInstance(){
        if(!self::$_instance instanceof  self){
            self::$_instance = new singleTon();   
        }
        return self::$_instance;
    }
}
singleTon::getInstance();