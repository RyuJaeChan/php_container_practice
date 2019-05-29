<?php
/**
 * Created by PhpStorm.
 * User: jcY
 * Date: 2019-04-24
 * Time: 오후 1:52
 */


?>

<html lang="ko">

    <head>
        <title>FILE UPLOAD</title>
        <meta charset="utf-8">
    </head>
    <body>
        <h1>Upload new files</h1>
        <form action="./upload" method="POST" enctype="multipart/form-data">
            <div>
                <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
                <input type="file" name="userfile" id="userfile"/>
                <input type="submit" value="Send File">
            </div>

        </form>
    </body>
</html>
