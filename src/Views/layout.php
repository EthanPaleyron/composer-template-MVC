<!DOCTYPE html>
<html lang="en">

<head>
    <title>Name Project</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" type="image/x-icon" href="public/"> -->
    <!-- <title>Name project</title> -->
    <!-- <meta name="description" content="Project description"> -->
    <!-- <meta name="keywords" content="Keywords relevant to your project"> -->
    <!-- <meta name="author" content="Your name or the name of your organization"> -->
    <link rel="stylesheet" href="/scss/style.css">
    <script src="https://kit.fontawesome.com/2621df78fc.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav>
            <?php if (!isset($_SESSION["user"]["username"])) { ?>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/register/">Sign in</a></li>
                    <li><a href="/login/">Login</a></li>
                </ul>
            <?php } else { ?>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/logout/">Logout</a></li>
                </ul>
                <strong class="user">
                    <?= $_SESSION["user"]["username"]; ?>
                </strong>
            <?php } ?>
        </nav>
    </header>
    <main>
        <?php echo $content; ?>
    </main>
    <script type="module" src="/js/main.js"></script>
</body>

</html>

<?php
unset($_SESSION['error']);
unset($_SESSION['old']);
?>