<?php
ob_start();
?>

<h1>Login</h1>

<div class="form_p">
    <form action="/login/" method="post" enctype="multipart/form-data">
        <div>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username" value="<?= old("username"); ?>">
            <label for="username" class="error">
                <?= error("username"); ?>
            </label>
        </div>
        <div>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password" value="<?= old("password"); ?>">
            <label for="password" class="error">
                <?= error("password"); ?>
            </label>
        </div>
        <button type="submit" class="button">Login</button>
        <label for="username" class="error">
            <?= error("message"); ?>
        </label>
    </form>
</div>

<?php
$content = ob_get_clean();
require VIEWS . 'layout.php';
?>