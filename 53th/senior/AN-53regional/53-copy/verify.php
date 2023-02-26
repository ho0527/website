<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <?php
            include("link.php");
            if(!isset($_SESSION["data"])){ header("location:index.php"); }
        ?>
        <div class="verifytable">
            <form>
                <table class="verify">
                    <tr>
                        <td class="verifytd"></td>
                        <td class="verifytd"></td>
                    </tr>
                    <tr>
                        <td class="verifytd"></td>
                        <td class="verifytd"></td>
                    </tr>
                </table>
                <input type="submit" name="logout" value="登出">
                <input type="submit" onclick="location.reload()" value="重設">
                <input type="button" onclick="check()" value="確定">
            </form>
        </div>
        <script src="verify.js"></script>
    </body>
</html>