<?php include("admin/conf/config.php");

// $hash_pw = password_hash('@dmin!@#$',PASSWORD_DEFAULT);
// echo $hash_pw;
 // $user_add = "INSERT INTO users (name,eamil,password,role,create_at,update_at) VALUES ('$name','$email','$pass','bronze',now(),now())";
// mysqli_query($conn,$user_add);

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $user_check = "SELECT * FROM users WHERE name = '$name' ";

         $result = mysqli_query($conn,$user_check);
         $count = mysqli_num_rows($result);

        if($count == 1){
            echo "usernameExit";
        }else {
            echo "Successfully Register";

            $user_add = "INSERT INTO users (name,email,password,role,create_at,update_at) VALUES ('$name','$email','$pass','bronze',now(),now())";
            mysqli_query($conn,$user_add);
        }
        //$response = ['status' => 'success', 'data' => $result];
    }
    //returns data as JSON format
    //return json_encode($response);



?>