<!DOCTYPE html>
<html lang="en">
<head>
	<title>Article Index :: basdon.net aviation server</title>
	<link rel="stylesheet" href="{@unsafe $STATICPATH}/article.{@unsafe $CSS_SUFFIX}" type="text/css" />
	{@render defaulthead.tpl}
</head>
<body>
	{@render skip.tpl}
	{@render defaultheader.tpl}
	<div class="singlebody article">
		<h2 id="main">Article index</h2>
		{@foreach $cats as $cat}
			{@render article_category_box.tpl}
			<br/>
		{@endforeach}
		{@render article_bottom_right_links.tpl}
	</div>
	{@render defaultfooter.tpl}
</body>
</html>
