<?php

function VIEW_profileSettings()
{
?>
    <html>

    <head>
        <title>Profile Settings</title>

        <script src="Asset/JavaScript/script.js"></script>

        <script>
            function fillData() {
                requestUserInfo();
            }

            function loadTableData(user) {
                // Setting Profile Photo //
                document.getElementById('profilePhoto').setAttribute("src", "Asset/Storage/profilePhotos/" + user['username'] + ".png");
                // ... //
                const tBody1 = document.getElementById("tBody1");

                tBody1.innerHTML = '';

                Object.keys(user).forEach(key => {
                    // table.innerHTML += key + ": " + user[key] + "<br>";

                    if (user[key] != null && key != 'activeStatus') {
                        if (key == 'dob') {
                            let row = tBody1.insertRow();

                            row.insertCell(0).innerHTML = key + " ";
                            row.insertCell(1).innerHTML = `<input class="inpTxt" type="date" name="` + key + `" id="` + key + `" value="` + user[key] + `">`;
                        } else if (key == 'password') {
                            let row = tBody1.insertRow();

                            row.insertCell(0).innerHTML = key + " ";
                            row.insertCell(1).innerHTML = `<input class="inpTxt" type="password" name="` + key + `" id="` + key + `" value="` + user[key] + `">`;
                        } else if (key == 'username' || key == 'empRole' || key == 'gender' || key == 'userType') {
                            let row = tBody1.insertRow();

                            row.insertCell(0).innerHTML = key + " ";
                            row.insertCell(1).innerHTML = `<input class="inpTxt" type="text" name="` + key + `" id="` + key + `" value="` + user[key] + `" readonly>`;
                        } else if (key == 'phone') {

                            let row = tBody1.insertRow();

                            row.insertCell(0).innerHTML = key + " ";
                            row.insertCell(1).innerHTML = `<input class="inpTxt" type="tel" pattern="[0][1][3-9][0-9]{8}" placeholder="01XXXXXXXXX" required name="` + key + `" id="` + key + `" value="` + user[key] + `">`;
                        } else {
                            let row = tBody1.insertRow();

                            row.insertCell(0).innerHTML = key + " ";
                            row.insertCell(1).innerHTML = `<input class="inpTxt" type="text" name="` + key + `" id="` + key + `" value="` + user[key] + `">`;
                        }
                    }
                    // if (user[key] != null && key != "activeStatus") {
                    //     if (key == 'email') {
                    //         let row = tBody1.insertRow();

                    //         row.insertCell(0).innerHTML = key + " ";
                    //         row.insertCell(1).innerHTML = `<input class="inpTxt" type="email" name="` + key + `" id="` + key + `" value="` + user[key] + `">`;
                    //     }
                    //     elseif(key == 'dob') {
                    //         let row = tBody1.insertRow();

                    //         row.insertCell(0).innerHTML = key + " ";
                    //         row.insertCell(1).innerHTML = `<input class="inpTxt" type="date" name="` + key + `" id="` + key + `" value="` + user[key] + `">`;
                    //     }
                    // }
                })
            }

            function requestUserInfo() {
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?getProfileInfo', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let users = JSON.parse(this.responseText);
                        if (users != "false") {
                            loadTableData(users);
                        } else {
                            alert("False");
                        }
                    }
                }
            }

            function empty() {
                // alert('temp');
                // Password Check
                // pass = document.getElementById('password').value;
                // cPass = document.getElementById('confirmPassword').value;
                // if (pass == "" || cPass == "") {
                //     alert("Please enter your Password!");
                //     return false;
                // } else if (cPass != pass) {
                //     alert("Your passwords do not match!");
                //     return false;
                // }



                // Firstname Check
                x = document.getElementById("firstName").value;
                if (!/^[A-Za-z]+$/.test(x) || x.length < 3 || x.length > 10) {
                    document.getElementById('firstNameSpan').innerHTML = 'Only A-Z, a-z & 3-10 characters are allowed!';
                    return false;
                }

                // Lastname Check
                x = document.getElementById("lastName").value;
                if (!/^[A-Za-z]+$/.test(x) || x.length < 3 || x.length > 10) {
                    document.getElementById('lastNameSpan').innerHTML = 'Only A-Z, a-z & 3-10 characters are allowed!';
                    return false;
                }


                // Date of Birt Check (whether 18+ or not)
                date = document.getElementById('dob').value.trim();
                dob = Date.parse(date);
                today = Date.parse(Date());
                diff = today - dob;
                if (diff < 567648000000) { // 567648000000 is 18 yrs in milisec.
                    alert("You have to be an adult to register!");
                    return false;
                } else if (date == "") {
                    alert("Please Enter Date of Birth!");
                    return false;
                }

                // Gender Check
                x = document.getElementById("gender").value;
                if (x == "") {
                    alert("Please select your Gender.");
                    return false;
                };

                // Address Check
                x = document.getElementById("address").value;
                if (!/^[a-zA-Z0-9\s#,-]+$/.test(x)) {
                    alert("Enter a valid Address.");
                    return false;
                };

                // NID Check
                x = document.getElementById("nid").value;
                // if (x == "") {
                if (!/^[0-9]+$/.test(x)) {
                    alert("Enter a valid NID Number.");
                    return false;
                };

                if (document.getElementById('empID').value == '') {
                    alert("EmployeeID or Role cannot be Empty");
                    return false;
                }

            }

            window.onload = function() {
                fillData();
                // document.querySelector('body').classList.toggle('visible');
                runFunc();
            };
        </script>

        <link rel="stylesheet" href="Asset/CSS/style.css">
        <link rel="stylesheet" href="Asset/CSS/profileSettings.css">

        <style>

        </style>
    </head>

    <body class="main">
        <div class="box">
            <div class="divImage">
                <img id="profilePhoto" src="" alt="">
            </div>
            <div class="divForm">
                <form method="POST" action="redirect.php" enctype="multipart/form-data">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    Profile Photo:
                                </td>
                                <td id="temp">
                                    <input type="file" name="profilePhoto">
                                </td>
                            </tr>
                        </tbody>
                        <tbody id='tBody1'></tbody>
                        <tbody class="tbody">
                            <tr>
                                <td colspan="2">
                                    <!-- <input type="submit" name="infoUpdate" value="Update" onclick="return empty()"> -->
                                    <!-- <input type="submit" name="accountDisable" value="Disable Account"> -->
                                    <button class="btn" name="infoUpdate" type="submit">Update</button>
                                    <button class="btn" name="accountDisable" type="submit">Disable Account</button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <!-- <input type="submit" name="home" value="Back"> -->
                                    <button class="btn" type="submit" name="home">Back</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
                <!-- <button onclick="location.href = 'redirect.php?home';">Back</button> -->
            </div>
        </div>

        <div id="divMenuDD" class="menuDD"></div>



        <script>
            // window.onload = fillData();
        </script>
    </body>

    </html>
<?php
}
