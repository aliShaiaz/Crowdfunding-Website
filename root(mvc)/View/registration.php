<?php

function VIEW_Registration()            // ... Investor's Registration Form
{ ?>
    <html>

    <head>
        <title>Registration</title>
        <script>
            let usernameValid = false; // For storing username status

            function isAvailable() {
                let username = document.getElementById('username').value;
                if (/^[a-zA-Z0-9]+$/.test(username) && username.length > 3) {

                    let xhttp = new XMLHttpRequest();
                    xhttp.open('POST', 'redirect.php?checkUsername', true);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send('username=' + username);


                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let isAvailable = this.responseText;
                            if (isAvailable != true) {
                                document.getElementById('usernameSpan').innerHTML = "Username Not Available ❌";
                                usernameValid = false;
                            } else {
                                document.getElementById('usernameSpan').innerHTML = "Username Available ✅";
                                usernameValid = true;
                            }
                        }
                    }
                } else {
                    usernameValid = false;
                    document.getElementById('usernameSpan').innerHTML = "Allowed : (a-z, 0-9, length>3)";
                }
            }

            function verifyPassword() {
                var pw = document.getElementById("pswd").value;
                //check empty password field  
                if (pass == "") {
                    document.getElementById("message").innerHTML = "**Fill the password please!";
                    return false;
                }

                //minimum password length validation  
                if (pass.length < 8) {
                    document.getElementById("message").innerHTML = "**Password length must be atleast 8 characters";
                    return false;
                }

                //maximum length of password validation  
                if (pass.length > 15) {
                    document.getElementById("message").innerHTML = "**Password length must not exceed 15 characters";
                    return false;
                } else {
                    alert("Password is correct");
                }
            }

            function empty() {
                isAvailable();
                if (usernameValid) {
                    // Password Check
                    pass = document.getElementById('password').value;
                    cPass = document.getElementById('confirmPassword').value;
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


                    let userType = document.getElementById('userType').value;
                    if (userType == 'indiv' || userType == 'inv' || userType == 'official') {



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
                    } else if (userType == 'org') {

                        // orgName Check
                        x = document.getElementById("orgName").value;
                        if (!/^[a-zA-Z\s.]+$/.test(x)) {
                            alert("Enter a Valid Organization Name.");
                            return false;
                        };

                        // Email Check
                        if (document.getElementById("email").value == "") {
                            alert("Enter a Valid Email.");
                            return false;
                        };

                        // Address Check
                        x = document.getElementById("address").value;
                        if (!/^[a-zA-Z0-9\s#,-]+$/.test(x)) {
                            alert("Enter a valid Address.");
                            return false;
                        };

                        // TradeLicense Check
                        if (!/^[a-zA-Z0-9]+$/.test(document.getElementById("tradeLicense").value)) {
                            alert("Enter Valid a Trade License.");
                            return false;
                        };
                    }
                    if (userType == 'official' && (document.getElementById('employeeID').value == '' || document.getElementById('role').value == '')) {
                        alert("EmployeeID or Role cannot be Empty");
                        return false;
                    }
                } else {
                    alert("Please select another username to continue.");
                    return false;
                }
            }

            function loadForm() {
                let userType = document.getElementById('userType').value;
                const table = document.getElementById("tableBody");
                table.innerHTML = ""; // This will clearout previous table data   

                if (userType == 'indiv' || userType == 'inv' || userType == 'official') {
                    let fName = table.insertRow();
                    fName.innerHTML =
                        `<td>
                            First Name:
                        </td>
                        <td>
                            <input id="firstName" type="text" name="firstName" value="">
                            <span id="firstNameSpan"></span>
                        </td>
                        `;
                    let lName = table.insertRow();
                    lName.innerHTML =
                        `<td>
                            Last Name:
                        </td>
                        <td>
                            <input id="lastName" type="text" name="lastName" value="">
                            <span id="lastNameSpan"></span>
                        </td>`;
                    let email = table.insertRow();
                    email.innerHTML =
                        `
                            <td>
                                Email:
                            </td>
                            <td>
                                <input id="email" type="email" name="email" value=""><br>
                            </td>
                    `;
                    let dob = table.insertRow();
                    dob.innerHTML =
                        `
                        <td>
                                Date of Birth:
                            </td>
                            <td>
                                <input id="dob" type="date" name="dob" value=""><br>
                            </td>
                    `;
                    let gender = table.insertRow();
                    gender.innerHTML =
                        `
                        <td>
                                Gender:
                            </td>
                            <td>
                                <select id="gender" name="gender">
                                    <option value="">Choose Your Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </td>
                    `;
                    let address = table.insertRow();
                    address.innerHTML =
                        `
                        <td>
                                Address:
                            </td>
                            <td>
                                <input id="address" type="text" name="address" value=""><br>
                            </td>
                    `;
                    let nid = table.insertRow();
                    nid.innerHTML =
                        `
                        <td>
                                NID:
                            </td>
                            <td>
                                <input id="nid" type="text" name="nid" value=""><br>
                            </td>
                    `;
                    let number = table.insertRow();
                    number.innerHTML =
                        `
                        <td>
                                Contact Number:
                            </td>
                            <td>
                                <input id="phone" type="tel" name="phone" pattern="[0][1][3-9][0-9]{8}" placeholder="01XXXXXXXXX" required>
                            </td>
                    `;
                } else if (userType == 'org') {
                    let orgName = table.insertRow();
                    orgName.innerHTML =
                        `<td>
                            Organization Name:
                        </td>
                        <td>
                            <input id="orgName" type="text" name="orgName" value="">
                        </td>
                        `;
                    let number = table.insertRow();
                    number.innerHTML =
                        `
                        <td>
                                Contact Number:
                            </td>
                            <td>
                                <input id="phone" type="tel" name="phone" pattern="[0][1][3-9][0-9]{8}" placeholder="01XXXXXXXXX" required>
                            </td>
                    `;
                    let email = table.insertRow();
                    email.innerHTML =
                        `
                            <td>
                                Email:
                            </td>
                            <td>
                                <input id="email" type="email" name="email" value=""><br>
                            </td>
                    `;
                    let address = table.insertRow();
                    address.innerHTML =
                        `
                        <td>
                                Address:
                            </td>
                            <td>
                                <input id="address" type="text" name="address" value=""><br>
                            </td>
                    `;
                    let tradeLicense = table.insertRow();
                    tradeLicense.innerHTML =
                        `
                        <td>
                                Trade License:
                            </td>
                            <td>
                                <input id="tradeLicense" type="text" name="tradeLicense" value=""><br>
                            </td>
                    `;

                }
                if (userType == 'official') {
                    let employeeID = table.insertRow();
                    employeeID.innerHTML =
                        `<td>
                            Employee ID:
                        </td>
                        <td>
                            <input id="employeeID" type="text" name="employeeID" value="">
                        </td>
                        `;
                    let role = table.insertRow();
                    role.innerHTML =
                        `
                        <td>
                                Role:
                            </td>
                            <td>
                                <select id="role" name="role">
                                    <option value="">Choose Your role</option>
                                    <option value="admin">Admin</option>
                                    <option value="editor">Editor</option>
                                </select>
                            </td>
                    `;

                }
                if (userType != "") {
                    let row = table.insertRow();
                    row.innerHTML =
                        `
                    <tr>
                        <td colspan="2" align="center">
                            <hr>
                            <input type="submit" onclick="return empty()">
                        </td>
                    </tr>
                `;
                } else {
                    table.innerHTML = '<td colspan="2" align="center"><input type="button" value="Next"></td>';
                    alert("Please select a Registration Category First!")
                }
            }
        </script>

    </head>

    <body>

        <form method="post" action="redirect.php?regSubmit" enctype="multipart/form-data">
            <fieldset style="float:inline-start">
                <legend>Registration</legend>
                <table>
                    <tr>
                        <td>
                            Profile Photo:
                        </td>
                        <td>
                            <input type="file" name="profilePhoto">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Username:
                        </td>
                        <td>
                            <input id="username" type="text" name="username" value="" onblur="isAvailable()">
                            <span id="usernameSpan"></span>
                        </td>
                        <!-- <td id="usernameSpan"></td> -->
                    </tr>
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td>
                            <input id="password" type="password" name="password" value=""><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Confirm Password:
                        </td>
                        <td>
                            <input id="confirmPassword" type="password" name="confirmPassword" value=""><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="userType">Are you an:</label>
                        </td>
                        <td>
                            <select name="userType" id="userType" onblur="loadForm()">
                                <option value="">Choose Your Category</option>
                                <option value="org">Organization</option>
                                <option value="indiv">Individual</option>
                                <option value="inv">Investor</option>
                                <option value="official">Official</option>
                            </select>
                            <tbody id="btnBody"></tbody>
                        </td>
                    </tr>
                    <tbody id="tableBody"></tbody>
                </table>
            </fieldset>
        </form>

        <script>
            window.onload = function() {
                document.getElementById('tableBody').innerHTML = '<td colspan="2" align="center"><input type="button" value="Next"></td>';
            }
        </script>
    </body>

    </html>
<?php }
