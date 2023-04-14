<?php 
$databaseHost = 'localhost';
$databaseName = 'agridigital';
$databaseUser = 'root';
$databasePass = '';
$varCon = new mysqli($databaseHost, $databaseUser, $databasePass, $databaseName);

session_start();

if ($_SESSION['status'] == 'logged') {
    # code...
    print_r($_SESSION);
    echo $_SESSION['id'];
} else {
    print_r($_SESSION);
    echo "Utilisateur non connecte, Nous vous redirigeons vers  pour vous permettre <a href=\"index.php\">la page de connexion</a> de vous authentifier";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="In this website you can, borrow, read books and also review books you read">
    <meta name="author" content="Insipide**2.0">
	<link rel="stylesheet" href="assets/css/devoir.css">
    <title></title>
</head>

<body>
	<main class="mt-body">
        <form class="bg-or-wh" method="post">
            <div>
                <h3>Chnager son nom d'utilisateur</h3>
            </div>
            <div class="">
                <label class="form-label"  for="username">Nom d'utilisateur :</label>
                <input type="text" class="form-input" name="username" id="username">
            </div>
            <div>
                <h3>Chnager son mot de passe</h3>
            </div>
            <div class="">
                <label class="form-label"  for="password">Mot de passe :</label>
                <input type="password" class="form-input" name="password" id="password">
            </div>
            <div class="center-content mt-input">
                <input type="submit" class="btn-submit fw-bolder" value="Changer mes informations"> 
            </div>
        </form>
    </main>
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['username'], $_POST['password'])) {
                if(!empty($_POST['username']) && !empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $username = $_POST['username'];
                    $id = $_SESSION['id'];
                    $varCon->query("UPDATE signin SET username='$username', password='$password' WHERE id='$id'");
                } elseif (!empty($_POST['username'])) {
                    $username = $_POST['username'];
                    $id = $_SESSION['id'];
                    $varCon->query("UPDATE signin SET username='$username' WHERE id='$id'");
                } elseif (!empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $id = $_SESSION['id'];
                    $varCon->query("UPDATE signin SET password='$password' WHERE id='$id'");
                } else {
                    echo "Vous n'aviez rempli aucune valeur dans le formulaire de modification soumis";
                }
            }
        }
    ?>
</body>

</html>