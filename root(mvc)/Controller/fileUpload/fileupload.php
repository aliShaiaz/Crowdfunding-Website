<?php

function fileUpload()
{ ?>
    <html>

    <head>
        <title>File Upload</title>
    </head>

    <body>
        <form action="redirect.php?fileUpload" method="post" enctype="multipart/form-data">
            Upload: <br>
            <input type="file" name="myfile" /><br>
            <input type="submit" name="Submit" value="Submit" />
        </form>
    </body>

    </html>

<?php }
