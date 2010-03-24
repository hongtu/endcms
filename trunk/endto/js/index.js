var objArrowIcon = document.getElementById('credit_pop_arrow');
var objCurrDesc = document.getElementById('credit_desc_content');
var objIcons = document.getElementById('credit-curr-icons');
var arrIcons = objIcons.getElementsByTagName('span');
document.getElementById('safe_icon').onmouseover = function(){
	this.style.cssText = 'background:url(images//bg_credit_v3.gif) no-repeat -12px 0px;margin-left:12px;';
	objArrowIcon.style.left = '145px';
	objCurrDesc.innerHTML = '<ul><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li></ul>';
	cancleHightLight(this.id);
};
document.getElementById('easy_icon').onmouseover = function(){
	this.style.cssText = 'background:url(images//bg_credit_v3.gif) no-repeat -99px 0px;';
	objArrowIcon.style.left = '240px';
	objCurrDesc.innerHTML = '<ul><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li></ul>';
	cancleHightLight(this.id);
};
document.getElementById('save_icon').onmouseover = function(){
	this.style.cssText = 'background:url(images//bg_credit_v3.gif) no-repeat -202px 0px;';
	objArrowIcon.style.left = '340px';
	objCurrDesc.innerHTML = '<ul><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li></ul>';
	cancleHightLight(this.id);
};
document.getElementById('simple_icon').onmouseover = function(){
	this.style.cssText = 'background:url(images//bg_credit_v3.gif) no-repeat -308px 0px;';
	objArrowIcon.style.left = '445px';
	objCurrDesc.innerHTML = '<ul><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li><li><a href="#" title="案例展示"><img src="images/case_testpic.jpg" width="113" height="99" /></a></li></ul>';
	cancleHightLight(this.id);
};
function cancleHightLight(_id){
	for(var i = 0; i < arrIcons.length; i++){
		var _currId = arrIcons[i].id;
		if(_id != _currId){
			arrIcons[i].style.cssText = 'background:url();';
		}
	}
	_id = null;
	_currId = null;
};
