<?php 
//继续上面的披萨店的例子 假如要开分店 怎么来做更好  假如两家分店 纽约和芝加哥
abstract class Pizza{
    public $message;
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
abstract class PizzaStore{
    public $pizza;
    public function orderPizza($type){
        $this->pizza = $this->createPizza($type);
        if(!($this->pizza instanceof Pizza)){ //如果当前Pizza 不是Pizza的子类的实例 那么约束不成立，异常
            throw new Exception("Pizza Not Right");
        }
        $this->pizza->prepare();
        $this->pizza->bake();
        $this->pizza->cut();
        $this->pizza->box();
        return $this->pizza;
    }
    public abstract function createPizza($type);
}
//纽约的一家分店
class NYStyleCheesePizza extends Pizza{public function __construct(){$this->message = __CLASS__;}}
class NYStyleGreekPizza extends Pizza{public function __construct(){$this->message = __CLASS__;}}
class NYStylePepperoniPizza extends Pizza{public function __construct(){$this->message = __CLASS__;}}
class NYPizzaStore extends PizzaStore{
    public function createPizza($type){
        if($type == 'cheese'){
            $this->pizza = new NYStyleCheesePizza;
        } elseif($type == 'greek'){
            $this->pizza = new NYStyleGreekPizza;
        } elseif($type == 'pepperoni'){
            $this->pizza = new NYStylePepperoniPizza;
        }
        return $this->pizza;
    }
}
$pizzaStore = new NYPizzaStore();
$pizza = $pizzaStore->orderPizza('cheese');
echo $pizza->message;
echo "\r\n";
//芝加哥的的一家分店
class ChicagoStyleCheesePizza extends Pizza{public function __construct(){$this->message = __CLASS__;}}
class ChicagoStyleGreekPizza extends Pizza{public function __construct(){$this->message = __CLASS__;}}
class ChicagoStylePepperoniPizza extends Pizza{public function __construct(){$this->message = __CLASS__;}}
class ChicagoStore extends PizzaStore{
    public function createPizza($type){
        if($type == 'cheese'){
            $this->pizza = new ChicagoStyleCheesePizza;
        } elseif($type == 'greek'){
            $this->pizza = new ChicagoStyleGreekPizza;
        } elseif($type == 'pepperoni'){
            $this->pizza = new ChicagoStylePepperoniPizza;
        }
        return $this->pizza;
    }
}
$pizzaStore = new ChicagoStore();
$pizza = $pizzaStore->orderPizza('greek');
echo $pizza->message;
//工厂方法用来处理对象的创建，并将这样的行为封装在子类中，这样客户程序中关于超类的代码就和子类对象创建的代码解耦了！要依赖抽象，不要依赖具体类