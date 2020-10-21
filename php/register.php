<?php
    include "connection.php";
    $db = new DBConnection();
    $conn = $db->getConnection();
    
    $tb = new TableSelection();
    $users = $tb->getUsers($conn);
?>
<?php
    $id = $users[count($users)-1]->id +1;
    function inputDatabase($conn,$id,$username,$password,$email){
        $input = 'INSERT INTO authorization (id,username,password,email,admin) values ("'.$id.'","'.$username.'","'.$password.'","'.$email.'", false);';
        $conn->query($input);
        $inputUserInfo = 'INSERT INTO UserInfo(id,name,birthdate,email,phone_number) values ("'.$id.'","null","2002-01-01","'.$email.'","null");';
        echo "<script>console.log('$inputUserInfo')</script>";
        $conn->query($inputUserInfo);
    }
?> 

<?php
    include "test_input.php";
    
    $username = $email = $password ="";
    $usernameErr = $emailErr = $passwordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["username"])) {
          $usernameErr = "Username is required";
        } else {
          $username = test_input($_POST["username"]);
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
            $usernameErr = "Only letters and white space allowed";
          }
        }
      
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";
        } else {
          $email = test_input($_POST["email"]);
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
        }

        if (empty($_POST["password"])) {
          $passwordErr = "Password is required";
        } else {
          $password = test_input($_POST["password"]);
        }
    }

    if($username!="" && $password!="" && $email!="" && $emailErr==""){
        inputDatabase($conn,$id,$username,$password,$email);
        echo "<script type='text/javascript'>alert('You have successfully registered!');</script>";
        echo "<script> window.location.href='http://localhost:3000/FirstProject/php/register.php'</script>";           
    }
    else if($usernameErr!="" && $passwordErr!="" && $emailErr!=""){
        if($usernameErr!=""){echo "<script type='text/javascript'>alert('$usernameErr');</script>";}
        if($passwordErr!=""){echo "<script type='text/javascript'>alert('$passwordErr');</script>";}     
        if($emailErr!=""){echo "<script type='text/javascript'>alert('$emailErr');</script>";}
        echo "<script> window.location.href='http://localhost:3000/FirstProject/php/register.php'</script>";          
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/authorization_page_register.css">
    <link rel="stylesheet" href="../css/homepage.css">
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
    <div class="wds-global-authorization-page" id="register_page">
        <div class="wds-global-authorization-page_header">
            <p id="authorization_header"> Join Naruto World Today!</p>
            <div class="account_register">
                <p id="having_account">Already have an account?</p>
                <a href="http://localhost:3000/FirstProject/php/sign_in.php" class="register_link">Sign in here!</a>
            </div>
        </div>
        <div class="wds-global-authorization-page_register" >
            <div class="wds-global-authorization-page_register-left">
                <ul class="list-of-ways-to-register"></ul>
            </div>
            <div class="wds-global-authorization-page_register-right">
                <p class="wds-global-authorization-page_register-right-header">Register with Email</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="register_input" method="POST">
                    <input type="text" class="register_input email" placeholder="Email" id="email" name="email">
                    <input type="text" class="register_input username" placeholder="Username" id="username" name="username" maxlength="16">
                    <input type="password" class="register_input password" placeholder="Password" id="password" name="password" minlength="8" require maxlength="16">
                    <input type="submit" class="register_input submit" value="Register" id="register">
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
    <script src="../script/users.js"></script>
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
        createUserDropdown(localStorage.getItem("Login"))
    </script>
</body>
</html>