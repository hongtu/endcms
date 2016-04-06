# 流程图 #
![http://php.js.cn/endcms/endcms_route.gif](http://php.js.cn/endcms/endcms_route.gif)
<pre>
1.程序的入口可以是多个。 一般有两个：index.php（前台）和admin.php（后台）<br>
2.一般通过$GET的p参数来做路由分发。比如 index.php?p=news 就会执行controller/news.php<br>
3.在执行controller之前，EndCMS已经完成了很多公用的操作，比如输入的字符串安全处理，连接<br>
数据库等。<br>
4.controller是一个普通的php文件。把要输出到模板引擎的数据写到$view_data这个数组就可以了。<br>
5.EndCMS有钩子（hook）机制，可以在程序执行的任何地方插入代码片段。<br>
</pre>