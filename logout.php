<!DOCTYPE html>
<html>
    <head>
        <title>Logged Out</title>
    </head>
    <?php
        session_start();
        session_unset();
        session_destroy();
        header('Location: loginPage.php');
    ?>
</html>