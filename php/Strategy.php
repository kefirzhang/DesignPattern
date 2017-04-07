<?php
/**
 * @desc 策略模式定义了一系列的算法，并将每一个算法封装起来，而且使它们还可以相互替换。策略模式让算法独立于使用它的客户而独立变化。
 * 策略模式跟工厂模式的区别，工厂模式是根据条件生产对应的对象给客户端用，策略模式是自己生产的类传入进行操作
 * 我们还用工厂模式里面的那个case
 * 假设编写一个子程序，打印存储在一份文件中的消息，通常该文件会存储500调消息，而每份文件中会存储大约20中不同的消息，每个消息需要做单独的处理,采用工厂模式 可以灵活添加新的对应类型进行扩展！
 */


/**
 * 消息处理策略
 */
interface MessageStrategy{
    public function messageAlgorithm();
}
/**
 *@desc 具体策略 case
 */
class EchoCliMessageStrategy implements MessageStrategy{
    public function messageAlgorithm(){
        //Func Coding........
        echo "Strategy:".__CLASS__;
    }
}
/**
 *@desc 具体策略 case
 */
class SaveTxtMessageStrategy implements MessageStrategy{
    public function messageAlgorithm(){
        //Func Coding........
        echo "Strategy:".__CLASS__;
    }
}
/**
 *@desc 具体策略 case
 */
class SaveDBMessageStrategy implements MessageStrategy{
    public function messageAlgorithm(){
        //Func Coding........
        echo "Strategy:".__CLASS__;
    }
}
/**
 *@desc 具体策略 case
 */
class SaveRedisMessageStrategy implements MessageStrategy{
    public function messageAlgorithm(){
        //Func Coding........
        echo "Strategy:".__CLASS__;
    }
}
/**
 * @desc 客户端类或者环境类，定义一个接口让strategy访问对应的数据接口
 */
class MessageClient{
    private $_strategy;
    public function __construct(MessageStrategy $strategy){
        $this->_strategy = $strategy;
    }
    public function setStrategy(MessageStrategy $strategy){
        $this->_strategy = $strategy;
    }
    public function handleMessage(){
        $this->_strategy->messageAlgorithm();
    }
}
//消息直接输出
$message = new MessageClient(new EchoCliMessageStrategy());
$message->handleMessage();
//消息通过Redis处理
$message = new MessageClient(new SaveRedisMessageStrategy());
$message->handleMessage();
//变更策略
$message->setStrategy(new SaveDBMessageStrategy());
$message->handleMessage();




