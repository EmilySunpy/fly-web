<!DOCTYPE html>
<html lang="en">
<head>
	<title>{$article_title} :: basdon.net aviation server</title>
	<link rel="stylesheet" href="{@unsafe $STATICPATH}/article.{@unsafe $CSS_SUFFIX}" type="text/css" />
	{@render defaulthead.tpl}
</head>
<body>
	{@render skip.tpl}
	{@render defaultheader.tpl}
	<div>
		<div id="main">
			{@if $article_pageviews == null}
				<h2>Article not found!</h2>
				<p>The article with name '{@unsafe $article_name}' was not found.</p>
			{@else}
				<h2>{@unsafe $article_title}</h2>
				{@eval $file = '../articles/gen/' . $article_name . '.html'}
				{@if !is_file($file)}
					<p style="color:red">Failed to get article contents.</p>
				{@else}
					{@eval include($file)}
				{@endif}
			{@endif}
			<p style="text-align:right">
				<small>
					{@if $article_pageviews != null}This article has been accessed {@unsafe $article_pageviews} time(s).<br/>{@endif}
					<a href="article.php">Main page</a> <a href="articlesindex.php">Articles index</a>
				</small>
			</p>
		</div>
		{@render aside.tpl}
		<div class="clear"></div>
	</div>
	{@render defaultfooter.tpl}
</body>
</html>