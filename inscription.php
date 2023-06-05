<?php
$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'admin');

if(isset($_POST['form_inscription'])){
    if(!empty($_POST['login']) && !empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['password']) && !empty($_POST['password_conf'])){
        $login = htmlspecialchars($_POST['login']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $nom = htmlspecialchars($_POST['nom']);
        $password = sha1($_POST['password']);
        $password_conf = sha1($_POST['password_conf']);
        $loginlenght = strlen('login');
        if($loginlenght <= 255){
            if($password == $password_conf){
                $insertuser = $bdd->prepare("INSERT INTO utilisateurs(login, prenom, nom, password) VALUES(?,?,?,?)" );
                $insertuser->execute(array($login, $prenom, $nom, $password));
                $erreur = "Votre compte a bien été créé !";
            }else{
                $erreur = "Les mots de passe ne correspondent pas !";
            }
        }else{
            $erreur = "Le login ne paut pas contenire plus de 255 caractères !";
        }
    }else{
        $erreur = "Tout les champs doivent être rempli !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="inscription.php" method="post">
        <table>
            <tr>
                <td>
                    <label for="login">Login : </label>
                </td>
                <td>
                    <input type="text" name="login" id="login" placeholder="Login">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prenom">Prénom : </label>
                </td>
                <td>
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nom">Nom : </label>
                </td>
                <td>
                    <input type="text" name="nom" id="nom" placeholder="Nom">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password">Mot de passe : </label>
                </td>
                <td>
                    <input type="password" name="password" id="password" placeholder="Mot de passe">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="password_conf">Confirmer mot de passe : </label>
                </td>
                <td>
                    <input type="password" name="password_conf" id="password_conf" placeholder="Confirmer mot de passe">
                </td>
            </tr>
            <tr>
                <td>
                    <div>Déjà inscrit ?</div><a href="connexion.php">connexion</a>
                </td>
                <td>
                    <input type="submit" name="form_inscription" value="Valider">
                </td>
            </tr>
        </table>
    </form>
    <?php
    if(isset($erreur)){
        echo$erreur;
    }
    ?>
    <!-- <div>
        <a href="connexion.php">connexion</a>
    </div> -->
</body>
</html>