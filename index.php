<?php
   session_start();
   if (isset($_SESSION['unique_id'])) {
       header("location: users.php");
   }
?>
<?php
   include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Text <span class="on">On</span></header>

            <form action="php/signup.php" method="POST" enctype="multipart/form-data">
                <div class="error-text"> </div>
                <div class="name-details">
                    <div class="field input">
                        <label for="">First Name</label>
                        <input type="text" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label for="">Last Name</label>
                        <input type="text" name="lastName" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                        <label for="">Email Address</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="field input">
                        <label for="">Password</label>
                        <input type="password" name="password" placeholder="Enter new password" required>
                        <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                        <label for="">Select Image</label>
                        <input type="file" name="image" required>
                </div>
                <div class="field button">
                        <input type="submit" value="Continue to chat">
                </div>
            </form>

            <div class="link">Already signed up?<a href="login.php">Login now</a></div>
        </section>
    </div>
    <!-- JAVASCRIPT -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/signup.js"></script>
</body>
</html>