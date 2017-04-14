<?php
/**
 * Bridge桥接模式
 * 抽象化就是 存在于多个实体中的共同的概念性联系就是抽象化，作为一个过程，抽象化就是忽略一些细节，把不同的实体当作同样的实体对待
 * 实现化
 * 抽象化给出的具体实现，就是实现化。
 * 脱耦
 * 所谓耦合，就是两个实体的行为的某种强关联。而将它们的强关联去掉，就是耦合的解脱，或称脱耦。在这里，脱耦是指将抽象化和实现化之间的耦合解脱开，或者说是将它们之间的强关联改换成弱关联。
 * 将两个角色之间的继承关系改为聚合关系，就是将它们之间的强关联改换成为弱关联。因此，桥梁模式中的所谓脱耦，就是指在一个软件系统的抽象化和实现化之间使用组合/聚合关系而不是继承关系，
 * 从而使两者可以相对独立地变化。这就是桥梁模式的用意。！
 * 
 * 抽象化(Abstraction)角色：抽象化给出的定义，并保存一个对实现化对象的引用。
 * 修正抽象化(Refined Abstraction)角色：扩展抽象化角色，改变和修正父类对抽象化的定义。
 * 实现化(Implementor)角色：这个角色给出实现化角色的接口，但不给出具体的实现。必须指出的是，这个接口不一定和抽象化角色的接口定义相同，实际上，这两个接口可以非常不一样。实现化角色应当只给出底层操作，而抽象化角色应当只给出基于底层操作的更高一层的操作。
 * 具体实现化(Concrete Implementor)角色：这个角色给出实现化角色接口的具体实现。
 */
abstract class Implementor{
    abstract public function operation();
}
class ConcreteImplementorA extends Implementor{
    public function operation(){
        echo __CLASS__.'-'.__FUNCTION__;
    }
}
class ConcreteImplementorB extends Implementor{
    public function operation(){
        echo __CLASS__.'-'.__FUNCTION__;
    }
}

class Abstraction{
    private $_implementor;
    public function setImplementor($implementor){
        $this->_implementor = $implementor;
    }
    public function operation(){
        $this->_implementor->operation();
    }
}
class RefinedAbstraction extends Abstraction {
    
}
class ExampleAbstraction extends Abstraction{
    
}

$refinedAbstraction = new RefinedAbstraction();
$refinedAbstraction->setImplementor(new ConcreteImplementorA());
$refinedAbstraction->operation();


$refinedAbstraction->setImplementor(new ConcreteImplementorB());
$refinedAbstraction->operation();



$exampleAbstraction = new ExampleAbstraction();
$exampleAbstraction->setImplementor(new ConcreteImplementorB());
$exampleAbstraction->operation();
