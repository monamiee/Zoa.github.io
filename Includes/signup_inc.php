<?php

if(isset($_POST['signup-submit']))
{
    require 'dbh_inc.html';

    $username = $_POST['UserName'];
    $email = $_POST['UserEmail'];
    $password = $_POST['UserPassword'];
    $re_password = $_POST['UserRe-Password'];

    //User Error Handler

    if(empty($username) || empty($email) || empty($password) || empty($re_password))
    {
        header("Location: ../signup.html?error=emptyfields&UserName=".$username."&UserEmail=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) 
    {
        header("Location: ../signup.html?error=invalidmailuid");
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../signup.html?error=invalidUserEmail&UserName=".$username);
        exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.html?error=invalidUserName&UserEmail=".$email);
        exit();
    }
    else if ($password !== $re_password)
    {
        header("Location: ../signup.html?error=passwordcheck&UserName=".$username."&UserEmail=".$email);
        exit();
    }
    else
    {
        $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
        $stmt = mysqli_stmt_init($connection);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../signup.html?error=sqlerror");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            $resultCheck = mysqli_stmt_num_rows($stmt);

            if($resultCheck > 0)
            {
                header("Location: ../signup.html?error=usertaken&UserEmail=".$email);
                exit();
            }
            else
            {
                $sql = "INSERT INTO users (profilenum,uidUsers,emailUsers,pswUsers) VALUES (0,?,?,?)";
                $stmt = mysqli_stmt_init($connection);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../signup.html?error=sqlerror");
                    exit();
                }
                else
                {
                    $hashPsw = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashPsw);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.html?signup=success");
                    exit();
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($connection);
}
else
{
    header("Location: ../signup.html");
    exit();
}