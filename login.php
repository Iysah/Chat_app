<?php
   session_start();
   if (isset($_SESSION['unique_id'])) {
    // if user is logged in 
    header("location: users.php");
   }
?>
<?php
   include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Text <span class="on">On</span></header>

            <form action="php/login.php" method="POST">
                <div class="error-text"> </div>

                <div class="field input">
                        <label for="">Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email">
                </div>
                <div class="field input">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="Enter new password">
                        <i class="fas fa-eye"></i>
                </div>

                <div class="field button">
                        <input type="submit" value="Continue to chat">
                </div>
            </form>

            <div class="link">Not yet signed up?<a href="index.php">Create an account</a></div>
        </section>
    </div>
    <!-- JAVASCRIPT -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/login.js"></script>
</body>
</html>