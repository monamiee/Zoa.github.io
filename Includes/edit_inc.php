<?php
    if(isset($_POST['save-profile']))
    {
        require 'dbh_inc.html';
    
        $newusername = $_POST['UserName'];
    
        //User Error Handler
        
        if (!preg_match("/^[a-zA-Z0-9]*$/", $newusername))
        {
            header("Location: ../Edit.html?error=invalidUserName");
            exit();
        }

        else
        {
            session_start();
            $id = $_SESSION['userID'];

            $sql = "SELECT * FROM users WHERE uidUsers='$newusername';";
            $result = mysqli_query($connection,$sql);

            if(mysqli_num_rows($result) > 0)
            {
                header("Location: ../Edit.html?error=usertaken");
                exit();
            }
            else
            {
                $update = "UPDATE users SET uidUsers='$newusername' WHERE idUsers = '$id';";
                $result = mysqli_query($connection,$update);
                header("Location: ../Profile.html?update=success");
                exit();
            }
        }
    }
    else
    {
        header("Location: ../Profile.html");
        exit();
    }
