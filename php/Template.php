<?php
/**
 * 定义：模版方法模式在一个方法中定义一个算法的骨架，而将一些步骤延迟到子类中，模版方法使得子类可以在不改变算法结构情况下，重新定义算法中的某些步骤。
 * 我们就参考书中的例子星巴克的泡茶和咖啡的过程
 * 泡茶  把水煮沸，用沸水侵泡茶叶，把茶叶倒进杯子，加柠檬
 * 泡咖啡 把水煮沸，用沸水冲泡咖啡，把咖啡倒进杯子，加糖和牛奶
 * 抽象算法 把水煮沸，冲泡，把饮料倒进杯子，加调料
 * 当然有些可能不需要加调料 那么引入一个钩子的函数 方便子类进行一定的调整
 */
abstract class CaffeineBeverage {
    public final function prepareRecipe(){
        $this->boilWater();//把水煮沸
        $this->brew();//冲泡
        $this->pourInCup();//把饮料倒进杯子
        if($this->isAddCondiments()){
            $this->addCondiments(); //加调料
        }
    }
    abstract function brew();
    abstract function addCondiments();
    function boilWater() {
        echo __FUNCTION__."\r\n";
    }
    function pourInCup(){
        echo __FUNCTION__."\r\n";
    }
    function isAddCondiments(){
        return true;
    }
}
class Tea extends CaffeineBeverage{
    public function brew(){
        echo __CLASS__.__FUNCTION__."\r\n";
    }
    public function addCondiments(){
        echo __CLASS__.__FUNCTION__."\r\n";
    }
    function isAddCondiments(){ //这个函数可以复写或者不用都可以 看具体需求例如我不需要一个加调料的茶 那么就复写 返回false
        return true;
    }
}

$tea = new Tea();
$tea->prepareRecipe(); 