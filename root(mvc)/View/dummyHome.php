<?php

function VIEW_dummyHome()
{
?>
    <html>

    <head>
        <title><?php echo $_SESSION['userInfo']['userType'] ?> Homepage</title>
    </head>

    <body>
        <h1>Welcome <?php echo $_SESSION['userInfo']['username'] ?>,</h1>
        This is the <?php echo $_SESSION['userInfo']['userType'] ?> Homepage.<br>

    </body>

    </html>
<?php
}
