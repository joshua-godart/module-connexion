<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="connexion.php" method="post">
        <label for="login">Login : </label>
        <input type="text" name="login" id="login" placeholder="Login">
        <label for="password">Mot de passe : </label>
        <input type="password" name="password" id="password" placeholder="Mot de passe">
        <input type="submit" value="Valider">
    </form>
    <div>
        <div>Pas encore de compte ?</div>
        <a href="inscription.php">inscription</a>
    </div>
</body>
</html>