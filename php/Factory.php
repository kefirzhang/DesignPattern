<?php
/**
 * @desc 工厂方法模式（英语：Factory method pattern）是一种实现了“工厂”概念的面向对象设计模式。就像其他创建型模式一样，它也是处理在不指定对象具体类型的情况下创建对象的问题。
 * 工厂方法模式的实质是“定义一个创建对象的接口，但让实现这个接口的类来决定实例化哪个类。工厂方法让类的实例化推迟到子类中进行。
 * 参考资料 工厂模式主要是为创建对象提供过渡接口，以便将创建对象的具体过程屏蔽隔离起来，达到提高灵活性的目的。 
 * @todo 假设编写一个子程序，打印存储在一份文件中的消息，通常该文件会存储500调消息，而每份文件中会存储大约20中不同的消息，每个消息需要做单独的处理,采用工厂模式 可以灵活添加新的对应类型进行扩展！
 * @link https://zh.wikipedia.org/wiki/%E5%B7%A5%E5%8E%82%E6%96%B9%E6%B3%95
 * @link http://www.phptherightway.com/pages/Design-Patterns.html
 * 
 */


class BuoyechoCli{
    private $id;
    private $msg;
    public function __construct($id,$msg){
        $this->id   = $id;
        $this->msg  = $msg;
    }
    public function doAct(){
        /**
         * 具体的Coding
         */
        echo "ID:".$this->id.";Msg:".$this->msg."\r\n";
    }
}
class BuoysaveTxt{
    private $id;
    private $msg;
    public function __construct($id,$msg){
        $this->id   = $id;
        $this->msg  = $msg;
    }
    public function doAct(){
        /**
         * 具体的Coding
         */
        echo "ID:".$this->id.";Msg:".$this->msg."\r\n";
    }
}
class BuoysaveDB{
    private $id;
    private $msg;
    public function __construct($id,$msg){
        $this->id   = $id;
        $this->msg  = $msg;
    }
    public function doAct(){
        /**
         * 具体的Coding
         */
        echo "ID:".$this->id.";Msg:".$this->msg."\r\n";
    }
}
class BuoysaveRedis{
    private $id;
    private $msg;
    public function __construct($id,$msg){
        $this->id   = $id;
        $this->msg  = $msg;
    }
    public function doAct(){
        /**
         * 具体的Coding
         */
        echo "ID:".$this->id.";Msg:".$this->msg."\r\n";
    }
}


class BuoyFactory{
    public static function create($id,$type,$msg){
        $BuoyCaseName = "Buoy".$type;
        if(class_exists($BuoyCaseName,true)){
            return new $BuoyCaseName($id,$msg);
        }else{
            throw new Exception("Class Not Exsit");
        }
    }
    
}
$messages = array(
    array('id'=>'1','type'=>'echoCli','msg'=>'直接输出'),
    array('id'=>'2','type'=>'saveTxt','msg'=>'保存到对应的Txt文本'),
    array('id'=>'3','type'=>'saveDB','msg'=>'保存到DB'),
    array('id'=>'4','type'=>'saveRedis','msg'=>'保存到Redis'),
    array('id'=>'5','type'=>'echoCli','msg'=>'直接输出'),
    array('id'=>'6','type'=>'saveTxt','msg'=>'保存到对应的Txt文本'),
    array('id'=>'7','type'=>'saveDB','msg'=>'保存到DB'),
    array('id'=>'8','type'=>'saveRedis','msg'=>'保存到Redis'),
    array('id'=>'9','type'=>'saveGD2','msg'=>'保存到Redis')
);
foreach ($messages as $message){
    BuoyFactory::create($message['id'], $message['type'], $message['msg'])->doAct();
}
