<?php
require('./class/connexion.php');

function authenticateUser($email, $password): bool
{
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
    }

    $userToTest = (new db())->fetch('SELECT * FROM utilisateur WHERE email_user = ?', [$email]);

    if (password_verify($password, $userToTest['password_user'])){
        $_SESSION['user'] = [
            'id' => $userToTest['id_user'],
            'email' => $userToTest['email_user'],
            'firstname' => $userToTest['prenom_user'],
            'lastname' => $userToTest['nom_user'],
            'role_user' => $userToTest['role_user'],
            'active_user' => $userToTest['active_user']
        ];
        return true;
    } else {
        return false;
    }




}
