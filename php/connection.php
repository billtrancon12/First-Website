<?php
    class DBConnection{
        protected $db;
        public function getConnection(){
            $db = new mysqli("localhost","liam","LiamNgoan123@4","Naruto");
            return $db;
        }
    }

    //Create an object class authorization    
    class authorization{
        public $username;
        public $password;
        public $email;
        public $admin;
        public $id;
    }

            
    //Create an object class character for each individual character
    class character {
        public $name;
        public $sex;
        public $birthdate;
        public $height;
        public $weight;
        public $blood_type;
        public $affiliation;
        public $image_link;
    }

    //Create an object class for a User Information object
    class UserInfos{
        public $id;
        public $name;
        public $birthdate;
        public $email;
        public $phone_number;
    }

    class TableSelection{
        protected $tb;
        public function getUsers($conn){            
            $sql = "SELECT * FROM authorization;";
            $result = $conn->query($sql);
        
            if($result->num_rows > 0){
                $users = array();
                while($row = $result->fetch_assoc()){
                    $user = new authorization();
                    $user->id       = $row["id"];
                    $user->username = $row["username"];
                    $user->password = $row["password"];
                    $user->email    = $row["email"];
                    $user->admin    = $row["admin"];
                    array_push($users,$user);
                }
            }
            return $users;
        }
        public function getCharacters($conn){
            $sql = "SELECT * FROM characters;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $characters = array();
                
                while($row = $result->fetch_assoc()) {
                    $character = new character();
                    $character->name = $row["name"];
                    $character->sex = $row["sex"];
                    $character->birthdate = $row["birthdate"];
                    $character->height = $row["height"];
                    $character->weight = $row["weight"];
                    $character->blood_type = $row["blood_type"];
                    $character->affiliation = $row["affiliation"];
                    $character->image_link = $row["image_link"];
            
                    array_push($characters,$character);
                }   
            }
            return $characters; 
        }

        public function getUserInfos($conn,$id){
            $sql = "SELECT * FROM UserInfo where id = $id;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $UserInfos = array();
                
                while($row = $result->fetch_assoc()) {
                    $infos = new UserInfos();
                    $infos->id = $row["id"];
                    $infos->name = $row["name"];
                    $infos->birthdate = $row["birthdate"];
                    $infos->email = $row["email"];
                    $infos->phone_number = $row["phone_number"];
                        
                    array_push($UserInfos,$infos);
                }
            }
            return $UserInfos;   
        }
    }
?>