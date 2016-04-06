### EndCMS的目录结构如下： ###
end\_admin [目录]  后台模块<br>
end_system [目录]  核心模块<br>
end_www [目录]  网站前台模块<br>
admin.php [文件]  后台入口文件<br>
index.php [文件]  网站前台入口文件<br>

<h3>end_admin：</h3>
这个模块包含了EndCMS后台的所有文件。所以如果你需要使用EndCMS后台来管理网站数据，那么这个目录是必须的。<br>
<br>
<h3>end_system：</h3>
此目录是系统目录，不能删除。<br>
此目录下的config.php文件需要用户配置（如果没有，那么请复制config.sample.php为config.php）。<br>
<br>
<h3>end_www：</h3>
这不是一个系统目录， 用户可以随意改名字，但必须以end_开头。 <br>
这里之所以用end_www，是因为index.php这个入口文件配置了 define('END_MODULE','www');<br>
同理，用户可以自己新建多个模块，比如 end_bbs ，然后对应一个 bbs.php（需要配置define('END_MODULE','bbs'); ）就可以了。<br>
各个模块之间的代码一般来说没有关联。当然，如果需要，可以自由引用。