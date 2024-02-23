<?php
ob_start();
?>

<h1>Login</h1>

<div class="form_p">
    <form action="/login/" method="post" enctype="multipart/form-data">
        <div>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" value="<?= old("username"); ?>">
        </div>
        <label for="username" class="error">
            <?= error("username"); ?>
        </label>
        <div>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" value="<?= old("username"); ?>">
        </div>
        <label for="password" class="error">
            <?= error("password"); ?>
        </label>
        <button type="submit" class="button">Login</button>
    </form>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>