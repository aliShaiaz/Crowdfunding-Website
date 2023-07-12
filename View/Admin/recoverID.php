<?php

function VIEW_recoverID()
{
?>
    <html>

    <head>
        <title>Recover ID</title>
        <link rel="stylesheet" href="Asset/CSS/style.css">
        <link rel="stylesheet" href="Asset/CSS/recoverID.css">
    </head>

    <script>
        function submitRecoverRequest() {
            // alert(20);
            let xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'redirect.php?submitRecoverRequest', true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            let user = {
                'username': document.getElementById('username').value,
                'lastName': document.getElementById('lastName').value,
                'dob': document.getElementById('dob').value
            }
            let json = JSON.stringify(user);
            xhttp.send('data=' + json);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // let users = JSON.parse(this.responseText);
                    // if (users != "false") {
                    //     loadTableData(users);
                    // } else {
                    //     alert("False");
                    // }

                    // alert(this.responseText);
                    let response = this.responseText;
                    if (response) {
                        document.getElementById('prev').innerHTML = response;
                    } else {
                        alert('Wrong Information! Try again!');
                    }
                }
            }
        }
    </script>

    <body>
        <div class="box" id="prev">
            <table>
                <tr>
                    <td class="left">Enter your username:</td>
                    <td class="right"><input class="inpTxt" type="text" name="username" id="username"></td>
                </tr>
                <tr>
                    <td class="left">Enter your last name:</td>
                    <td class="right"><input class="inpTxt" type="text" name="lastName" id="lastName"></td>
                </tr>
                <tr>
                    <td class="left">Enter Your Date of Birth:</td>
                    <td class="right"><input type="date" name="dob" id="dob" class="inpTxt"></td>
                </tr>
                <tr class="submit">
                    <td colspan="2">
                        <button class="btn" onclick="submitRecoverRequest()">Submit Request</button>
                    </td>
                </tr>
            </table>
        </div>
        <!-- <div id="hidden"></div> -->
    </body>
    <script>
        window.onload = function() {
            document.querySelector('body').classList.toggle('visible');
        };
    </script>

    </html>
<?php
}
