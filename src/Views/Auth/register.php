<?php
ob_start();
if (!isset($_SESSION["user"]["username"])) {
    header("/");
}
?>

<h1>Sign in</h1>

<div class="form_p">
    <form action="/register/" method="post" enctype="multipart/form-data">
        <label for="username">Your username :</label>
        <input type="text" name="username" id="username">
        <span class="error">
            <?= error("username"); ?>
        </span>
        <label for="password">Your password :</label>
        <input type="password" name="password" id="password">
        <span class="error">
            <?= error("password"); ?>
        </span>
        <label for="passwordConfirm">Password confirm :</label>
        <input id="passwordConfirm" type="password" name="passwordConfirm"
            value="<?php echo old("passwordConfirm"); ?>">
        <button type="submit">Sign in</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>