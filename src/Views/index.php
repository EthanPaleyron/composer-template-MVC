<?php
ob_start();
?>

<h1 class="title_page">Hello World</h1>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>