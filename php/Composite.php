<?php
/**
 * 组合模式Composite
 * case 菜单 或者目录  每个菜单下面可能 有 叶子节点 或者子目录
 */
//节点的基类
abstract class NodeBase{
    public function add($node){}
    public function remove($node){}
    public function getName(){}
    public function display(){}
    public function getUrl(){}
}
class Menu extends NodeBase{
    private $_nodes;
    private $_name;
    public function __construct($name){
        $this->_name = $name;
        $this->_nodes = new SplObjectStorage();
    }
    public function add($node){
        $this->_nodes->attach($node);
    }
    public function remove($node){
        $this->_nodes->detach($node);
    }
    public function getName(){
        echo $this->_name."\r\n";
    }
    public function display(){
        $this->getName();
        foreach ($this->_nodes as $menu){
            $menu->display();
        }
    }
    
}
class Item extends NodeBase{
    private $_name;
    private $_url;
    public function __construct($name,$url){
        $this->_name = $name;
        $this->_url = $url;
    }
    public function display(){
        echo "Name:".$this->_name."||Url:".$this->_url."\r\n";
    }
}

class Client{
    private $_menu;
    public function __construct($menu){
        $this->_menu = $menu;
    }
    public function setMenu($menu){
        $this->_menu = $menu;
    }
    public function display(){
        $this->_menu->display();
    }
}
//声明Menu
$topMenu = new Menu('TopMenu');
$secondLevelOne = new Menu('secondLevelOne');
$secondLevelTwo = new Menu('secondLevelTwo');
$secondLevelThree = new Menu('secondLevelThree');
$thirdLevelOne = new Menu('thirdLevelOne');
//声明节点
$itemOne = new Item('首页','index.php');
$itemtwo = new Item('分类', 'category.php');
$itemThree = new Item('列表','list.php');
//节点挂到对应的menu上面去
$secondLevelOne->add($itemOne);
$secondLevelOne->add($itemtwo);
$secondLevelOne->add($itemThree);

$secondLevelTwo->add($itemOne);
$secondLevelTwo->add($itemThree);

$thirdLevelOne->add($itemOne);
$thirdLevelOne->add($itemThree);

$secondLevelOne->add($thirdLevelOne);

$topMenu->add($secondLevelOne);
$topMenu->add($secondLevelTwo);
$topMenu->add($secondLevelThree);
$client = new Client($topMenu);
$client->display();
























