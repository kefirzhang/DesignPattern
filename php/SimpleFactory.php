<?php
//暂时找不到更好的案例，那么就按照书本中的披萨店的实例来，首先一个店铺有多重口味的披萨
class CheesePizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
class GreekPizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
class PepperoniPizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
//初版的订购一个pizza 
class OrderPizza{
    public $pizza;//
    public function __construct($type){
        if($type == 'cheese'){
            $this->pizza = new CheesePizza;
        } elseif($type == 'greek'){
            $this->pizza = new GreekPizza;
        } elseif($type == 'pepperoni'){
            $this->pizza = new PepperoniPizza;
        }
        $this->pizza->prepare();
        $this->pizza->bake();
        $this->pizza->cut();
        $this->pizza->box();
    }
}
$order = new OrderPizza('cheese');
$pizza = $order->pizza;
echo $pizza->message;
echo "\r\n";
//简单工厂模式
class SimplePizzaFactory{
    public $pizza;
    public function createPizza($type){
        if($type == 'cheese'){
            $this->pizza = new CheesePizza;
        } elseif($type == 'greek'){
            $this->pizza = new GreekPizza;
        } elseif($type == 'pepperoni'){
            $this->pizza = new PepperoniPizza;
        }
        return $this->pizza;
    }
}
//声明一个披萨店铺
class PizzStore{
    public $factory;
    public $pizza;
    public function __construct(SimplePizzaFactory $factory){
        $this->factory = $factory;
    }
    public function orderPizza($type){
        $this->pizza = $this->factory->createPizza($type);
        $this->pizza->prepare();
        $this->pizza->bake();
        $this->pizza->cut();
        $this->pizza->box();
        return $this->pizza; //获得一个正式的可以售卖的披萨
    }
}
$pizzaStore = new PizzStore(new SimplePizzaFactory()); // 实例话一个披萨店
$pizza = $pizzaStore->orderPizza('cheese'); //订购一个披萨
echo $pizza->message; //这个披萨的信息

//简单工厂模式其实只是把所有实例化的创建代码的部分封装起来，当新增一种pizza 或者减少pizza的时候 只需要修改工厂就可以了  
//披萨店不用修改，从而达到将实例化具体类的代码从应用中抽离出来，或者封装起来，使他们不会干扰应用的其他部分