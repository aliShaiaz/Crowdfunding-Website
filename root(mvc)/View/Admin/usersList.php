<?php



function ADMIN_displayUsersList()
{ ?>
    <html>

    <head>
        <title>
            Users List
        </title>
        <script src="Asset/JavaScript/script.js"></script>
        <link rel="stylesheet" href="Asset/CSS/style.css">
        <!-- <link rel="stylesheet" href="Asset/CSS/usersList.css"> -->


        <script>
            function loadTableData(items) {
                // const tableHead = document.getElementById("tHead");
                // let i = 0;
                // obj.key(item[0]).forEach(key => {
                //     let row = tableHead.insertRow();

                //     row.insertCell(i).innerHTML = key;
                //     i++;
                // })


                const table = document.getElementById("tableBody");
                table.innerHTML = ""; // This will clearout previous table data   
                // const tHead = document.getElementById("spanHead");
                // head = tHead.insertRow();

                items.forEach(item => {
                    row = table.insertRow();

                    // i = 0;
                    // Object.keys(item).forEach(key => {
                    //     // document.getElementById('spanHead').innerHTML +=
                    //     //     `
                    //     // <th>` + key + `</th>
                    //     // `;
                    //     row.insertCell(i).innerHTML = item[key];
                    //     i++;
                    // });


                    let username = row.insertCell(0);
                    username.innerHTML = item['username'];
                    let name = row.insertCell(1);
                    name.innerHTML = item['firstName'] + " " + item['lastName'];
                    let email = row.insertCell(2);
                    email.innerHTML = item['email'];
                    let dob = row.insertCell(3);
                    dob.innerHTML = item['dob'];
                    let gender = row.insertCell(4);
                    gender.innerHTML = item['gender'];
                    let address = row.insertCell(5);
                    address.innerHTML = item['address'];
                    let nid = row.insertCell(6);
                    nid.innerHTML = item['nid'];
                    let type = row.insertCell(7);
                    type.innerHTML = item['userType'];
                    let phone = row.insertCell(8);
                    phone.innerHTML = item['phone'];
                    if (item['activeStatus'] == 1) {
                        row.insertCell(9).innerHTML = "Yes";
                    } else {
                        row.insertCell(9).innerHTML = "No";
                    }

                    row.insertCell(10).innerHTML = `<button class="btn" onclick="location.href='redirect.php?edit=` + item['username'] + `'">Edit</button>`;
                    row.insertCell(11).innerHTML = `<button class="btn" onclick="location.href='redirect.php?toggleActiveStatus=` + item['username'] + `'">Disable</button>`;
                });
            }

            function populateTable() {
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?getUsersList', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let users = JSON.parse(this.responseText);
                        // alert(this.responseText);
                        // alert(1009);
                        if (users != "false") {
                            loadTableData(users);
                        } else {
                            alert("False");
                        }
                    }
                }
            }
        </script>

    </head>

    <body>
        <div class="box">
            <fieldset>
                <legend>Users List</legend>
                <table border="1" id="myTable" class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>NID</th>
                            <th>User Type</th>
                            <th>Phone</th>
                            <th>Active</th>
                            <!-- <span align="center" id="spanHead"></span> -->

                            <!-- <th>activeStatus</th>
                            <th>userID</th>
                            <th>username</th>
                            <th>password</th>
                            <th>userType</th>
                            <th>firstName</th>
                            <th>lastName</th>
                            <th>email</th>
                            <th>dob</th>
                            <th>gender</th>
                            <th>address</th>
                            <th>nid</th>
                            <th>phone</th>
                            <th>orgName</th>
                            <th>tradeLicense</th>
                            <th>empID</th>
                            <th>empRole</th> -->

                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody align="center" id="tableBody"></tbody>
                </table>

                <div>
                    <input class="btn submitBtn" type="button" id="click" name="submit" value="Populate Table" onclick="populateTable()">
                    <!-- <input class="btn" type="submit" onclick="redirect.php?home" value="Back"> -->
                    <button class="btn submitBtn" onclick="location.href='redirect.php?home'">Back</button>
                </div>
            </fieldset>
        </div>

        <div id="divMenuDD" class="menuDD"></div>

    </body>

    <script>
        window.onload = function() {
            runFunc();
            populateTable();
        };
    </script>

    </html>
<?php }
