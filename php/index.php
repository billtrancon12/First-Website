<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "connection.php";
    $db = new DBConnection();
    $conn = $db->getConnection();
    
    $tb = new TableSelection();
    $characters = $tb->getCharacters($conn);
    
    $conn->close();
?>
    <script>
        localStorage.setItem("Retrieve data",JSON.stringify(<?php echo json_encode($characters);?>))
    </script>
</body>
</html>