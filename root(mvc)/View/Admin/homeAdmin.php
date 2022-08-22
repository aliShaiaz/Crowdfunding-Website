<?php

function VIEW_homeAdmin()
{
?>
    <html>

    <head>
        <title>Admin Homepage</title>
        <link rel="stylesheet" href="Asset/CSS/menuDD.css">
        <link rel="stylesheet" href="Asset/CSS/style.css">
        <link rel="stylesheet" href="Asset/CSS/homeAdmin.css">
        <script>
            let user = {};
            requestUserInfo();

            function runFunc() {
                document
                    .getElementById("profilePhoto")
                    .setAttribute(
                        "src",
                        "Asset/Storage/profilePhotos/" + user["username"] + ".png"
                    );
                document.getElementById("welcomeSpan").innerHTML = user["firstName"] + ' ' + user["lastName"];
            }

            function requestUserInfo() {
                // alert(88);
                let xhttp = new XMLHttpRequest();
                xhttp.open("POST", "redirect.php?getProfileInfo", true);
                xhttp.setRequestHeader(
                    "Content-type",
                    "application/x-www-form-urlencoded"
                );
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        user = JSON.parse(this.responseText);
                        if (user != false) {
                            runFunc();
                        } else {
                            // alert('failed');
                            return false;
                        }
                    }
                };
            }

            function menuDD() {
                let menuToggle = document.querySelector('.menuToggle');
                let menuDD = document.querySelector('.menuDD');

                menuToggle.onclick = function() {
                    menuDD.classList.toggle('active');
                }
            }
        </script>
    </head>

    <body>
        <div class="box">

            <h1>
                This is your Homepage <br />
            </h1>

            <button class="btn" onclick="location.href='redirect.php?viewRequests'">View Requests</button>


            <!-- <input type="button" onclick="location.href='manageAdmin.php'" value="Manage Admin"> -->

        </div>

        <div class="menuDD">
            <div class="userBx">
                <div class="imgBx">
                    <img id="profilePhoto" src="" />
                </div>
                <p class="text">
                    <!-- shaiaz ali -->
                    <span class="welcomeSpan" id="welcomeSpan"></span>
                </p>
            </div>
            <div class="menuToggle"></div>
            <ul class="menu">
                <li>
                    <img src="Asset/Icons/index.png" alt="" class="icon">
                    <!-- <a href="redirect.php?index">Index</a> -->
                    <a href="redirect.php?index">Index</a>
                </li>
                <li>
                    <img src="Asset/Icons/usersList.png" alt="" class="icon">
                    <a href="redirect.php?listUsers">List Users</a>
                </li>
                <li>
                    <img src="Asset/Icons/edit.png" alt="" class="icon">
                    <a href="redirect.php?profileSettings">Settings</a>
                </li>
                <li>
                    <img src="Asset/Icons/logout.png" alt="" class="icon">
                    <a href="redirect.php?logout">Logout</a>
                </li>
            </ul>
        </div>

        <script>
            // window.onload = function() {
            //     let username =;
            //     alert(username);
            //     // document.getElementById('profilePhoto').setAttribute("src", "Asset/Storage/profilePhotos/" +  //echo $_SESSION['userInfo']['username']
            //

            window.onload = function() {
                document.querySelector('body').classList.toggle('visible');
            };
            menuDD();
        </script>
    </body>

    </html>

<?php
}
