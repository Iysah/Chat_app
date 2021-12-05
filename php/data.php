<?php    
    
    while ($row = mysqli_fetch_assoc($sql)) {
        $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['unique_id']}
            OR outgoing_msg_id = {$row['unique_id']}) AND (incoming_msg_id = {$outgoing_id}
            OR outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        if (mysqli_num_rows($query2) > 0) {
            $result = $row2['msg'];
            // adding you: text before msg if login id send msg
            ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            ($row['status'] == 'Offline now') ? $offline = 'offline' : $offline = "" ;

        } else {
            $result = "No message available";
            $you = "";
            $offline = "";
        }

        // triming message if word are more than 28
        (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
        // checking if user is online or offline 
        

        $output .= '<a href="chat_page.php?user_id='.$row['unique_id'].'">
                <div class="content">
                    <img src="images/'.$row['img'] .'" alt="">
                <div class="details">
                    <span>'.$row['firstName']. " ". $row['lastName'].'</span>
                    <p>' . $you . $msg .'</p>
                </div>
                </div>
                <div class="status-dots '.$offline .'"><i class="fas fa-circle"></i></div>
             </a>' ;
   }

?>