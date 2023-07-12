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
        <style id="actionCount"></style>


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


                    let i = 0;
                    let username = row.insertCell(i);
                    username.innerHTML = item['username'];
                    let name = row.insertCell(++i);
                    name.innerHTML = item['firstName'] + " " + item['lastName'];
                    let email = row.insertCell(++i);
                    email.innerHTML = item['email'];
                    let dob = row.insertCell(++i);
                    dob.innerHTML = item['dob'];
                    let gender = row.insertCell(++i);
                    gender.innerHTML = item['gender'];
                    // let address = row.insertCell(++i);
                    // address.innerHTML = item['address'];
                    // let nid = row.insertCell(++i);
                    // nid.innerHTML = item['nid'];
                    let type = row.insertCell(++i);
                    type.innerHTML = item['userType'];
                    let phone = row.insertCell(++i);
                    phone.innerHTML = item['phone'];
                    if (item['activeStatus'] == 1) {
                        row.insertCell(++i).innerHTML = "Yes";
                    } else {
                        row.insertCell(++i).innerHTML = "No";
                    }
                    let accountID = row.insertCell(++i);
                    if (item['accountID']) {
                        accountID.innerHTML = item['accountID'];
                    } else {
                        // row.insertCell(++i).innerHTML = `<button class="btn" onclick="location.href='redirect.php?toggleActiveStatus=` + item['username'] + `'">Disable</button>`;
                        // alert(item['username']);
                        let username = item['username'];
                        // alert("-" + username + "-");
                        accountID.innerHTML = `<button class="btn" onclick="sendRequest('` + username + `')">Create</button>`;
                    }

                    row.insertCell(++i).innerHTML = `<button class="btn" onclick="location.href='redirect.php?edit=` + item['username'] + `'">Edit</button>`;
                    row.insertCell(++i).innerHTML = `<button class="btn" onclick="location.href='redirect.php?toggleActiveStatus=` + item['username'] + `'">Disable</button>`;
                });
            }

            function sendRequest(username) {
                // alert('req');
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?createAccount=' + username, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = this.responseText;
                        // alert(response);
                        if (response != "false") {
                            populateTable();
                        } else {
                            alert("False");
                        }
                    }
                }
            }




            function populateTable() {
                // alert(12312);
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?getUsersList', true);
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
                            <!-- <th>Address</th> -->
                            <!-- <th>NID</th> -->
                            <th>User Type</th>
                            <th>Phone</th>
                            <th>Active</th>
                            <th>accountID</th>

                            <th id="action" colspan="2">Action</th>
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
            populateTable();
            runFunc();
        };
    </script>

    </html>
<?php }
