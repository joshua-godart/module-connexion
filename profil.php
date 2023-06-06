<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', 'admin');

if(isset($_GET['id']) && $_GET['id'] > 0){
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare("SELECT * FROM utilisateurs WHERE id = ?");
    $requser->execute(array($getid));
    $userinfos = $requser->fetch();

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profil de <?php echo $userinfos['login']?></title>
    </head>
    <body>
        <div>
            <h2>Profil de <?php echo $userinfos['login']?></h2>
            <?php
            if(isset($_SESSION['id']) && $userinfos['id'] == $_SESSION['id']){
            ?>
            <a href="#">Editer mon profil</a>
            <a href="deconnexion.php">Déconnexion</a>
            <?php
            }
            ?>
            <!-- <div>
                <a href="connexion.php">connexion</a>
            </div> -->
        </div>
    </body>
    </html>
<?php
}
?>