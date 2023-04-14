<?php 
$databaseHost = 'localhost';
$databaseName = 'agridigital';
$databaseUser = 'root';
$databasePass = '';
$varCon = new mysqli($databaseHost, $databaseUser, $databasePass, $databaseName);

session_start();

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
            <div class="">
                <label class="form-label"  for="username">Nom d'utilisateur :</label>
                <input type="text" class="form-input" name="username" id="username">
            </div>
            <div class="">
                <label class="form-label"  for="password">Mot de passe :</label>
                <input type="password" class="form-input" name="password" id="password">
            </div>
            <div class="center-content mt-input">
                <input type="submit" class="btn-submit fw-bolder" value="Log in"> 
            </div>
        </form>
    </main>
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['username'], $_POST['password'])) {
                if(!empty($_POST['username']) && !empty($_POST['password'])) {
                    $username = $_POST['username'];
                    $requete = $varCon->query("SELECT id, username, password FROM signin where username='$username'");
                    $exist = $requete->num_rows;
                    if($exist > 0){
                        $row =  $requete->fetch_assoc();
                        print_r($row);
                        if ($_POST['password'] == $row['password']) {
                            $_SESSION['status'] = 'logged';
                            $_SESSION['id'] = $row['id'];
                            header("Location: menus.php");
                        }
                        else 
                        {
                            echo 'Le mot de passe n\'est pas celui de cet utilisateur';
                        }
                    }
                    else 
                    {
                        echo 'Cet utilisateur n\'est pas enregistre dans notre base de donnes.';
                    }
                }
            }
        }
    ?>
</body>

</html>