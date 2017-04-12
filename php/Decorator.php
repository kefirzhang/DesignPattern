<?php
abstract class Filter{
    public function __construct(){}
    public abstract function filterMsg($msg);
}
//基础的过滤对象
class CsrfFilter extends Filter{
    public function filterMsg($msg){
        return 'CSRF攻击已经过滤'.$msg;
    }
}
//声明一个装饰器 基类用来提供服务
class FilterDecorator extends Filter{
    private $_handle;
    public function __construct($handle){
        $this->_handle = $handle;
    }
    public function filterMsg($msg){
        return $this->_handle->filterMsg($msg);
    }
}
class DirtyWordsFilter extends FilterDecorator{
    public function __construct($handle){
        parent::__construct($handle);
    }
    public function filterMsg($msg){
        $msg = '脏字过滤已处理'.$msg;
        return parent::filterMsg($msg);
    }
}

class HtmlFilter extends FilterDecorator{
    public function __construct($handle){
        parent::__construct($handle);
    }
    public function filterMsg($msg){
        $msg = 'Html标签已经处理过'.$msg;
        return parent::filterMsg($msg);
    }
}
$filter = new HtmlFilter(new DirtyWordsFilter(new CsrfFilter()));
echo $filter->filterMsg('待处理的原始数据');