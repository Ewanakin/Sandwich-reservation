<?php
    $isSuccessEmpty = $isSuccessEmptyRole = $isSuccessEmptyEmail = $isSuccessEmptyPass = $isSuccessEmptyNom = $isSuccessEmptyPrenom  = "";
    if(empty($_POST['roleUser']))
    {
        $isSuccessEmptyRole = false;
        $errorRole = "Veuillez renseigner le rôle";
    }
    else
    {
        $isSuccessEmptyRole = true;
    }
    if(empty($_POST['email']))
    {
        $isSuccessEmptyEmail = false;
        $errorEmail = "Veuillez renseigner l'email";
    }
    else
    {
        $isSuccessEmptyEmail = true;
    }
    if(empty($_POST['pass']))
    {
        $isSuccessEmptyPass = false;
        $errorPass = "Veuillez renseigner le mot de passe";
    }
    else
    {
        $isSuccessEmptyPass = true;
    }
    if(empty($_POST['nomUser']))
    {
        $isSuccessEmptyNom = false;
        $errorNom = "Veuillez renseigner le nom de l'utilisateur";
    }
    else
    {
        $isSuccessEmptyNom = true;
    }
    if(empty($_POST['prenomUser']))
    {
        $isSuccessEmptyPrenom = false;
        $errorPrenom = "Veuillez renseigner le prenom de l'utilisateur";
    }
    else
    {
        $isSuccessEmptyPrenom = true;
    }

    if($isSuccessEmptyRole == true and $isSuccessEmptyEmail == true and $isSuccessEmptyNom == true and $isSuccessEmptyPass == true and $isSuccessEmptyPrenom == true)
    {
        $isSuccessEmpty = true;
    }
    else
    {
        $isSuccessEmpty = false;
    }
?>