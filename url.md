<p>
EndCMS只使用了一个参数来传递路由信息。"p"。 例如:  admin.php?p=item 。输入这个地址，程序就会执行end_admin/controller/item.php文件，然后这个文件把输出信息写到$view_data数组。这个数组随后会被传递给模板引擎。模板引擎会自动去解析end_admin/view/item.html文件，并把刚刚收到的$view_data数组应用到item.html文件。<br>
</p>
<p>
是的，这就是EndCMS的MVC路由。很简单吧。<br>
</p>
## URL Rewrite ##
<p>
很多时候，像index.php?p=news&news_id=123这种URL看起来很不舒服。没关系，我们可以通过URLRewrite来实现干净的URL。例如在.htaccess文件中写入<br>
<pre><code>RewriteEngine On<br>
RewriteCond $1 !^(images|js|css|public|robots\.txt)$<br>
RewriteCond $1 !^(end\_)<br>
RewriteCond $4 !(\.php|\.jpg|\.gif|\.png|\.html|\.htm|\.js)$<br>
RewriteRule ^([^\/]+)\/?([^\/]+)?\/?([^\/]+)?\/?(.+)?$ index.php?p=$1&amp;argv[]=$2&amp;argv[]=$3&amp;argv[]=$4&amp;%{QUERY_STRING} [L]<br>
</code></pre>
<p>这样，通过访问 yoursite.com/news/123  就相当于访问了 <code>index.php?p=news&amp;argv[]=123</code>，在news.php里面判断<code>$news_id = intval($_GET['argv'][0]); </code>就可以了。</p>

<h2>Hook</h2>
<p>如果你不想用rewrite的方式。那也有很好的办法。   我们可以使用钩子（hook）机制来自己生成p参数。</p>
<p>比如我们要实现:  <code> yoursite.com/?news/123 </code>这种URL。可以在  end_www/helper/hooks.php里写入:<br>
<pre><code>function end_on_begin()<br>
{<br>
	$arr = explode('/',array_shift(explode('&amp;',$_SERVER['QUERY_STRING'])));<br>
	if ($arr[0] &amp;&amp; !$_GET['p']) $_GET['p'] = $arr[0];<br>
	if ($arr[1] &amp;&amp; !$_GET['id']) $_GET['id'] = $arr[1];<br>
}<br>
</code></pre>
<p>这样，yoursite.com/?news/123这样的url就相当于 yoursite.com/index.php?p=news&id=123 了。</p>
<p>注: end_on_begin这个函数就是一个钩子（hook）。如果用户定义了这个函数，那么系统在开始绝大部分操作之前就会执行这个函数里面的内容。关于钩子函数后面会有详细的说明。</p>