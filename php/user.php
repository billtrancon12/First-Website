<?php
    class User{
        public $name;
        public $birthdate;
        public $email;
        public $phone_number;
    }

    function createUser($user){
        $userObj = new User();
        $userObj->name = $user[0]->name;
        $userObj->birthdate = $user[0]->birthdate;
        $userObj->email = $user[0]->email;
        $userObj->phone_number = $user[0]->phone_number;
        return $userObj;
    }
?>