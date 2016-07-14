<?php
namespace CustomerManagement\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->show('CustomerManagement');
    }
}