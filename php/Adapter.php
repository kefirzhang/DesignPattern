<?php
/**
 * @desc 在计算机编程中，适配器模式（有时候也称包装样式或者包装）将一个类的接口适配成用户所期待的。一个适配允许通常因为接口不兼容而不能在一起工作的类工作在一起，做法是将类自己的接口包裹在一个已存在的类中。
 * 简单点说，适配器模式是指：定义一个类，将一个已经存在的类，转换成目标接口所期望的行为形式。
 */
//Part 对象适配器
namespace ObjectAdapter{
    
    interface ServerInterface{
        public function funcOne();
        public function funcTwo();
    }
    class Server{
        public function funcOne(){
            echo __FUNCTION__;
        }
        public function funcThree(){
            echo __FUNCTION__;
        }
    }
    class ServerAdapter implements ServerInterface{
        private $server;
        public function __construct(Server $server){
            $this->server = $server;
        }
        public function funcOne(){
            $this->server->funcOne();
        }
        public function funcTwo(){
            $this->server->funcThree();
        }
    }
    class Client{
        public function getServerInfo(){
            //$server = new Server();
            $server = new Server();
            $serverAdapter = new ServerAdapter($server);
            $serverAdapter->funcOne();//funcOne
            $serverAdapter->funcTwo();//funcThree
        }
    }
    $client = new Client();
    $client->getServerInfo();
    echo "\r\n";
}

namespace ClassAdapter{
    //PartOne 类适配器
    class Server{
        public function funcOne(){
            echo __FUNCTION__;
        }
        
        //Server代码 这个函数稍后会被 funcThree 代替 这个函数会被舍掉
        /*
        public function funcTwo(){
            echo __FUNCTION__; 被更改的函数
        }
        */
        //Server代码
        public function funcThree(){
            echo __FUNCTION__;
        }
    }
    
    interface Adapter{
        public function funcOne();
        public function funcTwo();
    }
    
    class ServerAdapter extends Server implements Adapter{
        public function funcTwo(){
            parent::funcThree();
        }
    }
    
    
    class Client{
        public function getServerInfo(){
            //$server = new Server();
            $server = new ServerAdapter();
            $server->funcOne();//funcOne
            $server->funcTwo();//funcThree
        }
    }
    $client = new Client();
    $client->getServerInfo();
}