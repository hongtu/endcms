<?php
class END_Paper extends END_Model
{
	function END_paper()
	{
		$this->table = END_MYSQL_PREFIX.'paper';
		$this->order_id = 'order_id';
		$this->id = 'paper_id';
	}
	
	function add($data=array())
	{
		return parent::add($data);
	}
	
	function delete($id)
	{
		$this_paper = $this->get_one($id);
		return parent::delete($id);
	}

	function update($id,$data = array())
	{
		$this_paper = $this->get_one($id);
		return parent::update($id,$data);
	}

	function get_list($data=array())
	{
		if (isset($data['status']))
		{
			!$data['where'] && $data['where'] = ' 1=1 ';
			$data['where'] .= " AND status IN ($data[status]) ";
			unset($data['status']);
		}
		else
			$data['status'] = '1';
		
		
		!$data['order'] && $data['order'] = "order_id DESC,time DESC";
		return parent::get_list($data);
	}
}
?>