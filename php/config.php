<?php
   $conn = mysqli_connect("localhost", "root", "", "text_on_app");

   if (!$conn) {
       echo "Database connected". mysqli_connect_error();
   }
?>