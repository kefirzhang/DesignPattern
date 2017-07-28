<?php
/**
 *状态模式-事物的状态
      定义：状态模式允许对象在内部状态改变时改变它的行为，对象看起来好像修改了它的类。
  就按照糖果机的例子，自动售卖机的例子    分别有 正常销售，售罄，没有投入硬币，投入硬币 四个状态
 */
interface State{
    public function insertQuater(); //塞入硬币
    public function ejectQuater(); //弹出硬币
    public function turnCrank();//拉动曲柄
    public function dispense(); //出货
}
/**
 * 
 *@desc　没有投入硬币的状态
 */
class NoQuarterState implements State{
    public $gumballMachine;
    public function __construct(GumballMachine &$gumballMachine){
        $this->gumballMachine = $gumballMachine;
    }
    public function insertQuater(){
        echo "You insert a quarter \r\n";
        $this->gumballMachine->setState($this->gumballMachine->getHasQuarterState());
    }
    public function ejectQuater(){
        echo "You haven't inserted a quarter \r\n";
    }
    public function turnCrank(){
        echo "You turned,but there is no quarter \r\n";
    }
    public function dispense(){
        echo "You need to pay first \r\n";
    }
}
/**
 * @desc 已经投入硬币了 
 */
class HasQuarterState implements State{
    public $gumballMachine;

    public function __construct(GumballMachine &$gumballMachine){
        $this->gumballMachine = $gumballMachine;
    }
    public function insertQuater(){
        echo "You cant't insert another quarter! \r\n";
    }
    public function ejectQuater(){
        echo "Quarter returned \r\n";
        $this->gumballMachine->setState($this->gumballMachine->getNoQuarterState());
    }
    public function turnCrank(){
        echo "You turned \r\n";
        if( (rand(1,2) == 1) && ($this->gumballMachine->getCount() > 1)  ){ //如果是幸运玩家  并且有足够的球  这里是两颗 就进入幸运状态   否则就正常售卖 这个随便概率了
            $this->gumballMachine->setState($this->gumballMachine->getWinnerState());
        } else {
            $this->gumballMachine->setState($this->gumballMachine->getSoldState());
        }
    }
    public function dispense(){
        echo "No gumball dispensed \r\n";
    }
}
/**
 * @desc 售卖中
 */
class SoldState implements State{
    public $gumballMachine;
    public function __construct(GumballMachine &$gumballMachine){
        $this->gumballMachine = $gumballMachine;
    }
    public function insertQuater(){
        echo "Please wait,we're already giving you a gumball \r\n";
    }
    public function ejectQuater(){
        echo "Sorry ,you already turned the crank \r\n";
    }
    public function turnCrank(){
        echo " Turning twice doesn't get you another gumball !\r\n";
    }
    public function dispense(){ //出货
        $this->gumballMachine->releaseBall();
        if($this->gumballMachine->getCount() > 0){ //如果还有存货
            $this->gumballMachine->setState($this->gumballMachine->getNoQuarterState());
        } else { //如果没有存货了
            $this->gumballMachine->setState($this->gumballMachine->getSoldOutState());
        }
        
    }
}
/**
 * @desc 售罄状况 
 */
class SoldOutState implements State{
    public $gumballMachine;
    public function __construct(GumballMachine &$gumballMachine){
        $this->gumballMachine = $gumballMachine;
    }
    public function insertQuater(){
        echo "You can't insert a quarter,the mechine is sold out!\r\n";
    }
    public function ejectQuater(){
        echo "You haven't inserted a quarter \r\n";
    }
    public function turnCrank(){
        echo "You turned,but there is no quarter \r\n";
    }
    public function dispense(){
        echo "No gumball dispensed \r\n";
    }
}
/**
 * @desc 特殊情况  有概率发放两个球
 */
class WinnerState implements State{
    public $gumballMachine;
    public function __construct(GumballMachine &$gumballMachine){
        $this->gumballMachine = $gumballMachine;
    }
    public function insertQuater(){
        echo "Please wait,we're already giving you a gumball \r\n";
    }
    public function ejectQuater(){
        echo "Sorry ,you already turned the crank \r\n";
    }
    public function turnCrank(){
        echo " Turning twice doesn't get you another gumball !\r\n";
    }
    public function dispense(){ //出货
        echo " You're a winner!You get two gumballs for your quarter!\r\n";
        $this->gumballMachine->releaseBall(); //出球
        
        if($this->gumballMachine->getCount() > 0){ //如果还有存货
            $this->gumballMachine->releaseBall(); //再出出球
            if($this->gumballMachine->getCount() > 0){ //如果还有存货
                $this->gumballMachine->setState($this->gumballMachine->getNoQuarterState());
            } else { //如果没有存货了
                $this->gumballMachine->setState($this->gumballMachine->getSoldOutState());
            }
        } else { //如果没有存货了
            $this->gumballMachine->setState($this->gumballMachine->getSoldOutState());
        }
        
    }
}
/**
 * 
 * @desc 糖果机
 *
 */
class GumballMachine{
    
    public $soldOutState; //售罄状态
    public $noQuarterState; //未投币状态
    public $hasQuarterState; //已经投币状态
    public $soldState; //售卖中状态
    public $winnerState;// 中奖状态
    public $state; //保存各个状态的状态值
    public $count = 0; //当前数量
    
    public function __construct($count){
        $this->soldOutState = new SoldOutState($this);
        $this->noQuarterState = new NoQuarterState($this);
        $this->hasQuarterState = new HasQuarterState($this);
        $this->soldState = new SoldState($this);
        $this->winnerState = new WinnerState($this);
        $this->count = $count;
        if($count > 0){
            $this->state = $this->noQuarterState;
        }
    }
    public function insertQuater(){
    //塞入硬币
        $this->state->insertQuater();
    } 
    public function ejectQuater(){
        $this->state->ejectQuater();
    }
    public function turnCrank(){
        $this->state->turnCrank();
        $this->state->dispense();
    }
    public function setState($state){
        $this->state = $state;
    }
    public function releaseBall(){ //出库操作
        echo "A gumball commes rolling out the slot ...\r\n";
        if($this->count != 0){
            $this->count = $this->count - 1;
        }
    }
    public function getSoldOutState(){
        return $this->soldOutState;
    }
    public function getNoQuarterState(){
        return $this->noQuarterState;
    }
    public function getHasQuarterState(){
        return $this->hasQuarterState;
    }
    public function getSoldState(){
        return $this->soldState;
    }
    public function getWinnerState(){
        return $this->winnerState;
    }
    public function getCount(){
        return $this->count;
    }
}
//实例一个存货100的糖果机器 进行1000次随机操作
$gumballMachine = new GumballMachine(10);
$i=100;
while($i>0){
    $action = rand(1,3);
    if($action == 1){
        $gumballMachine->insertQuater(); //投硬币
    }elseif($action == 2){
        $gumballMachine->ejectQuater(); //退硬币
    }elseif($action == 3){
        $gumballMachine->turnCrank(); //拉杆
    }
    $i--;
}