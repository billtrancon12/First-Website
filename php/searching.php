<?php
    include "connection.php";
    $db = new DBConnection();
    $conn = $db->getConnection();
    
    $tb = new TableSelection();
    $characters = $tb->getCharacters($conn);
    
    $conn->close();?>
<?php
    //Get the previous page url
    $url = $_SERVER['HTTP_REFERER'];

    $input = $_POST["search"];
    
    //If the input equals to 0, return back to the previous page
    if(strlen($input)==0){
        echo "<script language='javascript'> alert('Cannot leave the field empty!');window.location.href='".$url."'</script>";
    }

    //Create a function filterName that returns back the name that satisfies the input 
    function searchByName($input,$array,$index){
        $var = $array[$index]->name;
        $varSplit = str_split(strtolower($var));
        $inputSplit = str_split(strtolower($input));
        sort($varSplit);
        sort($inputSplit);

        $checked =0;
        for($i=0;$i<count($varSplit);$i++){
            for($k=0;$k<count($inputSplit);$k++){
                if(strcasecmp($varSplit[$i],$inputSplit[$checked])==0){                        
                    $checked++;

                    if($checked===count($inputSplit)){
                            return $array[$index];
                    }
                       break;
                }
            }   
        }
        return null;
    }

    //Create a function filter that filter the array with the tags (name,birthdate,clan,etc...)
    function search($input,$array){
        $result = array();
        for($index=0;$index<count($array);$index++){
            if(!(is_null(searchByName($input,$array,$index)))){
                array_push($result,searchByName($input,$array,$index));
            }
        }
        return $result;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <script src="../script/search.js"></script>
    <script>
        let characters = <?php echo json_encode(search($_POST["search"],$characters)) ?>;
        localStorage.setItem("Item search",JSON.stringify(characters))
    </script>
    <script>
        localStorage.setItem("page_number-search",1)
    </script>
    <script language="javascript">window.location.href ="http://localhost:3000/FirstProject/html/search.html"</script> 
</body>
</html>