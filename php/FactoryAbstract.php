<?php 
//定义对应的具体的材料类 这个可以再封装 什么的  这里就只简单的做举例说明
class ThinCrusDough{public $name = "--ThinCrusDough--";} 
class MarinaraSauce{public $name = "--MarinaraSauce--";}

//继续上面的披萨店的例子 假如在Pizza类中的关键材料 面粉 ,芝士等材料  要统一不能让店家自己随意处理  材料也必须有统一的标准
abstract class PizzaIngredientFactory{ //抽象工厂类，用于产品族的统一定义
    abstract function createDough(); //每一个原材料必须有实现的接口
    abstract function createSauce();
    //abstract function createVeggies(){} 太多了   一两个例子就行
    //abstract function createCheese(){}
    //abstract function createPepperoni(){}
    //abstract function createClam(){}
}

class NYPizzaIngredientFactory extends PizzaIngredientFactory{
    public function createDough(){
        return new ThinCrusDough;
    } //每一个原材料必须有实现的接口
    public function createSauce(){
        return new MarinaraSauce;
    }
}

//定义一个Pizza的抽象类
abstract class Pizza{
    public $message;
    public $dough;//面团
    public $sauce; //酱汁
    //两个材料做演示就行  
    //public $veggies; //蔬果
    //public $cheese; //奶酪
    //public $pepperoni; //香肠
    //public $clam; //海鲜 生蛤
    public abstract function prepare(); //准备 所有的素材必须准备好   这里的素材采用抽象工厂方法
    public function bake(){$this->message .= __FUNCTION__;} //烘烤
    public function cut(){$this->message .= __FUNCTION__;} //切片
    public function box(){$this->message .= __FUNCTION__;}// 打包
}
//pizza店的抽象类
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
class NYStyleCheesePizza extends Pizza{
    public $ingredientFactory;
    public function __construct(PizzaIngredientFactory $factory){
        $this->message = __CLASS__;
        $this->ingredientFactory = $factory;
    }
    public function prepare(){
        $this->dough = $this->ingredientFactory->createDough();//面团
        $this->sauce = $this->ingredientFactory->createSauce(); //酱汁
        $this->message .= $this->dough->name; 
        $this->message .= $this->sauce->name;
    }
}
class NYStyleGreekPizza extends Pizza{
    public $ingredientFactory;
    public function __construct(PizzaIngredientFactory $factory){
        $this->message = __CLASS__;
        $this->ingredientFactory = $factory;
    }
    public function prepare(){
        $this->dough = $this->ingredientFactory->createDough();//面团
        $this->sauce = $this->ingredientFactory->createSauce(); //酱汁
        $this->message .= $this->dough->name;
        $this->message .= $this->sauce->name;
    }
}
class NYStylePepperoniPizza extends Pizza{
    public $ingredientFactory;
    public function __construct(PizzaIngredientFactory $factory){
        $this->message = __CLASS__;
        $this->ingredientFactory = $factory;
    }
    public function prepare(){
        $this->dough = $this->ingredientFactory->createDough();//面团
        $this->sauce = $this->ingredientFactory->createSauce(); //酱汁
        $this->message .= $this->dough->name;
        $this->message .= $this->sauce->name;
    }
}
class NYPizzaStore extends PizzaStore{
    public $ingredientFactory;
    public function __construct(){
        $this->ingredientFactory = new NYPizzaIngredientFactory();
    }
    public function createPizza($type){
        if($type == 'cheese'){
            $this->pizza = new NYStyleCheesePizza($this->ingredientFactory);
        } elseif($type == 'greek'){
            $this->pizza = new NYStyleGreekPizza($this->ingredientFactory);
        } elseif($type == 'pepperoni'){
            $this->pizza = new NYStylePepperoniPizza($this->ingredientFactory);
        }
        return $this->pizza;
    }
}
$pizzaStore = new NYPizzaStore();
$pizza = $pizzaStore->orderPizza('cheese');
echo $pizza->message;
//抽象工厂模式在上一部分工厂的基础上把原料家族的创建解耦出来， 其实就是各个属性（产品，原料 ）的具体实现 封装起来 所有的属性依赖的都是一个接口，里面可以在不同的区域，不同的操作系统，等不同场景下面实现不同的功能