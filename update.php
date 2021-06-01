<?php session_start();
 include_once 'functions.php';
 $_SESSION ['errors'] = [];
 $users_type = ['admin', 'super_admin', 'user'];
if (! empty($_GET['id'])) {
    if (! empty($_POST['update'])) {
        unset($_POST['update']);

        decomposed_data($_POST);

        if (empty($firstname)) {
            $_SESSION ['errors'][] = 'Firstname is required';
        }elseif (strlen($firstname) > 50) {
            $_SESSION ['errors'][] = 'Firstname must be less than 51 char';
        }elseif (strlen($firstname) < 5) {
            $_SESSION ['errors'][] = 'Firstname must be greater than 5 char';
        
        }
        
        
        
        if (empty($lastname)) {
            $_SESSION ['errors'][] = 'lastname is required';
        }elseif (strlen($lastname) > 50) {
            $_SESSION ['errors'][] = 'lastname must be less than 51 char';
        }elseif (strlen($lastname) < 5) {
            $_SESSION ['errors'][] = 'lastname must be greater than 5 char';
        
        }
        
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION ['errors'][] = 'Email is Invaild';
        }elseif (strlen($email) > 30) {
            $_SESSION ['errors'][] = 'email must be less than 31 char';
        }elseif (strlen($email) < 9) {
            $_SESSION ['errors'][] = 'email must be greater than 9 char';
        }elseif (empty($email)) {
            $_SESSION ['errors'][] = 'email is required';
        }  
        if ( ! empty($password)) {
        if (strlen($password) > 30) {
        $_SESSION ['errors'][] = 'password must be less than 31 char';
        }elseif (strlen($password) < 6) {
        $_SESSION ['errors'][] = 'password must be greater than 6 char'; 
      }
        $password_update = true;
    } 
        if (empty($type)) {
            $_SESSION['errors'] = 'type is empty';
        }elseif (! in_array($type, $users_type)) {
            $_SESSION['errors'] = 'type is invalid';
        }
    
} 

    //check empty errors
   if (! empty($_SESSION['errors'])) {
       header ('location:edit.php?id='.$_GET['id']);
   }else {
       //connect with database
       $connection = mysqli_connect('localhost', 'root', '', 'course');
       if (! $connection) {
           die('connection has failed : ' . mysqli_connect_error());
       }   
           if (! empty($password_update)) {
               $password = password_hash($password, PASSWORD_DEFAULT);
              // echo $password;
              // die();
            $mysql_statement = "update users set firstname = '$firstname', lastname = '$lastname', email = '$email', password ='$password', type = '$type' where id = ".$_GET['id'];
            //echo $mysql_statement;
           //die();
           }else {
            $mysql_statement = "update users set firstname = '$firstname', lastname = '$lastname', email = '$email', type = '$type' where id = ".$_GET['id'];          
           }

           $result = mysqli_query($connection, $mysql_statement);
           if($result) {
               $_SESSION['success'] = 'your data have been updated successfully';
               header ('location:edit.php?id='.$_GET['id']);
           }

      }    
}

