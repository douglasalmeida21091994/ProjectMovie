<?php

require_once 'models/user.php';
require_once 'models/Message.php';

class UserDAO implements UserDAOInterface
{

    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }

    public function buildUser($data)
    {
        $user = new User();

        $user->id = $data["id"];
        $user->name = $data["name"];
        $user->lastname = $data["lastname"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->image = $data["image"];
        $user->bio = $data["bio"];
        $user->token = $data["token"];

        return $user;
    }

    public function create(User $user, $authUser = false)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (name, lastname, email, password, token) VALUES (:name, :lastname, :email, :password, :token)");

        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastname", $user->lastname);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":token", $user->token);

        $stmt->execute();

        if ($authUser) {
            $this->setTokenToSession($user->token);
        }
    }

    public function update(User $user)
    {
        // Código para atualizar o usuário
    }

    public function verifyToken($protected = false)
    {
        if (!empty($_SESSION["token"])) {
            $token = $_SESSION["token"];
            $user = $this->findByToken(token: $token);

            if ($user) {
                return $user;
            } else if ($protected){
                return false;
            }
        } else {
            return false;
        }
    }

    public function setTokenToSession($token, $redirect = true)
    {
        $_SESSION["token"] = $token;

        if ($redirect) {
            $this->message->setMessage("Seja Bem-Vindo!", "success", "editprofile.php");
        }
    }

    public function authenticateUser($email, $password)
    {
        // Código para autenticar o usuário
    }

    public function findByEmail($email)
    {
        if ($email != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->buildUser($data);
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function findByToken($token)
    {
        if ($token != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            $stmt->bindParam(":token", $token);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                $user = $this->buildUser($data);
                return $user;
            } else {
                $this->message->setMessage("Faça a autenticação para acessar a página!", "error", "index.php");
                return false;
            }
        } else {
            return false;
        }
    }

    public function destroyToken()
    {
        $_SESSION["token"] = "";
        $this->message->setMessage("Logout realizado com sucesso!", "success", "index.php");
    }

    public function findById($id)
    {
        // Código para buscar usuário por ID
    }

    public function changePassword(User $user)
    {
        // Código para alterar a senha do usuário
    }
}
