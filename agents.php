<?php 
$databaseHost = 'localhost';
$databaseName = 'agridigital';
$databaseUser = 'root';
$databasePass = '';
$varCon = new mysqli($databaseHost, $databaseUser, $databasePass, $databaseName);

session_start();


if (isset($_POST['update'])) {
    # code...
    if(isset($_POST['nomagentu'], $_POST['prenomagentu'], $_POST['datenaisu'], $_POST['datepsceu'])) {
        if(!empty($_POST['nomagentu']) && !empty($_POST['prenomagentu']) && !empty($_POST['datenaisu']) && !empty($_POST['datepsceu'])) {
            $nummatr = $_GET['editid'];
            $nomagent = $_POST['nomagentu'];
            $prenomagent =  $_POST['prenomagentu'];
            $datenais = $_POST['datenaisu'];
            $datepsce = $_POST['datepsceu'];
            $requete = $varCon->query("UPDATE agent SET nomagent = '$nomagent', prenomagent = '$prenomagent', datenais= '$datenais', datepsce= '$datepsce' WHERE nummatr = '$nummatr'");
            if ($requete) {
                header("Location: agents.php");
            }
        }
    }
}

if(isset($_GET['deleteid'])){
    $nummatr = $_GET['deleteid'];
    $requete = $varCon->query("DELETE FROM agent where nummatr='$nummatr'");
    header("Location: agents.php");
}


if ($_SESSION['status'] == 'logged') {

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="In this website you can, borrow, read books and also review books you read">
    <meta name="author" content="Insipide**2.0">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/bootstrap-icons/bootstrap-icons.css">
    <title></title>
</head>

<body>
    <?php 
    if(isset($_GET['editid'])){
        $nummatr = $_GET['editid'];
        $requete = $varCon->query("SELECT * FROM agent where nummatr='$nummatr'");
        $exist = $requete->num_rows;
        print_r($exist);
        if($exist != 0){
            $row =  $requete->fetch_assoc();
    ?>
    <main class="d-flex justify-content-center">
        <form class=" col-lg-5 col-sm-6 col-md-6 col-xl-6" method="post" enctype="multipart/form-data">
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="nomagentu">Nom : </label>
                <input type="text" class="form-control" name="nomagentu" id="nomagentu" value="<?= $row['nomagent'] ?>">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="prenomagentu">Prenom : </label>
                <input type="text" class="form-control" name="prenomagentu" id="prenomagentu" value="<?= $row['prenomagent'] ?>">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="datenaisu">Date de naissance : </label>
                <input type="date" class="form-control" name="datenaisu" id="datenaisu" value="<?= $row['datenais'] ?>">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="datepsceu">Date de prise de service : </label>
                <input type="date" class="form-control" name="datepsceu" id="datepsceu" value="<?= $row['datepsce'] ?>">
            </div>
            <div class="center-content mt-input">
                <input type="submit" class="btn btn-primary" value="Update agent" name="update"> 
            </div>
        </form>
    </main>
    <?php 
        }
    } else {
        # code...
    ?>
	<main class="d-flex justify-content-center">
        <form class=" col-lg-5 col-sm-6 col-md-6 col-xl-6" method="post" enctype="multipart/form-data">
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="nomagent">Nom : </label>
                <input type="text" class="form-control" name="nomagent" id="nomagent">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="prenomagent">Prenom : </label>
                <input type="text" class="form-control" name="prenomagent" id="prenomagent">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="datenais">Date de naissance : </label>
                <input type="date" class="form-control" name="datenais" id="datenais">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="datepsce">Date de prise de service : </label>
                <input type="date" class="form-control" name="datepsce" id="datepsce">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="image">Profil de l'agent : </label>
                <input type="file" class="form-control" name="image" id="image">            
            </div>
            <div class="center-content mt-input">
                <input type="submit" class="btn btn-primary" value="Log in"> 
            </div>
        </form>
    </main>
    <?php } } else {

    }?>
    <table class="table">
        <thead>
            <td>Matricule</td>
            <td>Nom</td>
            <td>Prenom</td>
            <td>Date de naissance</td>
            <td>Date de prise de service</td>
            <td>Profil</td>
            <td>Actions</td>
        </thead>
        <tbody>
            <?php 
            $requete = $varCon->query("SELECT * FROM agent");
            $exist = $requete->num_rows;
            if ($exist > 0) {
                while ($agent = $requete->fetch_assoc()) {
                    $data[] = $agent;
                }
                foreach ($data as $agent) { ?>
            <tr>
                <td><?= $agent['nummatr'] ?></td>
                <td><?= $agent['nomagent'] ?></td>
                <td><?= $agent['prenomagent'] ?></td>
                <td><?= $agent['datenais'] ?></td>
                <td><?= $agent['datepsce'] ?></td>
                <td> 
                    <img src="assets/images/agents/<?= $agent['profil'] ?>" alt="" width="50" height="50">
                </td>
                <td>
                    <a class="bg-light text-warning" href="agents.php?editid=<?= $agent['nummatr'] ?>" name="modifier">
                        <i class="bi bi-pen-fill text-warning" title="Modifier" ></i>
                    </a>
                    <a href="agents.php?deleteid=<?= $agent['nummatr'] ?>" class="bg-light text-danger" name="supprimer"> 
                        <i class="bi bi-trash-fill text-danger" title="Supprimer" ></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['nomagent'], $_POST['prenomagent'], $_POST['datenais'], $_POST['datepsce'])) {
                if(!empty($_POST['nomagent']) && !empty($_POST['prenomagent']) && !empty($_POST['datenais']) && !empty($_POST['datepsce'])) {
                    $filename = $_FILES['image']['name'];
                    $tempname = $_FILES['image']['tmp_name'];
                    $folder = "./assets/images/agents/" . $filename;
                    $nomagent = $_POST['nomagent'];
                    $prenomagent =  $_POST['prenomagent'];
                    $datenais = $_POST['datenais'];
                    $datepsce = $_POST['datepsce'];
                    $requete = $varCon->query("INSERT INTO agent(nomagent,prenomagent,datenais,datepsce,profil) VALUES('$nomagent', '$prenomagent', '$datenais', '$datepsce', '$filename')");
                    if ($requete) {
                        header("Location: agents.php");
                        if(move_uploaded_file($tempname, $folder)) {
                            echo "File moved successfully.";
                        } else {
                            echo "Your file aren't moved to the project.";
                        }
                    }
                }
            }
        }
    ?>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <?php 
    } else {
        echo "Utilisateur non connecte, Nous vous redirigeons vers  pour vous permettre <a href=\"index.php\">la page de connexion</a> de vous authentifier";
    } 
    ?>
</body>

</html>