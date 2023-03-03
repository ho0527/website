<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="verifytable">
            <form>
                <table>
                    <tr>
                        <td class="verifytd"></td>
                        <td class="verifytd"></td>
                    </tr>
                    <tr>
                        <td class="verifytd"></td>
                        <td class="verifytd"></td>
                    </tr>
                </table>
                <input type="submit" onclick="location.reload()" value="重設">
                <input type="button" onclick="check()" value="送出"><br>
                <input type="submit" name="logout" value="登出">
            </form>
    </div>
    <?php
        include("link.php")
    ?>
    <script src="verify.js"></script>
    </body>
</html>