<?php

function MySQL_connect()
{
    $address = 'localhost:3306';
    $username = 'root';
    $password = '';
    $DB_name = 'CrowdFunding';
    // $conn = mysqli_connect('localhost:3306', 'root', '', 'tempDB');
    return mysqli_connect($address, $username, $password, $DB_name);
}

function MySQL_runSQL($sql)
{
    $conn = MySQL_connect();
    $response = mysqli_query($conn, $sql);

    if ($response != '1') {
        $result = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($response)) {
            $result[$i] = $row;
            $i++;
        }
        return $result;
    } else {
        return $conn;
        // return true;
    }
}

// function display($result)
// {

//     echo "<table border=1>
//             <tr>
//                 <td>ID</td>
//                 <td>USername</td>
//                 <td>Email</td>
//             </tr>";

//     while ($row = mysqli_fetch_assoc($result)) {
//         echo "<tr>
//                     <td>{$row['username']}</td>
//                     <td>{$row['password']}</td>
//                     <td>{$row['userType']}</td>
//             </tr>";
//     }

//     echo "</table>";

//     $conn = MySQL_connect();
//     $flag = true;

//     if ($conn) {
//         echo "success";
//     } else {
//         echo "DB error";
//     }

//     $sql = "select * from users";
//     $result = mysqli_query($conn, $sql);

//     display($result);
// }
