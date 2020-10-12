<?php
    session_start();

    if(isset($_POST['icon_0']))
    {
        require 'dbh_inc.html';
    
        $id = $_SESSION['userID'];

        $sql = "SELECT profilenum FROM users WHERE idUsers='$id';";
        $result = mysqli_query($connection,$sql);

        if(!mysqli_num_rows($result) > 0)
        {
            header("Location: ../ChangeProfile.html?error=nouser");
            exit();
        }
        else
        {
            $update = "UPDATE users SET profilenum=0 WHERE idUsers = '$id';";
            $result = mysqli_query($connection,$update);
            header("Location: ../Profile.html?update=success");
            exit();
        }
    }
    else if(isset($_POST['icon_1']))
    {
        require 'dbh_inc.html';
    
        
        $id = $_SESSION['userID'];

        $sql = "SELECT profilenum FROM users WHERE idUsers='$id';";
        $result = mysqli_query($connection,$sql);

        if(!mysqli_num_rows($result) > 0)
        {
            header("Location: ../ChangeProfile.html?error=nouser");
            exit();
        }
        else
        {
            $update = "UPDATE users SET profilenum=1 WHERE idUsers = '$id';";
            $result = mysqli_query($connection,$update);
            header("Location: ../Profile.html?update=success");
            exit();
        }
    }
    else if(isset($_POST['icon_2']))
    {
        require 'dbh_inc.html';
    
        $id = $_SESSION['userID'];

        $sql = "SELECT profilenum FROM users WHERE idUsers='$id';";
        $result = mysqli_query($connection,$sql);

        if(!mysqli_num_rows($result) > 0)
        {
            header("Location: ../ChangeProfile.html?error=nouser");
            exit();
        }
        else
        {
            $update = "UPDATE users SET profilenum=2 WHERE idUsers = '$id';";
            $result = mysqli_query($connection,$update);
            header("Location: ../Profile.html?update=success");
            exit();
        }
    }
    else if(isset($_POST['icon_3']))
    {
        require 'dbh_inc.html';
    
        $id = $_SESSION['userID'];

        $sql = "SELECT profilenum FROM users WHERE idUsers='$id';";
        $result = mysqli_query($connection,$sql);

        if(!mysqli_num_rows($result) > 0)
        {
            header("Location: ../ChangeProfile.html?error=nouser");
            exit();
        }
        else
        {
            $update = "UPDATE users SET profilenum=3 WHERE idUsers = '$id';";
            $result = mysqli_query($connection,$update);
            header("Location: ../Profile.html?update=success");
            exit();
        }
    }
    else if(isset($_POST['icon_4']))
    {
        require 'dbh_inc.html';
    
        $id = $_SESSION['userID'];

        $sql = "SELECT profilenum FROM users WHERE idUsers='$id';";
        $result = mysqli_query($connection,$sql);

        if(!mysqli_num_rows($result) > 0)
        {
            header("Location: ../ChangeProfile.html?error=nouser");
            exit();
        }
        else
        {
            $update = "UPDATE users SET profilenum=4 WHERE idUsers = '$id';";
            $result = mysqli_query($connection,$update);
            header("Location: ../Profile.html?update=success");
            exit();
        }
    }
    else
    {
        header("Location: ../Profile.html");
        exit();
    }