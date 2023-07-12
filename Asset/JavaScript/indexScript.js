let username = "";
      getUsername();
      getPosts();

      function getUsername() {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "redirect.php?getUsername");
        xhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        xhttp.send();

        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            // let username = JSON.parse(this.responseText);
            username = this.responseText;
          }
        };
      }

      function loadPosts(items) {
        const div = document.getElementById("posts");
        items.forEach((item) => {
          if (item["approveStatus"] == 1) {
            div.innerHTML +=
              `
                <div>
                <h2>` +
              item["postTitle"] +
              // item["postID"] +
              `
                   </h2>
                   <img class="postPhoto" src="Asset/Storage/postPhotos/` +
              item["postID"] +
              `.png" />
               <p>` +
              item["postContent"] +
              `</p>
                <input type="text" class="inpTxt flow" value="Fund Target: ` +
              item["fundTarget"] +
              ` BDT" readonly>
                <input type="text" class="inpTxt flow" value="Fund Raised: ` +
              item["currentFund"] +
              ` BDT" readonly><br>
                  <input type="button" class="inpTxt inv" value="Invest?">
                </div>
                `;
          }
        });
        items.forEach((item) => {
          document.getElementById("postPhoto").innerHTML =
            `
                <img id="profilePhoto" src="Asset/Storage/postPhotos/` +
            item["postID"] +
            `.png" />
                `;
        });
      }

      function getPosts() {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "redirect.php?getPosts");
        xhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        xhttp.send();

        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            // let username = JSON.parse(this.responseText);
            let posts = JSON.parse(this.responseText);
            // alert(50);
            loadPosts(posts);
            // alert(this.responseText);
          }
        };
      }

      // Common Functions for All //
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

      function checkLoginStatus() {
        loggedIn = function () {
          {
            // If an User is signed in
            document.querySelector(".menuDD").classList.toggle("signedIn");

            document.getElementById("spanPP").innerHTML =
              `
                <img id="profilePhoto" src="Asset/Storage/profilePhotos/` +
              username +
              `.png" />
                `;
            document.getElementById("userMenu").innerHTML = `
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

        // var cookieArr = document.cookie.split(";");
        // alert(cookieArr);
        if (checkCookie("session")) {
          // alert("logged in");
          loggedIn();
        } else {
          // alert("not logged in");
          notLoggedIn();
        }
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

      function runFunc() {
        checkLoginStatus();
        document.querySelector("body").classList.toggle("visible");
        menuDD();
      }