<?php
ob_start();
?>

<section class="error_404">
    <h1>Error 404</h1>
    <p>Search page does not exist ! <a href="/">Leave this page !</a></p>
</section>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>