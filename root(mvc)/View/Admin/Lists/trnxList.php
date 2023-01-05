<?php



function ADMIN_displayTrnxList()
{ ?>
    <html>

    <head>
        <title>
            My Transactions
        </title>
        <script src="Asset/JavaScript/script.js"></script>
        <link rel="stylesheet" href="Asset/CSS/style.css">


        <script>
            function loadTableData(items) {
                let content = "";
                // row = table.insertRow();
                Object.keys(items[0]).forEach(key => {
                    content += "<th>" + key + "</th>";
                })
                content += "<th colspan=\"2\">ACTION</th>"
                document.getElementById('headRow').innerHTML = content;


                const table = document.getElementById("tableBody");
                table.innerHTML = "";
                items.forEach(item => {
                    row = table.insertRow();

                    let i = 0;
                    Object.keys(item).forEach(key => {
                        row.insertCell(i).innerHTML = item[key];
                        i++;
                    })


                    // row = table.insertRow();
                    // let username = row.insertCell(0);
                    // username.innerHTML = item['username'];
                    // let name = row.insertCell(1);
                    // name.innerHTML = item['firstName'] + " " + item['lastName'];
                    // let email = row.insertCell(2);
                    // email.innerHTML = item['email'];
                    // let dob = row.insertCell(3);
                    // dob.innerHTML = item['dob'];
                    // let gender = row.insertCell(4);
                    // gender.innerHTML = item['gender'];
                    // let address = row.insertCell(5);
                    // address.innerHTML = item['address'];
                    // let nid = row.insertCell(6);
                    // nid.innerHTML = item['nid'];
                    // let type = row.insertCell(7);
                    // type.innerHTML = item['userType'];
                    // let phone = row.insertCell(8);
                    // phone.innerHTML = item['phone'];
                    // if (item['activeStatus'] == 1) {
                    //     row.insertCell(9).innerHTML = "Yes";
                    // } else {
                    //     row.insertCell(9).innerHTML = "No";
                    // }

                    // row.insertCell(i).innerHTML = `<button class="btn" onclick="location.href='redirect.php?toggleSuspend=` + item['accountID'] + `'">Toggle Suspend</button>`;
                    row.insertCell(i).innerHTML = `
                    <button class="btn" onclick="sendRequest(` + item['accountID'] + `)">Toggle Suspend</button>`;


                    // row.insertCell(++i).innerHTML = `<button class="btn" onclick="location.href='redirect.php?toggleActiveStatus=` + item['username'] + `'">Disable</button>`;
                });
            }

            function sendRequest(accountID) {
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?trnxList=' + accountID, true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let response = this.responseText;
                        alert(response);
                        // if (response != "false") {
                        //     populateTable();
                        // } else {
                        //     alert("False");
                        // }
                    }
                }
            }

            function populateTable() {
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?getTrnxList', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let trxns = JSON.parse(this.responseText);
                        // alert(this.responseText);
                        if (trxns != "false") {
                            loadTableData(trxns);
                        } else {
                            alert("False");
                        }
                    }
                }
            }
        </script>
        <style id="actionCount"></style>


    </head>

    <body>
        <div class="box">
            <fieldset>
                <legend>My Transactions</legend>
                <table border="1" id="myTable" class="table table-borderless table-striped table-earning">
                    <thead>

                        <tr id="headRow">
                            <!-- <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>NID</th>
                            <th>User Type</th>
                            <th>Phone</th>
                            <th>Active</th>
                            <th colspan="2">Action</th> -->
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
