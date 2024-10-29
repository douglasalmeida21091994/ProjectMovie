<?php

require_once "globals.php";
require_once "db.php";
require_once 'models/user.php';
require_once 'models/Message.php';
require_once 'dao/UserDAO.php';

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

// Verifica o tipo de form

$type = filter_input(INPUT_POST, "type");

// Verificação do tipo de form

if ($type === "register") {

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Verificação de dados mínimo

    if ($name && $lastname && $email && $password) {

        // Verificar se já existe e-mail cadastrado
        if ($userDao->findByEmail($email) === false) {

            $user = new User();

            // Criação de token e senha
            $userToken = $user->generateToken();
            $finalPassword = $user->generatePassword($password);

            $user->name = $name;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->password = $finalPassword;
            $user->token = $userToken;

            $auth = true;

            $userDao->create($user, $auth);

        } else {

            $message->setMessage("O E-mail já está cadastrado. Por favor, digite um novo.", "error", "back");

        }

        if (strlen($password) >= 8) {
            // true = senha com mais de 8 dígitos

        } else {

            $message->setMessage("A senha deve ter no mínimo 8 dígitos.", "error", "back");

        }

        if ($password === $confirmpassword) {
            // true = senha e confirm são iguais

        } else {

            // Envia uma msg informando que as senhas são diferentes
            $message->setMessage("As senhas não são iguais.", "error", "back");

        }

    } else {

        // Envia uma msg de erro de dados faltantes
        $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
    }

} elseif ($type === "login") {

}