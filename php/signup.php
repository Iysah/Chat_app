<?php
  session_start();
  include_once "config.php";

  $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
  $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);

  if (!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)) {
      // Email validity
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          //If email is valid
          // if email already exist in database
          $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'" );
          if(mysqli_num_rows($sql) > 0) {
            //   if email already exists
            echo "$email - This email already exist!";
          } else {
              // check if user upload file or not
              if (isset($_FILES['image'])) {
                  //if file is uploaded
                  $img_name = $_FILES['image']['name'];
                  // getting user upload img name
                  $img_type = $_FILES['image']['type'];
                  // getting user upload img type 
                  $tmp_name = $_FILES['image']['tmp_name'];

                  // We explode image & get the last the extension
                  $img_explode = explode('.', $img_name);
                  $img_ext = end($img_explode); // here we get the extension of an user uploaded img file

                  $extensions = ['png', 'jpeg', 'jpg']; // these are some valid img ext and we've store them in array

                  if(in_array($img_ext, $extensions) === true) {
                      $time = time();
                      // this will return us current time...

                    // let's move the user upload img to our particular folder
                    $new_img_name = $time.$img_name;
                    
                   
                   if(move_uploaded_file($tmp_name, "../images/".$new_img_name)) {

                      $status = "Active now"; #once signed up then status will be active 
                      $random_id = rand(time(), 10000000); //creating random id for user

                      // let's insert all user data inside table
                      $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, firstName, lastName, email, password, img, status ) 
                      VALUES ({$random_id}, '{$firstName}', '{$lastName}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");

                      if ($sql2) {
                          # if these data inserted
                          $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                          if (mysqli_num_rows($sql3) > 0) {
                             $row = mysqli_fetch_assoc($sql3);
                             $_SESSION['unique_id'] = $row['unique_id']; //

                             echo "Account successfully created!";
                          }
                      } else {
                          echo "Something went wrong";
                      }

                   }  
                  } else {
                      echo "Please select an image file! - jpeg, jpg, png" ;
                  }
                  
              } else {
                  echo "Please select an Image file!";
              }
          }
      } else {
          echo "$email - This is not a valid Email";
      }
  } else {
      echo "All fields must be filled!";
  }
?>