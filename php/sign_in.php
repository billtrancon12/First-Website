<?php
    session_start();
?>
<?php
    include "connection.php";
    
    $db = new DBConnection();
    $conn = $db->getConnection();

    $tb = new TableSelection();
    $users = $tb->getUsers($conn);
?>
<?php

?>
<?php
    include "test_input.php";

    $username = $password ="";
    $usernameErr = $passwordErr ="";

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if (empty($_POST["username"])) {
            $usernameErr = "Missing username!";
        } 
        else {
            $username = test_input($_POST["username"]);
        }
  
        if (empty($_POST["password"])) {
            $passwordErr = "Missing password!";
        } 
        else {
            $password = test_input($_POST["password"]);
        }
    }

    $status = fn($username,$password,$user) => $username==$user->username && $password==$user->password;
    $id = fn($username,$password,$user) => $user->id;
    $login = false;
    foreach($users as $user){
        $login = $status($username,$password,$user);
        if($login == true){
            $userID = $id($username,$password,$user);
            $_SESSION["User ID"] = $userID;
            echo "<script>localStorage.setItem('Login','$login')</script>";
            echo "<script>alert('You successfully login!')</script>";
            echo "<script>window.location.href='http://localhost:3000/FirstProject/html/success_login.html'</script>";
            break;
        }
    }

    if($usernameErr!="" && $passwordErr!=""){
        echo "<script>alert('$usernameErr')</script>";
        echo "<script>alert('$passwordErr')</script>";
        echo "<script>window.location.href='http://localhost:3000/FirstProject/php/sign_in.php'</script>";
    }
    else if($login==false && !empty($username) && !empty($password)){
        echo "<script>alert('Sorry, please try again!')</script>";
        echo "<script>window.location.href='http://localhost:3000/FirstProject/php/sign_in.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="stylesheet" href="../css/authorization_page_sign-in.css">
    <link rel="stylesheet" href="../css/global_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<body>
    <div id="MyContent">
        <div class="Navigation_menu">
            <nav class='Homepage'></nav>
            <div id="user_menu">
                <div class="arrow-cursor-pointer">
                    <button class="arrow"><i class="arrow down" id="arrow"></i></span>
                    <div class="dropdown_content">
                        <ul class="list-of-dropdown_contents"></ul>
                    </div>
                </div>
                <button class="user_icon"><i class="fa fa-user"></i></button>
            </div>
            <div id="searching-category">
                <form action="../php/searching.php" method="POST">
                    <button type="submit" class="search_icon"><i class="fa fa-search"></i></button>
                    <input type="text" name="search" placeholder="Searching" id="search">
                </form>
            </div>
        </div>
    </div>
    <div class="wds-global-authorization-page" id="sign-in_page">
        <div class="wds-global-authorization-page_header">
            <p id="authorization_header"> Welcome back to Naruto World!</p>
            <div class="account_register">
                <p id="not-having_account">Don't have an account?</p>
                <a href="http://localhost:3000/FirstProject/php/register.php" class="sign-in_link">Register here!</a>
            </div>
        </div>
        <div class="wds-global-authorization-page_sign-in">
            <div class="wds-global-authorization-page_sign-in-left">
                <ul class="list-of-ways-to-sign-in"></ul>
            </div>
            <div class="wds-global-authorization-page_sign-in-right">
                <p class="wds-global-authorization-page_sign-in-right-header">Sign with Username</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="sign-in_input" method="POST">
                    <input type="text" class="sign-in_input username" placeholder="Username" id="username" name="username">
                    <input type="password" class="sign-in_input password" placeholder="Password" id="password" name="password">
                    <input type="submit" class="sign-in_input submit" value="Sign in" id="sign-in">
                </form>
            </div>
        </div>
    </div>
    <footer class="wds-global-footer">
        <a class="wds-global-footer-naruto_world" href="http://localhost:3000/FirstProject/html/index.html" title="Naruto World" data-tracking-label="logo">Naruto World</a>
        <ul class="wds-global-footer-naruto_world_links" style="list-style-type: none;"></ul>
    </footer>
    <script src='../script/index.js'></script>
    <script src="../script/global_footer.js"></script>
    <script src="../script/users.js">

    </script>
    <script>
        createHomePageMenu()
    </script>
    <script>
        createTitle()
        createNarutoWorld()
        createContent("About",1)
        createContent("Support",2)
        createContent("Term Of Use",3)
    </script>
    <script>
        createUserDropdown(localStorage.getItem('Login'))
    </script>
</body>
</html>