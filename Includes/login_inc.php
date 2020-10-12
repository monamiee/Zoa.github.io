<?php

if(isset($_POST['login-submit']))
{
    require 'dbh_inc.html';

    $mailuid = $_POST['UserEmail'];
    $password = $_POST['UserPassword'];

    if(empty($mailuid) || empty($password))
    {
        header("Location: ../Login.html?error=emptyfields");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
        $stmt = mysqli_stmt_init($connection);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../Login.html?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result))
            {
                $pswcheck = password_verify($password, $row['pswUsers']);
                if($pswcheck == false)
                {
                    header("Location: ../Login.html?error=wrongpassword");
                    exit();
                }
                else if ($pswcheck == true)
                {
                    session_start();
                    $_SESSION['userID'] = $row['idUsers'];
                    $_SESSION['userUID'] = $row['uidUsers'];

                    header("Location: ../index.html?login=success");
                    exit();
                }
                else
                {
                    header("Location: ../Login.html?error=wrongpassword");
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
    header("Location: ../Login.html");
    exit();
}