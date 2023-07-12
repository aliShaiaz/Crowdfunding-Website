<?php

function UA_loadActionList($userType)
{
    switch ($userType) {
        case 'admin':
            $r['list'] = <<<content
            <li style="width: 150px; padding-top: 30px;">
                <img src="Asset/Icons/index.png" alt="" class="icon">
                <a href="redirect.php?index">Index</a>
            </li>                      
            <li style="width: 150px;">
                <img src="Asset/Icons/listAccounts.png" alt="" class="icon">
                <a href="redirect.php?listAccounts">List Accounts</a>
            </li>
            <li style="width: 150px;">
                <img src="Asset/Icons/getBalance.png" alt="" class="icon">
                <a id="balanceBtn" onClick="displayBalance()" class="">Check Balance</a>
                <a id="balance" class="listHide"></a>
            </li>
            <li>
                <img src="Asset/Icons/withdraw.png" alt="" class="icon">
                <a href="redirect.php?withdraw">Wthdrw/Trnsfr</a>
            </li>
            <li>
                <img src="Asset/Icons/trnxList.png" alt="" class="icon">
                <a href="redirect.php?trnxList">My Trasn.</a>
            </li>
            <li>
                <img src="Asset/Icons/usersList.png" alt="" class="icon">
                <a href="redirect.php?listUsers">List Users</a>
            </li>
            <li>
                <img src="Asset/Icons/edit.png" alt="" class="icon">
                <a href="redirect.php?profileSettings">Settings</a>
            </li>
            <li>
                <img src="Asset/Icons/requests.png" alt="" class="icon">
                <a href="redirect.php?viewRequests">Requests</a>
            </li>
            <li style="width: 130px;" id="modeToggleButton">
                <img src="Asset/Icons/darkMode.png" alt="" class="icon">
                <a onclick="toggleMode(false)">Dark Mode</a>
            </li>
            <li>
                <img src="Asset/Icons/logout.png" alt="" class="icon">
                <a href="redirect.php?logout">Logout</a>
            </li>
            content;
            $r['count'] = 10;

            // $r contains both the list & list.length()
            return $r;

        case 'editor':
            break;
        case 'indiv':
            break;
        case 'inv':
            $r['list'] =  <<<content
            <li style="width: 150px; padding-top: 30px;">
                <img src="Asset/Icons/index.png" alt="" class="icon">
                <a href="redirect.php?index">Index</a>
            </li>                      
            <li style="width: 150px;">
                <img src="Asset/Icons/getBalance.png" alt="" class="icon">
                <a id="balanceBtn" onClick="displayBalance()" class="">Check Balance</a>
                <a id="balance" class="listHide"></a>
            </li>
            <li>
                <img src="Asset/Icons/withdraw.png" alt="" class="icon">
                <a href="redirect.php?withdraw">Wthdrw/Trnsfr</a>
            </li>
            <li>
                <img src="Asset/Icons/trnxList.png" alt="" class="icon">
                <a href="redirect.php?trnxList">My Trasn.</a>
            </li>
            <li>
                <img src="Asset/Icons/edit.png" alt="" class="icon">
                <a href="redirect.php?profileSettings">Settings</a>
            </li>
            <li style="width: 130px;" id="modeToggleButton">
                <img src="Asset/Icons/darkMode.png" alt="" class="icon">
                <a onclick="toggleMode(false)">Dark Mode</a>
            </li>
            <li>
                <img src="Asset/Icons/logout.png" alt="" class="icon">
                <a href="redirect.php?logout">Logout</a>
            </li>
            content;

            $r['count'] = 7;
            // $r contains both the list & list.length()
            return $r;

        case 'org':
            $r['list'] =  <<<content
            <li style="width: 150px; padding-top: 30px;">
                <img src="Asset/Icons/index.png" alt="" class="icon">
                <a href="redirect.php?index">Index</a>
            </li>                      
            <li style="width: 150px;">
                <img src="Asset/Icons/getBalance.png" alt="" class="icon">
                <a id="balanceBtn" onClick="displayBalance()" class="">Check Balance</a>
                <a id="balance" class="listHide"></a>
            </li>
            <li>
                <img src="Asset/Icons/withdraw.png" alt="" class="icon">
                <a href="redirect.php?withdraw">Wthdrw/Trnsfr</a>
            </li>
            <li>
                <img src="Asset/Icons/trnxList.png" alt="" class="icon">
                <a href="redirect.php?trnxList">My Trasn.</a>
            </li>
            <li>
                <img src="Asset/Icons/edit.png" alt="" class="icon">
                <a href="redirect.php?profileSettings">Settings</a>
            </li>
            <li style="width: 130px;" id="modeToggleButton">
                <img src="Asset/Icons/darkMode.png" alt="" class="icon">
                <a onclick="toggleMode(false)">Dark Mode</a>
            </li>
            <li>
                <img src="Asset/Icons/logout.png" alt="" class="icon">
                <a href="redirect.php?logout">Logout</a>
            </li>
            content;

            $r['count'] = 7;
            // $r contains both the list & list.length()
            return $r;

        default:
            break;
    }
}
