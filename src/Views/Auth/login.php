<?php
ob_start();
if (!isset($_SESSION["user"]["username"])) {
    header("/");
}
?>

<h1>Login</h1>

<div class="form_p">
    <form action="/login/" method="post" enctype="multipart/form-data">
        <div>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" value="<?= old("username"); ?>">
        </div>
        <span class="error">
            <?= error("username"); ?>
        </span>
        <div>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" value="<?= old("username"); ?>">
        </div>
        <span class="error">
            <?= error("password"); ?>
        </span>
        <button type="submit">Login</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>