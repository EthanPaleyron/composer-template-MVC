<?php
ob_start();
?>

<h1 class="title_page">Hello World</h1>
<h2>Haha</h2>
<h3>Hehe</h3>
<p>lol</p>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>