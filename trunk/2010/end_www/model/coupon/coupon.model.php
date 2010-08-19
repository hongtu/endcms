<?php
/**
 * coupon model class
 *
 * @author Liu Longbill
 */

class MODEL_COUPON extends MODEL
{
	function MODEL_COUPON()
	{
		$this->table = END_MYSQL_PREFIX.'coupon';
		$this->id = 'coupon_id';
		$this->order_id = 'coupon_id';
	}
	
	
	function get_price($coupon,$subtotal=0,$shipping=0,$total=0)
	{
		$c = $this->get_one(array('name'=>$coupon));
		if (
			$c['status'] != -1 
			&& $c['from_time'] <= time()
			&& $c['to_time'] >= time()
			&& $c['count'] >= 0
		)
		{
			$price = str_replace(
				array('{shipping}','{subtotal}','{total}'),
				array($shipping.'',$subtotal.'',$total.''),
				$c['price']);
			try
			{
				eval('$price = '.$price.';');
			}
			catch(Exception $e)
			{
				return 0;
			}
			if ($price<=0) $price = 0;
			$price = round($price*100)/100;
			return $price;
		}
		else
		{
			return 0;
		}
	}
	
	function use_coupon($coupon)
	{
		$c = $this->get_one(array('name'=>$coupon));
		if ($c)
			$this->update($c[$this->id],array('count'=>$c['count']-1));
	}
	
}