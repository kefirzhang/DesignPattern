<?php 
//继续上面的披萨店的例子 假如在Pizza类中的关键材料 面粉 ,芝士等材料  要统一不能让店家自己随意处理
abstract class Pizza{
    public $message;
    public abstract function prepare();
    public abstract function bake();
    public abstract function cut();
    public abstract function box();
}
class NYStyleCheesePizza extends Pizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
class NYStyleGreekPizza extends Pizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
class NYStylePepperoniPizza extends Pizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
class ChicagoStyleCheesePizza extends Pizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
class ChicagoStyleGreekPizza extends Pizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
class ChicagoStylePepperoniPizza extends Pizza{
    public $message;
    public function __construct(){
        $this->message = __CLASS__;
    }
    public function prepare(){$this->message .= __FUNCTION__;} //准备
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
abstract class PizzaStore{
    public $pizza;
    public function orderPizza($type){
        $this->pizza = $this->createPizza($type);
        if(!($this->pizza instanceof Pizza)){
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