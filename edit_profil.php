<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'admin');

if(isset($_SESSION['id'])){
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    if(isset($_POST['new_login']) && !empty($_POST['new_login']) && $_POST['new_login'] != $user['login']){
        $new_login = htmlspecialchars($_POST['new_login']);
        $checkLogin = $bdd->prepare("SELECT id FROM utilisateurs WHERE login = ?");
        $checkLogin->execute(array($new_login));
        $loginExists = $checkLogin->fetch();
        if($loginExists){
            $message = "Le login est déjà utilisé !";
        }else{
            $insertlogin = $bdd->prepare("UPDATE utilisateurs SET login = ? WHERE id = ?");
            $insertlogin->execute(array($new_login, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        }
    }
    if(isset($_POST['new_prenom']) && !empty($_POST['new_prenom']) && $_POST['new_prenom'] != $user['prenom']){
        $new_prenom = htmlspecialchars($_POST['new_prenom']);
        $insertprenom = $bdd->prepare("UPDATE utilisateurs SET prenom = ? WHERE id = ?");
        $insertprenom->execute(array($new_prenom, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['new_nom']) && !empty($_POST['new_nom']) && $_POST['new_nom'] != $user['nom']){
        $new_nom = htmlspecialchars($_POST['new_nom']);
        $insertnom = $bdd->prepare("UPDATE utilisateurs SET nom = ? WHERE id = ?");
        $insertnom->execute(array($new_nom, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    if(isset($_POST['new_password']) && !empty($_POST['new_password']) && isset($_POST['new_password_conf']) && !empty($_POST['new_password_conf'])){
        $password1 = sha1($_POST['new_password']);
        $password2 = sha1($_POST['new_password_conf']);
        if($password1 == $password2){
            $insertpassword = $bdd->prepare("UPDATE utilisateurs SET password = ? WHERE id = ?");
            $insertpassword->execute(array($password1, $_SESSION['id']));
            header('Location: profil.php?id='.$_SESSION['id']);
        }else{
            $message = "Les mots de passes ne correspondent pas !";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer profil</title>
</head>
<body>
    <div>
        <h2>Edition de mon profil</h2>
        <form action="" method="post">
        <table>
            <tr>
                <td>
                    <label for="new_login">Nouveau Login : </label>
                </td>
                <td>
                    <input type="text" name="new_login" id="new_login" placeholder="Nouveau login" value="<?php echo $user['login'];?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="new_prenom">Nouveau Prénom : </label>
                </td>
                <td>
                    <input type="text" name="new_prenom" id="new_prenom" placeholder="Nouveau Prénom" value="<?php echo $user['prenom'];?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="new_nom">Nouveau Nom : </label>
                </td>
                <td>
                    <input type="text" name="new_nom" id="new_nom" placeholder="Nouveau Nom" value="<?php echo $user['nom'];?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="new_password">Nouveau Mot de passe : </label>
                </td>
                <td>
                    <input type="password" name="new_password" id="new_password" placeholder="Nouveau Mot de passe">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="new_password_conf">Confirmer mot de passe : </label>
                </td>
                <td>
                    <input type="password" name="new_password_conf" id="new_password_conf" placeholder="Confirme mot de passe">
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <input type="submit" name="form_inscription" value="Valider">
                </td>
            </tr>
        </table>
    </form>
    <?php
    if(isset($message)){
        echo $message;
    }
    ?>
    </div>
</body>
</html>
<?php
}else{
    header("Location: connexion.php");
}
?>
