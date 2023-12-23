<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>編輯問卷</title>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="/website/plugin/css/chrisplugin.css">
        <script src="error.js"></script>
        <script src="html.js"></script>
        <script src="/website/plugin/js/chrisplugin.js"></script>
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
            if(!isset($_SESSION["id"])){ header("location:form.php"); }
            $id=$_SESSION["id"];
            $row=query($db,"SELECT*FROM `question` WHERE `id`='$id'")[0];
        ?>
        <script>
            let row=<?php echo(json_encode($row)) ?>;
            let questionrow=<?php echo(json_encode($row[7])) ?>;
        </script>
        <form method="POST">
            <div id="htmlform"></div>
            <div class="macosmaindiv macossectiondiv formmaindiv" id="maindiv"></div>
        </form>
        <script src="form.js"></script>
    </body>
</html>