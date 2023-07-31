<?php
require_once("connection.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // echo $password;

    try {

        $stmt = $conn->prepare("SELECT * FROM `users`, `roles` WHERE `users`.roleID = `roles`.roleID AND `Email` = :email AND `Password` = :pass");
        $stmt->execute(array(":email" => $email, ":pass" => $password));

        if ($stmt->rowCount() == 1) {
            $data = $stmt->fetch();

            session_start();
            $_SESSION['user'] = $data['Email'];
            $_SESSION['role'] = $data['roleName'];
            $_SESSION['id']  = $data['userID'];

            if ($_SESSION['role'] == 'admin') {
                header('Location: ../admin/index.php');
            } elseif ($_SESSION['role'] == 'customer') {
                header('Location: ../index.php');
            } else {
               
                header("location: ../login.php");
              
            }

            echo $_SESSION['user'];
        }else{
            {
               
                header("location: ../login.php?error=booked");
                
		
            }  
            
        }
    } catch (Exception $e) {
        echo "An error has occurred" . $e;
    }
}
