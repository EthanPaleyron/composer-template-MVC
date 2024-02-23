<?php
ob_start();
?>

<h1>Sign in</h1>

<div class="form_p">
    <form action="/register/" method="post" enctype="multipart/form-data">
        <label for="username">Your username :</label>
        <input type="text" name="username" id="username">
        <label for="username" class="error">
            <?= error("username"); ?>
        </label>
        <label for="password">Your password :</label>
        <input type="password" name="password" id="password">
        <label for="password" class="error">
            <?= error("password"); ?>
        </label>
        <label for="passwordConfirm">Password confirm :</label>
        <input id="passwordConfirm" type="password" name="passwordConfirm"
            value="<?php echo old("passwordConfirm"); ?>">
        <button type="submit" class="button">Sign in</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>