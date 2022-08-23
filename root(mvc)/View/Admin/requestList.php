<?php



function ADMIN_displayRequestList()
{ ?>
    <html>

    <head>
        <title>
            Users List
        </title>
        <link rel="stylesheet" href="Asset/CSS/style.css">
        <link rel="stylesheet" href="Asset/CSS/usersList.css">
        <script>
            function loadTableData(items) {

                const table = document.getElementById("tableBody");
                table.innerHTML = "";
                items.forEach(item => {
                    row = table.insertRow();

                    let requestID = row.insertCell(0);
                    requestID.innerHTML = item['requestID'];
                    let postID = row.insertCell(1);
                    postID.innerHTML = item['postID'];
                    let approveStatus = row.insertCell(2);
                    approveStatus.innerHTML = item['approveStatus'];

                    row.insertCell(3).innerHTML = `<button class="btn" onclick="location.href='redirect.php?approve=` + item['requestID'] + `'">Approve</button>`;
                    row.insertCell(4).innerHTML = `<button class="btn" onclick="location.href='redirect.php?refuse=` + item['requestID'] + `'">Refuse</button>`;
                });
            }

            function populateTable() {
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?getReqList', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let requests = JSON.parse(this.responseText);
                        // alert(this.responseText);
                        // alert(50)
                        if (requests != "false") {
                            loadTableData(requests);
                            // true;
                        } else {
                            alert("False");
                        }
                    }
                }
            }

            window.onload = function() {
                populateTable();
                document.querySelector('body').classList.toggle('visible');
            };
        </script>

    </head>

    <body>
        <div class="box">
            <fieldset>
                <legend>Users List</legend>
                <table border="1" id="myTable" class="table table-borderless table-striped table-earning">
                    <thead>
                        <tr>
                            <th>requestID</th>
                            <th>postID</th>
                            <th>approveStatus</th>
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

    </body>

    </html>
<?php }
