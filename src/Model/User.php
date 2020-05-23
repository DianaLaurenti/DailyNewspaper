<?php
declare(strict_types=1);

namespace DailyNewspaper\Model;

class User extends DbClass
{
    private int $user_id;
    private string $username;
    private string $pwd;
    
    public function getId() : ?int
    {
        if(isset($this->user_id)){
            return $this->user_id;
        }
        else{
            return null;
        }
    }
    public function setId(int $user_id) : void 
    {
        $this->user_id = $user_id;
    }
    public function getUsername() : string
    {
        if(isset($this->username)){
            return $this->username;
        }
        else{
            return "";
        }
    }
    public function setUsername(string $username) : void 
    {
        $this->username = $username;
    }
    public function getPwd() : string
    {
        if(isset($this->pwd)){
            return $this->pwd;
        }
        else{
            return "";
        }
    }
    public function setPwd(string $pwd) : void 
    {
        $this->pwd = $pwd;
    }

    public static function getOne($username) {
        try {
            $stmt = self::$pdo->prepare("SELECT username, pwd FROM users WHERE username = :username;");
            $stmt->execute([':username' => $username]);
            return $stmt->fetchObject();
        } catch (PDOException $e) {
            var_dump($e);
            return null;
        }
    }

    public static function login($userArray) : bool
    {
        try {
            $stmt = self::$pdo->prepare("SELECT pwd FROM users WHERE username = :username;");
            $stmt->execute([':username' => $userArray['username']]);
            $hashSavedPwd = $stmt->fetchObject()->pwd;
            if(password_verify($userArray['pwd'], $hashSavedPwd ?? ''))
            {
                $_SESSION['user'] = $userArray['username'];
                return true;
            }
            if(isset($_SESSION['user'])){
                unset($_SESSION['user']);
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }
}