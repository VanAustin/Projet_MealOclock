<?php

namespace Community\Model;

use Community\Framework\BaseModel;

class UserModel extends BaseModel
{
    public function __construct()
    {
        parent::__construct('users');
    }

    public function validData($data)
    {
        $errors = [];

        // first_name pas vide,
        if(empty($data['firstName']))
            $errors['firstName'] = 'Veuillez saisir votre prénom';

        // last_name pas vide,
        if(empty($data['lastName']))
            $errors['lastName'] = 'Veuillez saisir votre nom';

        // email valide,
        if(empty($data['email']))
            $errors['email'] = 'Veuillez saisir votre email';
        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Email invalide';

        // password qui fait plus de 8 caractères)
        if(strlen($data['password']) < 8)
            $errors['password'] = 'Mot de passe trop court';

        return $errors;
    }

    public function validUpdate($data)
    {
        $errors = [];

        // first_name pas vide,
        if(empty($data['first_name']))
            $errors['first_name'] = 'Votre prénom ne peut pas être vide';

        // last_name pas vide,
        if(empty($data['last_name']))
            $errors['last_name'] = 'Votre nom ne peut pas être vide';

        // email valide,
        if(empty($data['email']))
            $errors['email'] = 'Veuillez saisir un email valide';
        elseif(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Email invalide';

        return $errors;
    }

    public function register($data)
    {
        $sql = 'INSERT into users (first_name, last_name, email, password)
                VALUES (:first_name, :last_name, :email, :password)';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':first_name', $data['firstName']);
        $sth->bindValue(':last_name', $data['lastName']);
        $sth->bindValue(':email', $data['email']);
        $sth->bindValue(':password', password_hash($data['password'], PASSWORD_DEFAULT));
        $res = $sth->execute();
        return ($res) ? $this->db->lastInsertId() : false;
    }

    /**
     * Renvoie les données d'un utilisateur
     * à partir de son email
     */
    public function findByEmail($email)
    {
        $sql = 'SELECT * FROM users
                WHERE email LIKE :email
                LIMIT 1';

        $sth = $this->db->prepare($sql);
        $sth->bindValue(':email', $email);
        $sth->execute();
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    /**
    * A partir d'un username/email et mot de passe (en clair)
    * renvoie les données de l'utilisateur s'ils correspondent
    * false sinon
    * @param string $email
    * @param string $password
    */
    public function auth($email, $password)
    {
        // chercher si il existe un user avec cet email
        $user = $this->findByEmail($email);

        // si il existe,
        if($user)
        {
            // comparer le mot de passe de l'user trouvé avec le mot de passe saisi
            if(password_verify($password, $user['password']))
            {
                $this->setUser($user);
                // renvoie les données de l'utilisateur
                return true;
            }
        }
        return false;
    }

    public function setUser($user)
    {
        // supprimer les données non nécessaires ou confidentielles de l'utilisateur
        unset($user['password']);
        // stocker les données de l'user dans la session
        $_SESSION['user'] = $user;
    }

    public function getUser()
    {
        if(isset($_SESSION['user']))
            return $_SESSION['user'];
        else return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }

    public function insertTokenToUser($id, $token)
    {
        $sql = 'UPDATE users SET token_lost_pass = :token WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':token', $token);
        $query->bindValue(':id', intval($id), \PDO::PARAM_INT);
        return $res = $query->execute();
    }

    public function findByIdAndToken($id, $token)
    {
        $sql = 'SELECT * FROM users
                WHERE id = :id
                AND token_lost_pass = :token
                LIMIT 1';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id', intval($id), \PDO::PARAM_INT);
        $sth->bindValue(':token', $token);
        $sth->execute();
        return $res = $sth->fetch(\PDO::FETCH_ASSOC);
    }

    public function validPassword($password)
    {
        $errors = [];

        // password qui fait plus de 8 caractères)
        if(strlen($password) < 8)
            $errors['password'] = 'Mot de passe trop court';

        return $errors;
    }

    public function updatePassAndClearToken($password, $id)
    {
        $sql = 'UPDATE users SET token_lost_pass = "", password = :password WHERE id = :id';
        $sth = $this->db->prepare($sql);
        $sth->bindValue(':id', intval($id), \PDO::PARAM_INT);
        $sth->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
        return $res = $sth->execute();
    }
}

 ?>
