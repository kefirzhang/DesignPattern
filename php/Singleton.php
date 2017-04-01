<?php
/**
 * @desc ����ģʽ��һ�ֳ��õ�������ģʽ�������ĺ��Ľṹ��ֻ����һ������Ϊ�����������ࡣͨ������ģʽ���Ա�֤ϵͳ��һ����ֻ��һ��ʵ��
 * �ο�����
 * @link http://php.net/manual/zh/language.oop5.magic.php 
 * @link https://wwphp-fb.github.io/articles/object-oriented-programming/design-patterns/singleton/
 * @link http://www.phptherightway.com/pages/Design-Patterns.html
 */
class Singleton{
    //˽�б����������浥��
    private static $_instance;
    //˽�л���������  ֻ���Լ����ã�����ͨ��new ʵ����
    private final function __construct(){}
    /**
     * @desc ֻ��ͨ������ӿ�����ȡʵ��
     * @return singleTon ����ʵ����
     */
    public static function getInstance(){
        if(!self::$_instance instanceof  self){
            self::$_instance = new singleTon();   
        }
        return self::$_instance;
    }
    /**
     * @desc ��ֹͨ����¡������ɶ��ʵ��  ���� private ˽�л���ǰ����
     * @return Exception �쳣�׳�
     */
    public function __clone(){
        throw new Exception('You cannot clone singleton object');
    }
    /**
     * @desc ��ֹ���л���¡������ɶ��ʵ�� ���� private ˽�л���ǰ����
     * @return Exception �쳣�׳�
     */
    public function __wakeup(){
        throw new Exception('You cannot unserializing singleton object');
    }
    /**
     * @desc ������������ ��������
     * @return __FUNCTION__ ���ص�ǰ������
     */
    public function funcOne(){
        return __FUNCTION__;
    }
}
$instance = Singleton::getInstance();
/**
 * �������л�
$serlizeObj = serialize($instance);
$objOne     = unserialize($serlizeObj);
$objTwo     = unserialize($serlizeObj);
var_dump($objOne === $objTwo); //return false ���л�������ɶ��ʾ��
**/

/**
 * $b = new Singleton();
 * return fatal error ���ܱ�ʵ���� ֻ��ͨ������ʵ��
 */

/** ���Դ���
$instance = Singleton::getInstance();
$instance_clone = clone $instance;
var_dump($instance === $instance);  //return false clone������ɶ��ʾ��
*/
