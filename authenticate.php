<?php


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    /* Logique du code ici */
    session_start();
    include('users.php');

    if ( isset($_POST['login']) && isset($_POST['password']) )
    {
        $login = htmlentities($_POST['login']);
        $password = htmlentities($_POST['password']);

        foreach($users as $user => $pwd) {
            if(($user == $login) && ($pwd == $password)){
                
                $_SESSION['login']=$login;
                /* Connexion réussie, on redirige vers le message de bienvenue */
                header('Location: welcome.php');
                exit;
                /* Remarque : L'utilisation du exit n'est pas très propre, il serait mieux de trouver 
                une autre solution plutot que le foreach */ 
            }else if(($user == $login) && ($pwd != $password)){
                $_SESSION['message']='Mot de passe incorrect';
                /* On redirige vers signin.php si ce n'est pas les bons identifiants */
               header('Location: signin.php');
               exit;
            }
        }
        $_SESSION['message']='identifiant incorrect';
        header('Location: signin.php');
    }else{
        /* On redirige vers signin.php si il manque un paramètre */
        header('Location: signin.php');
    }
}else{
    /* On redirige vers signin.php si ce n'est pas la méthode POST */
    header('Location: signin.php');
}

exit;
