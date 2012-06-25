<html>
<head><title>Testing</title></head>
<body>
<h1>Test Page</h1>
<ul>
{foreach $posts as $p}
<li>{$p->user->name}: {$p->content}</li>
{/foreach}
</ul>
</body>
</html>