<?php

if(isset($_POST['change-submit']))
{
    require 'dbh_inc.html';

    $currentPass = $_POST['CurrentPass'];
    $newPass = $_POST['NewPass'];
    $confirmPass = $_POST['ConfirmPass'];

    //User Error Handler

    if(empty($currentPass) || empty($newPass) || empty($confirmPass))
    {
        header("Location: ../ChangePass.html?error=emptyfields");
        exit();
    }
    else if ($newPass !== $confirmPass)
    {
        header("Location: ../ChangePass.html?error=passwordcheck");
        exit();
    }
    else
    {
        session_start();
        $id = $_SESSION['userID'];

        $sql = "SELECT * FROM users WHERE idUsers='$id';";
        $result = mysqli_query($connection,$sql);

        if(!mysqli_num_rows($result) > 0)
        {
            header("Location: ../Edit.html?error=sqlerror");
            exit();
        }
        else
        {
            if($row = mysqli_fetch_assoc($result))
            {
                $pswcheck = password_verify($currentPass, $row['pswUsers']);
                if($pswcheck == false)
                {
                    header("Location: ../ChangePass.html?error=wrongpassword");
                    exit();
                }
                else if ($pswcheck == true)
                {
                    $sql = "SELECT * FROM users WHERE idUsers='$id';";
                    $result = mysqli_query($connection,$sql);

                    if(!mysqli_num_rows($result) > 0)
                    {
                        header("Location: ../Edit.html?error=sqlerror");
                        exit();
                    }
                    else
                    {   
                        $hashPsw = password_hash($newPass, PASSWORD_DEFAULT);
                        $sql = "UPDATE `users` SET `pswUsers` = '$hashPsw' WHERE `users`.`idUsers` = '$id'; ";
                        $result = mysqli_query($connection,$sql);
                       
                        header("Location: ../Edit.html?update=success");
                        exit();
                    }

                }
                else
                {
                    header("Location: ../ChangePass.html?error=wrongpassword");
                    exit();
                }
            }
            else
            {
                header("Location: ../Login.html?error=nouser");
                exit();
            }
        }
    }
}
else
{
    header("Location: ../Profile.html");
    exit();
}