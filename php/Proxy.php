<?php
interface Bank{
    public function loan($ID,$num); //贷款
    public function deposit($ID,$num); //存款
}

class ICBCBank implements Bank{
    public function loan($ID,$num){
        return "{$ID} Loan {$num} \r\n";
    }
    public function deposit($ID,$num){
        return "{$ID} Deposit {$num} \r\n";
    }
}

class ProxyBank implements Bank{
    public $proxyBank;
    public $name;
    public function __construct($name){
        $this->name = $name;
        $this->proxyBank = new ICBCBank();
    }
    public function loan($ID,$num){
        $back = $this->proxyBank->loan($ID, $num);
        echo $this->name.'---'.$back;
    }
    public function deposit($ID,$num){
        $back = $this->proxyBank->deposit($ID, $num);
        echo $this->name.'---'.$back;
    }
}

$wangbatuoziBank = new ProxyBank('WangBaTuoZiBank');
$wangbatuoziBank->loan(123456, 10000);
$wangbatuoziBank->deposit(243456, 6000000);