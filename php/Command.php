<?php
/**
 * @desc  命令模式
 * 命令模式将“请求”封装成对象，以便使用不同的请求，队列或者日志来参数化其他对象，命令模式也支持可撤销的操作。
 * 使得请求发送者与请求接收者消除彼此之间的耦合，让对象之间的调用关系更加灵活。
 * 
 * 一个顾客向服务员下了一单厨师李四做的鱼香肉丝的菜单
 * 
 * Command: 抽象命令类 做菜
　　ConcreteCommand: 具体命令类 做一个鱼香肉丝的菜
　　Invoker: 调用者  服务员
　　Receiver: 接收者 厨师
　　Client:客户类 顾客
实例， 推送一个请求更新的命令，更新一篇文章
 */
interface Command{ //接口订单 所有的订单需要实现这个execute方法
    public function execute();
}
//具体的订单 例如来个鱼香肉丝
class YXRSCommand implements Command{
    private $receiver;//命令的具体执行者或者说是接受者
    public function __construct(Receiver $receiver){
        $this->receiver = $receiver;
    }
    public function execute(){
        return $this->receiver->doYXYS(); //封装一个让厨师做一道鱼香肉丝的菜
    }
}
//比如厨师
class Receiver{ //一般是具体的类，第三方提供的类 
    private $name;
    public function __construct($name){
        $this->name = $name; //某一个厨师
    }
    //第三方一般会有很多的具体的函数
    public function doGBJD(){ // 宫保鸡丁
        return $this->name.__FUNCTION__;
    }
    public function doYXYS(){// 鱼香肉丝
        return $this->name.__FUNCTION__;
    }
    public function doFQFP(){// 夫妻肺片
        return $this->name.__FUNCTION__;
    }
    /**
     * funtions  dengdeng 
     */
}
class Invoker { //招待员 招待员接到下的订单命令 并让这个封装的命令执行
    private $concreteCommand;//具体的封装了reciver和具体的execute的类
    public function __construct(Command $concreteCommand){ //这边可以用setCommand 封装多个命令 
        $this->concreteCommand = $concreteCommand;
    }
    public function setCommand(Command $concreteCommand){ //这边可以用setCommand 封装多个命令
        $this->concreteCommand = $concreteCommand;
    }
    public function executeCommand(){ // 招待下单 触发执行  orderUp
        return $this->concreteCommand->execute();
    }
}

class Client{
    
    function doUpAction(){
       $receiver = new Receiver('李四');//一个叫李四的厨师
       $YXRSCommand = new YXRSCommand($receiver); //一道让李四这个厨师做一个鱼香肉丝的命令
       $invoker = new Invoker($YXRSCommand);  //把这个订单交给一个招待
       return $invoker->executeCommand(); //招待执行这个命令
    }
}

$client = new Client();
echo $client->doUpAction();
