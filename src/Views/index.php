<?php
ob_start();
?>

<h1>Hello World</h1>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>