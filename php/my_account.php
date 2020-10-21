<?php
    session_start();
?>
<?php
    include "connection.php";
    $db = new DBConnection();
    $conn = $db->getConnection();

    $tb = new TableSelection();
    $UserInfo = $tb->getUserInfos($conn,$_SESSION["User ID"])
?>
<?php
    include "user.php";
    $user = createUser($UserInfo);
    $_SESSION["User Information"] = serialize($user);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main_content.css">
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="stylesheet" href="../css/global_footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/display_user.css">
    <title>Document</title>
</head>
<body>
    <header class="Navigation_menu">
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
                <button type="submit" class="search_icon" ><i class="fa fa-search"></i></button>
                <input type="text" name="search" placeholder="Searching" id="search">
            </form>
        </div>
    </header>
    <div id="MyContent">
        <div id='main_content'style='text-align: left; height: 803px;'>
        </div>
    </div>  
    <footer class="wds-global-footer">
        <a class="wds-global-footer-naruto_world" href="http://localhost:3000/FirstProject/html/index.html" title="Naruto World" data-tracking-label="logo">Naruto World</a>
        <ul class="wds-global-footer-naruto_world_links" style="list-style-type: none;"></ul>
    </footer>
    <script src='../script/index.js'></script>
    <script src="../script/global_footer.js"></script>
    <script src="../script/users.js"></script>
    <script src="../script/user.js"></script>
    <script src="../script/display_user.js"></script>
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
        let user = new User()
        user.name = "<?php echo $user->name ?>"
        user.birthdate = "<?php echo $user->birthdate ?>"
        user.email = "<?php echo $user->email ?>"
        user.phone_number = "<?php echo $user->phone_number ?>"
    </script>
    <script>        
        createDisplay(user)
    </script> 
</body>
</html>