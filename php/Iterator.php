<?php
/**
 * 在实际PHP编码中，我们经常遇到各种变量代码，循环流程foreach出现在好多PHP编码中，而如果使用迭代器模式，可以对不同的数据集合进行封装，外用调用者只需使用迭代器提供的接口即可。
迭代器模式为不同的容器对象规范了统一的接口，支持多态迭代，对容器对象提供多种遍历，且不会暴露容器对象的具体实现细节，从而达到高扩展，强规范和安全的目的。
缺点是：这样提高了系统的复杂性和前端php程序员编码难度。
 */

class ConcreteIterator implements Iterator{
    private $_position = 0;
    private $_arr;
    
    public function __construct(array $arr){
        $this->_arr = $arr;
    }
    //当前游标对应的键值
    public function current(){
        return $this->_arr[$this->_position].' Add Coding Everything You Need';
    }
    //下一个游标
    public function next(){
        ++$this->_position;
    }
    //当前游标
    public function key(){
        return $this->_position;
    }
    //当前游标是否合理
    public function valid(){
        return isset($this->_arr[$this->_position]);
    }
    //将游标重置，放在起始位置
    public function rewind(){
        $this->_position = 0;
    }

}
$data = array(
    'http://www.baidu.com',
    'http://www.qq.com',
    'http://www.google.com',
    'http://www.bangdanzhijia.com',
);

$caseIterator = new ConcreteIterator($data);
foreach ($caseIterator as $row){
    $caseIterator->next();
    echo $row;
}