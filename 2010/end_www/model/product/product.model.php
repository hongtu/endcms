<?php
/**
 * product model class
 *
 * @author Liu Longbill
 */

class MODEL_PRODUCT
{
	var $db;
	var $c;
	function MODEL_PRODUCT()
	{
		$_m = new Mongo();
		$this->db = $_m->selectDB("liwuhe_products");
		$this->c = $this->db->products;
	}
	
	function get_one($id)
	{
		if (!is_array($id)) $id = array('id'=>$id);
		return $this->c->findOne($id);
	}
	
	function add($data)
	{
		$data['id'] = $this->get_insert_id('products');
		return $this->c->insert($data);
	}
	
	function get_list($data=array())
	{
		if ($data['from'])
		{
			$from = $data['from'];
			unset($data['from']);
		}
		
		if ($data['total'])
		{
			$total = $data['total'];
			unset($data['total']);
		}
		unset($data['where']);
		$c = $this->c->find($data);//->limit($total)->skip($from);
		$re = array();
		foreach($c as $_c)
		{
			$re[] = $_c;
		}
		return $re;
	}
	
	function get_insert_id($name)
	{
		$update = array('$inc'=>array("id"=>1));
		$query = array('name'=>$name);
		$command = array(
	    	'findandmodify'=>'ids', 'update'=>$update,
	    	'query'=>$query, 'new'=>true, 'upsert'=>true
		);
		$id = $this->db->command($command);
		if (!$id || !$id['value'] || !$id['value']['id'])
		{
			$this->db->ids->insert(array('name'=>$name,'id'=>1));
			return 1;
		}
		else
			return $id['value']['id'];
	}
	
}