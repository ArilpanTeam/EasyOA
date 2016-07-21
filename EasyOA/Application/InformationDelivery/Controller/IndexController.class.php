<?php
namespace InformationDelivery\Controller;
use Think\Controller;
class IndexController extends Controller {
	/**
	 * 获取所有信息输出到视图中
	 * @param author: Mr.pang
	 * @param emial: 214502706@qq.com
	 * @return json
	 */
	public function index(){
		$count = D('information')->getCountInformation();
		$Page = new \Think\Page($count,25);
		$show = $Page->show();
		$list = D('information')->getAllInformation();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
	}
	/**
	 * 添加信息
	 * @param array $data 变量
	 * @param author: Mr.pang
	 * @param emial: 214502706@qq.com
	 * @return json
	 */
    public function addInformation(){
       $data['inf_type'] = I('inf_type');
       $data['inf_title'] = I('inf_title');
       $data['inf_author'] = I('inf_author');
       $data['inf_content'] = I('inf_content');
       $data['inf_addtime'] = time();
       $data['is_read'] = 0;
       $data['is_del'] = 0;
       if (empty($data['inf_type'])) {
       		ajax_return('',0,'请选择发布文章的类型');
       }else if (empty($data['inf_title'])) {
       		ajax_return('',0,'请填写文章标题');
       }else if (empty($data['inf_author'])) {
       		ajax_return('',0,'请填写文章的作者');
       }else if(empty($data['inf_content'])){
       		ajax_return('',0,'请填写文章内容');
       }else{
       		$result = D('information')->addInformation($data);
       		$result[1]==1 ? ajax_return('',1,'添加成功!'):ajax_return($result[0],0,'添加失败!');
       }
    }
    /**
	 * 输出符合筛选条件的所有信息
	 * @param array $data 变量
	 * @param author: Mr.pang
	 * @param emial: 214502706@qq.com
	 * @return json
	 */
	public function showInformation(){
		$where = I('condition');
		$order = I('order');
		$type = I('type');
		$result = D('information')->getInformation($where,$order,$type);
		ajax_return($result,1,'');
	}
	/**
	 * 删除对应信息
	 * @param author: Mr.pang
	 * @param emial: 214502706@qq.com
	 * @return json
	 */
 	public function delInformation(){
 		$inf_id = I('inf_id');
 		$result = D('information')->delInformation($inf_id);
 		$result[1]==1 ? ajax_return('',1,'删除成功!'):ajax_return($result[0],0,'删除失败!');
 	}
 	/**
	 * 更新对应信息
	 * @param array $data 变量
	 * @param author: Mr.pang
	 * @param emial: 214502706@qq.com
	 * @return json
	 */
 	public function updateInformation(){
		$where['inf_id'] = I('inf_id');
		$data['inf_type'] = I('inf_type');
		$data['inf_title'] = I('inf_title');
		$data['inf_author'] = I('inf_author');
		$data['inf_content'] = I('inf_content');
 		$result = D('information')->updateInformation($where,$data);
 		$result[1]==1 ? ajax_return('',1,'删除成功!'):ajax_return($result[0],0,'删除失败!');
 	}   
}