<?php

class user {
    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $image;
    public $token;
}

interface UserDAOInterface {

    public function buildUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user);    
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function AuthenticateUser($email, $password);
    public function findByEmail($email);
    public function findByToken($token);
    public function findById($id);
    public function changePassword(User $user);
    
}