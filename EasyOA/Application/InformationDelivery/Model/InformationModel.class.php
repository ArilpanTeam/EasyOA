<?php  
namespace InformationDelivery\Model;
use Think\Model\RelationModel;
class InformationDeliveryModel extends RelationModel{
    //数据库添加信息
    public function addInformation($data){
    	$result = $this->add($data);
    	if ($result) {
    		return array('',1,'添加成功!');
    	}else{
            return array($this->getError(),0,'添加失败!');
        }
    }
    //获取信息总条数
    public function getCountInformation(){
        $result = $this->count();
        return $result;
    }
    //获取所有信息列表，默认按照时间排序，默认使用TP内置分页
    public function getAllInformation(){
        $result = $this->order('add_time desc')->select();
        return $result;
    }
    //根据筛选条件获取信息列表
    public function getInformation($where,$order,$type){
        $result = $this->where($where)->order($order,$type)->select();
        return $result;
    }
    //删除信息
    public function delInfromation($id){
        $result = $this->delete($id);
        if ($result) {
            return array('',1,'删除成功!');
        }else{
            return array($this->getError(),0,'删除失败!');
        }
    }
    public function updateInformation($where,$data){
        $result = $this->where($where)->save($data);
        if ($result) {
            return array('',1,'更新成功!');
        }else{
            return array($this->getError(),0,'更新失败!');
        }
    }
}