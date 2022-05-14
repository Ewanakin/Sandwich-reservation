<?php
require('./class/connexion.php');

function registerUser($firstname, $lastname, $email, $password): bool
{
    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        return false;
    }

    $userToTest = (new db())->insert("INSERT INTO `utilisateur` (role_user, email_user, password_user, nom_user, prenom_user, active_user) VALUES ('b', ?,?,?,?, 1)" , [$email,password_hash($password, PASSWORD_ARGON2I),$lastname,$firstname]);

    return true;
}
