<?php
/**
 * @desc 观察者模式
 * PHP有自带的观察者模式接口SplSubject SplObserver 接口 我们就实现一个类 
 */
/**
 * 观察者类
 */
class OneObserver implements SplObserver{
    public function update(SplSubject $subject){
        echo __CLASS__.'-'.$subject->getName();
    }
}
class TwoObserver implements SplObserver{
    public function update(SplSubject $subject){
        echo __CLASS__.'-'.$subject->getName();
    }
}
class ThrObserver implements SplObserver{
    public function update(SplSubject $subject){
        echo __CLASS__.'-'.$subject->getName();
    }
}
class BaseSubject implements SplSubject{
    private $_observers;
    private $_name;
    public function __construct($name){
        $this->_observers = new SplObjectStorage();
        $this->_name = $name;
    }
    public function attach(SplObserver $observer){
        $this->_observers->attach($observer);
    }
    public function detach(SplObserver $observer){
        $this->_observers->detach($observer);
        
    }
    public function notify(){
        foreach ($this->_observers as $observer){
            $observer->update($this);
        }
    }
    public function getName(){
        return $this->_name;
    }
}
$observerOne = new OneObserver();
$observerTwo = new TwoObserver();
$observerThr = new ThrObserver();

$subject = new BaseSubject('good');
$subject->attach($observerOne);
$subject->attach($observerTwo);
$subject->attach($observerThr);
$subject->notify();

$subject->detach($observerOne);
$subject->notify();





