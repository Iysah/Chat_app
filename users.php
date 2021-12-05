<?php
   session_start();
   if (!isset($_SESSION['unique_id'])) {
       header("location: login.php");
   }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                    include_once "php/config.php";
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>
                <div class="content">
                    <img src="images/<?php echo $row['img'] ?>" alt="">
                    <div class="details">
                        <span>
                            <?php
                               echo $row['firstName']. " ". $row['lastName'];
                            ?>
                        </span>
                        <p> 
                            <?php
                               echo $row['status'];
                            ?> 
                        </p>
                    </div>
                </div>
                <a href="php/logout.php?user_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>
            </header>

            <div class="search">
                <span class="search-text">Select a user to start chat</span>
                <input type="text" class="search-input" placeholder="Enter name to search...">
                <button class="search-btn"><i class="fas fa-search"></i></button>
            </div>

            <div class="users-list">
                
            </div>
        </section>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // SEARCH BUTTON ON USERS
            const searchBar = document.querySelector(".search-input"),
            searchBtn = document.querySelector(".search-btn"),
            usersList = document.querySelector(".users .users-list");
    
            searchBtn.onclick = ()=> {
               searchBar.classList.toggle("active");
               searchBar.focus();
               searchBtn.classList.toggle("active");
               searchBar.value = " ";
            }

            searchBar.onkeyup = ()=> {
                let searchTerm = searchBar.value;
                if(searchTerm != " ") {
                    searchBar.classList.add("active");
                } else {
                    searchBar.classList.remove("active");
                }
                // Ajax code starts here
                let xhr = new XMLHttpRequest();
                //XML objects
                xhr.open("POST", "php/search.php", true);
                xhr.onload = ()=> {
                    if(xhr.readyState === XMLHttpRequest.DONE) {
                        if(xhr.status === 200) {
                            let data = xhr.response;
                            usersList.innerHTML = data;
                        }
                    }
                }
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("searchTerm=" + searchTerm);

            }

            setInterval(() => {
                // Ajax code starts here
                let xhr = new XMLHttpRequest();
                //XML objects
                xhr.open("GET", "php/users.php", true);
                xhr.onload = ()=> {
                    if(xhr.readyState === XMLHttpRequest.DONE) {
                        if(xhr.status === 200) {
                            let data = xhr.response;
                            if (!searchBar.classList.contains("active")) {
                                usersList.innerHTML = data;
                            } 
                        }
                    }
                }
                xhr.send();
            }, 500);
        });
    </script>

</body>
</html>