<?php
/**
 * @desc ����ģʽ��һ�ֳ��õ�������ģʽ�������ĺ��Ľṹ��ֻ����һ������Ϊ�����������ࡣͨ������ģʽ���Ա�֤ϵͳ��һ����ֻ��һ��ʵ��
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