<p>Controller即控制器，是执行一次请求的逻辑操作部分。大部分情况下，控制器做的操作是最重要的。</p>

## Hello World! ##
<p>
EndCMS的控制器没什么特别。就是一个普通的php文件。不需要写成类什么的。<br />
例如访问 index.php?p=test ，然后在 end_www/controller/test.php写入:<br>
<pre><code>&lt;?php<br>
echo 'Hello World!';<br>
?&gt;<br>
</code></pre>
运行之后，我们会看到Hello World!，但是后面会有提示找不到文件错误。这是由于EndCMS的controller和view之间的参数传递只自动的。默认情况下，执行了test.php这个controller之后，会把$view_data这个数组传递给 end_www/view/test.html，但是这个文件不存在，所以报错。</p>
<p>
这种情况下，可以这样：<br>
<pre><code>&lt;?php<br>
echo 'Hello World!';<br>
die;<br>
?&gt;<br>
</code></pre>
在controller完成echo语句后就用die语句停止执行。后面就不会报错了。<br>
</p>
<p>
或者我们建一个view文件：end_www/view/test.html：<br>
<pre><code>Longbill said  "{$words}".<br>
</code></pre>
然后修改 test.php:<br>
<pre><code>&lt;?php<br>
$view_data['words'] = 'Hello World!';<br>
?&gt;<br>
</code></pre>
运行之后就会显示： Longbill said "Hello World!";<br>
</p>

## 安全提示 ##
<p>Controller文件是可以直接通过输入 end_www/controller/test.php访问的！ 所以，如果你的Controller做了一些不希望普通用户做的事情，请牢记一定要加入口验证！</p>
<p>比如 后台的controller前面就都加了一句<br>
<code> END_MODULE != 'admin' &amp;&amp; die('Access Denied'); </code>
END_MODULE这个常量是 yoursite.com/admin.php这个入口文件定义的。所以如果用户不是通过访问admin.php?p=xxx页面得到的都会是Access Denied!<br>
</p>