<?php
   session_start();
   if (!isset($_SESSION['unique_id'])) {
       header("location: login.php");
   }
?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                    include_once "php/config.php";
                    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);

                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_assoc($sql);
                    }
                ?>
                <a href="#" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="images/<?php echo $row['img'] ?>" alt="">
                <div class="details">
                    <span><?php
                               echo $row['firstName']. " ". $row['lastName'];
                            ?></span>
                    <p><?php echo $row['status'];?></p>
                </div>
            </header>
            <div class="chat-box">
                
                
  
            </div>

            <!-- TYPING SECTION -->
            <form action="#" class="typing-area">
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION['unique_id'] ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."> <button class="send-btn"><i class="fas fa-arrow-up"></i></button>
            </form>

            
        </section>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/chat_page.js"></script>
</body>
</html>