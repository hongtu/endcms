<?php
$auctionObj = new Auction;

//ajax action
$act = $_POST['act'];
if($act) {
	
	switch($act) {
		case "invalid_bid":
			$id = $_POST['id'];
			$status = $_POST['status'];
			$auctionObj->makeBidInvalid($id, $status);
			break;
		case "invalid_user":
			$auctionId = $_POST['auction_id'];
			$userId = $_POST['user_id'];
			$auctionObj->makeBidderInvalid($auctionId, $userId);
				
			break;
	}
	echo "success";
	die;
}

//page action start here
$cate = model('category');
$categories = $cate->get_list(array('parent_id' => 6));
$view_data['cates'] = $categories;


$categoryId = $_GET['category_id'];
if($categoryId) {
	foreach($categories as $c) {
		if($c['category_id'] == $categoryId) {
			$category_name = $c['name'];
		}
	}
	$view_data['current_category'] = $category_name;
	$view_data['category_id'] = $categoryId;

	$itemId = $_GET['item_id'];
	if($itemId) { //view detal

		$auction = $auctionObj->get_one($itemId);

		if($auction) {
			$view_data['current_category'] = "<a href='admin.php?p=auction&category_id=$categoryId'>$category_name</a>";
			$view_data['current_item'] ="<a href='admin.php?p=auction&category_id=$categoryId&item_id=$itemId'>".$auction['title']."</a>";
			$view_data['auction_id'] = $itemId;
			$view_data['auctionobj'] = $auction;

			$userId = isset($_GET['user_id'])?intval($_GET['user_id']):0;
			$page = isset($_GET['page'])?intval($_GET['page']):0;
			$startIndex = $page * 50;

			if($userId && $userId > 0) {
				$userinfo = User::getUserAndInfo($userId);

				//his bid info
				$bids = $auctionObj->getBids($itemId,$userId, $startIndex, 50);

				$pager = '';
				if($page > 0) {
					$pager .= "<a href='admin.php?p=auction&category_id=$categoryId&item_id=$itemId&user_id=$userId&page=".($page - 1)."'>上一页</a>";
				}
				if(count($bids) >= 50)
				{
					$pager .= "<a href='admin.php?p=auction&category_id=$categoryId&item_id=$itemId&user_id=$userId&page=".($page + 1)."'>下一页</a>";
				}
				if($pager != '') {
					$view_data['pager'] = $pager;
				}

				$view_data['userinfo'] = $userinfo;
				$view_data['bids'] = $bids;

				foreach(Auction::$bidStatus as $st) {
					$status_bid[$st['id']] = $st['name'];
				}
				function show_bidstatus($s)
				{
					global $status_bid;
					return $status_bid[$s];
				}

				$list_tmp = template('auction_userdetail.html');
				$list_tmp->assign($view_data);
				$view_data['page_content'] = $list_tmp->result();

			} else {
					
				//所有人的叫价及中标情况
				$highBidders = $auctionObj->getHighestBidders($itemId,$auction['winner_num']);
				$view_data['winners'] = $highBidders;

				$bidders = $auctionObj->getBidderInfo($itemId,$startIndex, 50);
				$view_data['bidders'] = $bidders;

				$pager = '';
				if($page > 0) {
					$pager .= "<a href='admin.php?p=auction&category_id=$categoryId&item_id=$itemId&page=".($page - 1)."'>上一页</a>";
				}
				if(count($bidders) >= 50)
				{
					$pager .= "<a href='admin.php?p=auction&category_id=$categoryId&item_id=$itemId&page=".($page + 1)."'>下一页</a>";
				}
				if($pager != '') {
					$view_data['pager'] = $pager;
				}

				$list_tmp = template('auction_detail.html');
				$list_tmp->assign($view_data);
				$view_data['page_content'] = $list_tmp->result();
			}
		}
	}
}

if(!$itemId) { //view list
	$sql = '';
	if($categoryId)
	$sql .= " category_id = $categoryId and ";
	$sql .= ' status in (1,2)';
	
	$cond = array('where'=>$sql);
	
	if ($_GET['order'] && $_GET['asc'])
		$cond['order'] = $_GET['order'].' asc';
	else if ($_GET['order'])
		$cond['order'] = $_GET['order'].' desc';
		
	//分页
	$items = end_page(
	$auctionObj,
	$cond,
	isset($config['admin_item_page_size'])?$config['admin_item_page_size']:20 //默认20条每页
	);
	$view_data['items'] = $items;

	foreach(Auction::$auctionStatus as $st) {
		$status[$st['id']] = $st['name'];
	}



	function show_status($s)
	{
		global $status;
		return $status[$s];
	}
}




