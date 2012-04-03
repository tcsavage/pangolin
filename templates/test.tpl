<html>
<head><title>Testing</title></head>
<body>
<h1>Test Page</h1>
<ul>
{foreach $people as $p}
<li>{$p->name}</li>
{/foreach}
</ul>
</body>
</html>