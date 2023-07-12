// Common Functions for All //

let __username = "";
getUsername();

function getUsername() {
  let xhttp = new XMLHttpRequest();
  xhttp.open("GET", "redirect.php?getUsername");
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      __username = this.responseText;
      // alert(this.responseText);
    }
  };
}
function displayBalance() {
  let balance = document.getElementById("balance");
  let balanceBtn = document.getElementById("balanceBtn");

  if (balance.classList.contains("listHide")) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "redirect.php?getBalance");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let blnce = this.responseText;

        // alert(balance);

        if (blnce != false) {
          setTimeout(() => {
            // let balance = document.getElementById('balance')
            // let balanceBtn = document.getElementById('balanceBtn')
            balance.innerHTML = blnce + " BDT.";
            balanceBtn.classList.toggle("listHide");
            balance.classList.toggle("listHide");
            // balanceBtn.classList.toggle("listHide");
            setTimeout(() => {
              balance.classList.toggle("listHide");
              balanceBtn.classList.toggle("listHide");
            }, 3000);
          }, 1000);
        }
      }
    };
  }
}

function checkCookie(cookieName) {
  var cookieArr = document.cookie.split(";");
  for (var i = 0; i < cookieArr.length; i++) {
    var cookiePair = cookieArr[i].split("=");
    if (cookieName == cookiePair[0].trim()) {
      return cookiePair[1].trim();
    }
  }
  return false;
}

function menuDD_Fill() {
  loggedIn = function () {
    {
      // If an User is signed in
      document.querySelector(".menuDD").classList.toggle("signedIn");

      document.getElementById("spanPP").innerHTML =
        `
                <img id="" src="Asset/Storage/profilePhotos/` +
        __username +
        `.png" />
                  `;
      document.getElementById("userMenu").innerHTML = `
                      <li style="width: 150px; padding-top: 30px;">
                          <img src="Asset/Icons/index.png" alt="" class="icon">
                          <a href="redirect.php?index">Index</a>
                      </li>                      
                      <li style="width: 150px;">
                          <img src="Asset/Icons/createAccount.png" alt="" class="icon">
                          <a href="redirect.php?createAccount">Create Account</a>
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
                      </li>
                      <li>
                          <img src="Asset/Icons/logout.png" alt="" class="icon">
                          <a href="redirect.php?logout">Logout</a>
                      </li>
                `;
      document.getElementById("modeToggleButton").innerHTML = `
                <img src="Asset/Icons/darkMode.png" alt="" class="icon">
                          <a onclick="toggleMode(false)">Dark Mode</a>
                          `;

      if (checkCookie("darkMode") == "true") {
        toggleMode(true);
        // } else {
        //   document.cookie = "darkMode=false";
      }
      // . . . //
    }
  };
  notLoggedIn = function () {
    {
      // If no user is signed in
      document.querySelector(".menuDD").classList.toggle("notSignedIn");

      document.getElementById("userMenu").innerHTML = `
                <li>
                    <img src="Asset/Icons/login.png" alt="" class="icon">
                    <a href="redirect.php?login">Login</a>
                </li>
                <li>
                    <img src="Asset/Icons/register.png" alt="" class="icon">
                    <a href="redirect.php?register">Register</a>
                </li>
                        `;
      // . . . //
    }
  };
  if (checkCookie("session")) {
    loggedIn();
  } else notLoggedIn();
}

function menuDD() {
  let menuToggle = document.querySelector(".menuToggle");
  let menuDD = document.querySelector(".menuDD");

  menuToggle.onclick = function () {
    menuDD.classList.toggle("active");
  };
}

function toggleMode(onload) {
  if (!onload) {
    f = function () {
      document.querySelector("body").classList.toggle("darkMode");
      document.querySelector("body").classList.toggle("visible");
      document.querySelector(".menuDD").classList.toggle("active");

      if (document.querySelector("body").classList.contains("darkMode")) {
        document.getElementById("modeToggleButton").innerHTML = `
                  <img src="Asset/Icons/lightMode.png" alt="" class="icon">
                  <a onclick="toggleMode(false)">Light Mode</a>
                  `;
        document.cookie = "darkMode=true";
      } else {
        document.getElementById("modeToggleButton").innerHTML = `
              <img src="Asset/Icons/darkMode.png" alt="" class="icon">
              <a onclick="toggleMode(false)">Dark Mode</a>
              `;
        document.cookie = "darkMode=false";
      }
    };
    document.querySelector("body").classList.toggle("visible");
    document.querySelector(".menuDD").classList.toggle("active");
    setTimeout(f, 1000);
  } else {
    document.querySelector("body").classList.toggle("darkMode");
    if (document.querySelector("body").classList.contains("darkMode")) {
      document.getElementById("modeToggleButton").innerHTML = `
                <img src="Asset/Icons/lightMode.png" alt="" class="icon">
                <a onclick="toggleMode(false)">Light Mode</a>
                `;
      document.cookie = "darkMode=true";
    } else {
      document.getElementById("modeToggleButton").innerHTML = `
            <img src="Asset/Icons/darkMode.png" alt="" class="icon">
            <a onclick="toggleMode(false)">Dark Mode</a>
            `;
      document.cookie = "darkMode=false";
    }
  }
}

function writeMenuDD() {
  document.getElementById("divMenuDD").innerHTML = `
        <div class="userBx">
          <div class="imgBx">
            <span id="spanPP"></span>
          </div>
          <p class="text">Welcome!</p>
        </div>
        <div class="menuToggle"></div>
        <ul id="userMenu" class="menu"></ul>
        `;
}

function runFunc() {
  document.querySelector("body").classList.toggle("visible");
  writeMenuDD();
  menuDD();
  menuDD_Fill();
}

// <script src="Asset/JavaScript/script.js"></script>
// <div id="divMenuDD" class="menuDD"></div>
// runFunc()
