<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'admin');

if(isset($_POST['form_connexion'])){
    $login_connect = htmlspecialchars($_POST['login_connect']);
    $password_connect = sha1($_POST['password_connect']);
    if(!empty($login_connect) && !empty($password_connect)){
        $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $requser->execute(array($login_connect, $password_connect));
        $userexist = $requser->rowCount();
        if($userexist == 1){
            if($login_connect === 'admin' && $password_connect === sha1('admin')){
                header("Location: admin.php");
                exit();
            }else{
            $userinfos = $requser->fetch();
            $_SESSION['id'] = $userinfos['id'];
            $_SESSION['login'] = $userinfos['login'];
            header("Location:profil.php?id=".$_SESSION['id']);
            }
        }else{
            $message = "Mauvais Login ou Mot de passe";
        }
    }else{
        $message = "tous les champs doivent être remplis !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div>
        <h2>Connexion</h2>
        <form action="" method="post">
            <table>
                <tr>
                    <td>
                        <label for="login">Login : </label>
                    </td>
                    <td>
                        <input type="text" name="login_connect" id="login" placeholder="Login">
                    </td>
                </tr>
                <tr>
                <tr>
                    <td>
                        <label for="password">Mot de passe : </label>
                    </td>
                    <td>
                        <input type="password" name="password_connect" id="password" placeholder="Mot de passe">
                    </td>
                </tr>
                <tr>
                    <td>
                        <div>Pas encore de compte ?</div><a href="inscription.php">inscription</a>
                    </td>
                    <td>
                        <input type="submit" name="form_connexion" value="Valider">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($message)){
            echo$message;
        }
        ?>
        <!-- <div>
            <a href="connexion.php">connexion</a>
        </div> -->
    </div>
</body>
</html>