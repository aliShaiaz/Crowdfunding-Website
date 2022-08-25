<?php

function VIEW_transaction()
{
?>

    <html>

    <head>
        <title>Recover ID</title>
        <script src="Asset/JavaScript/script.js"></script>
        <link rel="stylesheet" href="Asset/CSS/style.css">
        <!-- <link rel="stylesheet" href="Asset/CSS/recoverID.css"> -->
    </head>

    <script>
        // function sendRequest(request) {
        //     alert(request.recipientUsername);

        // }

        function submitTransferRequest(recipientType) {
            let request = {};
            if (recipientType != '') {
                if (recipientType == 'user') {
                    let recipientUsername = document.getElementById('username').value;
                    let senderPassword = document.getElementById('password').value;
                    let transferAmount = document.getElementById('transAmount').value;
                    request = {
                        recipientUsername: recipientUsername,
                        senderPassword: senderPassword,
                        transferAmount: transferAmount,
                        recipientType: recipientType
                    }
                } else if (recipientType == 'account') {
                    let recipientAccountID = document.getElementById('accountID').value;
                    let senderPassword = document.getElementById('password').value;
                    let transferAmount = document.getElementById('transAmount').value;

                    request = {
                        recipientAccountID: recipientAccountID,
                        senderPassword: senderPassword,
                        transferAmount: transferAmount,
                        recipientType: recipientType
                    }
                } else if (recipientType == 'withdraw') {}
            }


            if (request != {}) {
                let xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'redirect.php?submitTransferRequest', true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                // let i = 0;
                // Object.keys(request).foreach(value => {
                //     i++;
                // })
                // alert(i);
                let json = JSON.stringify(request);
                xhttp.send('data=' + json);
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // let response = JSON.parse(this.responseText);
                        // alert(this.responseText);

                        let response = JSON.parse(this.responseText);
                        // alert(20);
                        // alert(this.responseText);
                        if (response['status'] == "success") {
                            // alert('ol');
                            document.getElementById('thead').innerHTML = "Congratulations!";
                            document.getElementById('tbody').innerHTML =
                                `
                            Transaction was successful!!<br>
                            TrxID: ` + response['trxID'] + `<br>
                            <button class="btn" onclick="location.href='redirect.php?index'">Back to (Index)</button>
                            `;
                        } else {
                            alert(response['issue']);
                            checkuser();
                        }
                    }
                }
            }


        }

        function checkRecipienctType() {
            recipientType = document.getElementById("recipientType").value;
            // recipientType = 'user';
            if (recipientType != '') {
                if (recipientType == 'user') {
                    document.getElementById('thead').innerHTML =
                        `
                    <u style="font-size: 25px;">Provide User Info</u>
                    `;


                    document.getElementById('tbody').innerHTML =
                        `
                    <tr>
                            <td>
                                Enter Recipients Username:
                            </td>
                            <td>
                                <input class="btn" type="text" name="username" id="username">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Enter Transfer Amount:
                            </td>
                            <td>
                                <input class="btn" type="number" min="100" max="10000" name="transAmount" id="transAmount">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Enter Your Password:
                            </td>
                            <td>
                                <input type="password" class="btn" name="password" id="password">
                            </td>
                        </tr>
                        <td colspan="100%">
                            <button class="btn" onclick="submitTransferRequest('user')">Submit</button>
                        </td>
                    `;
                } else if (recipientType == 'account') {

                    document.getElementById('thead').innerHTML =
                        `
                    <u style="font-size: 25px;">Provide Account Info</u>
                    `;

                    document.getElementById('tbody').innerHTML =
                        `
                        <tr>
                            <td>
                                Enter Recipients Account ID:
                            </td>
                            <td>
                                <input class="btn" type="text" name="accountID" id="accountID">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Enter Transfer Amount:
                            </td>
                            <td>
                                <input class="btn" type="number" min="100" max="10000" name="transAmount" id="transAmount">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Enter Your Password:
                            </td>
                            <td>
                                <input type="password" class="btn" name="password" id="password">
                            </td>
                        </tr>
                        <td colspan="100%">
                            <button class="btn" onclick="submitTransferRequest('account')">Submit</button>
                        </td>
                    `;



                } else if (recipientType == 'withdraw') {

                }

            }

        }

        function checkUser() {
            if (true) {
                document.getElementById('thead').innerHTML = `<u style="font-size: 25px;">Provide Recipient Info</u>`;
                document.getElementById('tbody').innerHTML =
                    `
            <tr>        
                <td>
                    <select id="recipientType" name="">
                        <option value="">Chose Recipient Type</option>
                        <option value="user">User</option>
                        <option value="account">Account</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <button class="btn" onclick="checkRecipienctType()">Next</button>
                </td>
            </tr>
            `;
            }
        }

        window.onload = function() {
            runFunc();
            checkUser();
            // checkRecipienctType();
        }
    </script>

    <style>
        #tbody tr td input {
            background: lightgray;
            font-weight: bold;
        }

        fieldset {
            width: 70%;
        }
    </style>

    <body>
        <div class="box" id="prev">
            <fieldset id="fs">
                <legend>Transaction</legend>
                <table style="text-align: center;">
                    <thead>
                        <th id="thead" colspan="100%"><u style="font-size: 25px;">Provide Account Info</u>
                    </thead>
                    <tbody id="tbody"></tbody>
                </table>
            </fieldset>
        </div>
        <div id="divMenuDD" class="menuDD"></div>
    </body>

    </html>

<?php
}
