<?php
/**
 * Facade（外观）模式为子系统中的各类（或结构与方法）提供一个简明一致的界面，隐藏子系统的复杂性，使子系统更加容易使用。它是为子系统中的一组接口所提供的一个一致的界面
 * 这在某种意义上与Adapter及Proxy有类似之处，但是，
 * Proxy（代理）注重在为Client-Subject提供一个访问的中间层，如CORBA可为应用程序提供透明访问支持，使应用程序无需去考虑平台及网络造成的差异及其它诸多技术细节；
 * Adapter（适配器）注重对接口的转换与调整；而Facade所面对的往往是多个类或其它程序单元，通过重新组合各类及程序单元，对外提供统一的接口/界面。
 * 注意区分Façade模式、Adapter模式、Bridge模式与Decorator模式。
 * Façade模式注重简化接口，
 * Adapter模式注重转换接口，
 * Bridge模式注重分离接口（抽象）与其实现，
 * Decorator模式注重稳定接口的前提下为对象扩展功能
 * @link http://www.phperz.com/article/15/0126/7859.html
 */
class SystemOne{
    public function FuncOne(){
        echo __CLASS__.'-'.__FUNCTION__;
    }
}
class SystemTwo{
    public function FuncTwo(){
        echo __CLASS__.'-'.__FUNCTION__;
    }
}
class SystemThree{
    public function FuncTwo(){
        echo __CLASS__.'-'.__FUNCTION__;
    }
}


class Facade{
    private $_objectOne = null;
    private $_objectTwo = null;
    private $_objectThree = null;
    public function __construct(){
        $this->_objectOne = new SystemOne();
        $this->_objectTwo = new SystemTwo();
        $this->_objectThree = new SystemThree();
    }
    public function Func(){
        $this->_objectOne->FuncOne();
        $this->_objectTwo->FuncTwo();
        $this->_objectThree->FuncThree();
    }
        
    
}