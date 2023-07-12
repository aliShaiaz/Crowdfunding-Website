<?php

function VIEW_createNewPassword($username)
{
?>

    <div class="box">
        <form action="redirect.php?submitNewPassword" method="POST">

            <table>
                <input type="hidden" name="username" value="<?php echo $username ?>">
                <tr>
                    <td class="left">Enter New Password:</td>
                    <td class="right"><input class="inpTxt" type="password" name="password" id="password"></td>
                </tr>
                <tr>
                    <td class="left">Enter Password Again:</td>
                    <td class="right"><input class="inpTxt" type="password" name="cPassword" id="cPassword"></td>
                </tr>
                <tr class="submit">
                    <td colspan="2">
                        <button class="btn" type="submit">Submit Request</button>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p>Note that the password must be 8-15 char long</p>
                    </td>
                </tr>
            </table>

        </form>
    </div>

<?php
}

function VIEW_createNewPasswordBK()
{
?>
    <html>

    <head>
        <title>Create New Password</title>
        <link rel="stylesheet" href="Asset/CSS/style.css">
        <!-- <link rel="stylesheet" href="Asset/CSS/recoverID.css"> -->
    </head>

    <script>
        function submitNewPassword() {
            // . . Password Validation . . //
            pass = document.getElementById('password').value;
            cPass = document.getElementById('cPassword').value;
            if (pass == "" || cPass == "") {
                alert("Please enter your Password!");
                return false;
            } else if (cPass != pass) {
                alert("Your passwords do not match!");
                return false;
            } else if (pass.length < 8) {
                alert('"Password length must be atleast 8 characters"');
                return false;
            } else if (pass.length > 15) {
                alert("Password length must not exceed 15 characters");
                return false;
            }

            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'redirect.php?submitNewPassword', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            let user = {
                'password': pass
            }
            let json = JSON.stringify(user);
            xhttp.send('data=' + json);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText) {
                        // window.location.replace("http://www.w3schools.com");
                        alert('Success!');
                        window.location.href = "redirect.php?login";
                    } else {
                        alert('Failed!');
                    }
                    // let users = JSON.parse(this.responseText);
                    // if (users != "false") {
                    //     loadTableData(users);
                    // } else {
                    //     alert("False");
                    // }
                    alert(this.responseText);
                }
            }
        }
    </script>

    <body>
        <div class="box">
            <table>
                <tr>
                    <td class="left">Enter New Password:</td>
                    <td class="right"><input class="inpTxt" type="password" id="password"></td>
                </tr>
                <tr>
                    <td class="left">Enter Password Again:</td>
                    <td class="right"><input class="inpTxt" type="password" id="cPassword"></td>
                </tr>
                <tr class="submit">
                    <td colspan="2">
                        <button class="btn" onclick="submitNewPassword()">Submit Request</button>
                    </td>
                </tr>
            </table>

        </div>
    </body>
    <script>
        window.onload = function() {
            document.querySelector('body').classList.toggle('visible');
        };
    </script>

    </html>
<?php
}
