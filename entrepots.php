<?php 
$databaseHost = 'localhost';
$databaseName = 'agridigital';
$databaseUser = 'root';
$databasePass = '';
$varCon = new mysqli($databaseHost, $databaseUser, $databasePass, $databaseName);

session_start();

if (isset($_POST['update'])) {
    # code...
    if(isset($_POST['nummatru'], $_POST['libentrepu'], $_POST['adrentrepu'], $_POST['codlocau'])) {
        if(!empty($_POST['nummatru']) && !empty($_POST['libentrepu']) && !empty($_POST['adrentrepu']) && !empty($_POST['codlocau'])) {
            $codentrep = $_GET['editid'];
            $libentrep =  $_POST['libentrepu'];
            $adrentrep =  $_POST['adrentrepu'];
            $nummatr = $_POST['nummatru'];
            $codloca = $_POST['codlocau'];
            $requete = $varCon->query("UPDATE entrepot SET libentrep = '$libentrep', nummatr= '$nummatr', codloca= '$codloca', adrentrep = '$adrentrep' WHERE codentrep = '$codentrep'");
            if ($requete) {
                header("Location: entrepots.php");
            }
        }
    }
}

if(isset($_GET['deleteid'])){
    $codentrep = $_GET['deleteid'];
    $requete = $varCon->query("DELETE FROM entrepot where codentrep='$codentrep'");
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
        $codentrep = $_GET['editid'];
        $requete = $varCon->query("SELECT * FROM entrepot where codentrep='$codentrep'");
        $exist = $requete->num_rows;
        print_r($exist);
        if($exist != 0){
            $row =  $requete->fetch_assoc();
    ?>
    <main class="d-flex justify-content-center">
        <form class=" col-lg-5 col-sm-6 col-md-6 col-xl-6" method="post" enctype="multipart/form-data">
        <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="libentrepu">Libelle : </label>
                <input type="text" class="form-control" name="libentrepu" id="libentrepu" value="<?= $row['libentrep'] ?>">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="adrentrepu">Adresse : </label>
                <input type="text" class="form-control" name="adrentrepu" id="adrentrepu" value="<?= $row['adrentrep'] ?>">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="nummatru">Gerant : </label>
                <select class="form-control" name="nummatru" id="nummatru" value="<?= $row['nummatr'] ?>">
                    <?php 
                        $requete = $varCon->query("SELECT * FROM agent");
                        $exist = $requete->num_rows;
                        if ($exist > 0) {
                            while ($agent = $requete->fetch_assoc()) {
                                $agents[] = $agent;
                            }
                        }
                        foreach ($agents as $agent) {
                    ?>
                    <option value="<?= $agent['nummatr'] ?>"> <?= $agent['nomagent'] ?> <?= $agent['prenomagent'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="codlocau">Localite : </label>
                <select class="form-control" name="codlocau" id="codlocau" value="<?= $row['codloca'] ?>">
                    <?php 
                        $requete = $varCon->query("SELECT * FROM localite");
                        $exist = $requete->num_rows;
                        if ($exist > 0) {
                            while ($agent = $requete->fetch_assoc()) {
                                $localites[] = $agent;
                            }
                        }
                        foreach ($localites as $localite) {
                    ?>
                    <option value="<?= $localite['codloca'] ?>"> <?= $localite['libloca'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="center-content mt-input">
                <input type="submit" class="btn btn-primary" value="Update entrepot" name="update"> 
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
                <label class="form-label"  for="codentrep">Code : </label>
                <input type="text" class="form-control" name="codentrep" id="codentrep">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="libentrep">Libelle : </label>
                <input type="text" class="form-control" name="libentrep" id="libentrep">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="adrentrep">Adresse : </label>
                <input type="text" class="form-control" name="adrentrep" id="adrentrep">
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="nummatr">Gerant : </label>
                <select class="form-control" name="nummatr" id="nummatr">
                    <option value="">------</option>
                    <?php 
                        $requete = $varCon->query("SELECT * FROM agent");
                        $exist = $requete->num_rows;
                        if ($exist > 0) {
                            while ($agent = $requete->fetch_assoc()) {
                                $agents[] = $agent;
                            }
                        }
                        foreach ($agents as $agent) {
                    ?>
                    <option value="<?= $agent['nummatr'] ?>"> <?= $agent['nomagent'] ?> <?= $agent['prenomagent'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group has-feedback mb-3">
                <label class="form-label"  for="codloca">Localite : </label>
                <select class="form-control" name="codloca" id="codloca">
                    <option value="">------</option>
                    <?php 
                        $requete = $varCon->query("SELECT * FROM localite");
                        $exist = $requete->num_rows;
                        if ($exist > 0) {
                            while ($agent = $requete->fetch_assoc()) {
                                $localites[] = $agent;
                            }
                        }
                        foreach ($localites as $localite) {
                    ?>
                    <option value="<?= $localite['codloca'] ?>"> <?= $localite['libloca'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="center-content mt-input">
                <input type="submit" class="btn btn-primary" value="Log in"> 
            </div>
        </form>
    </main>
    <?php } ?>
    <table class="table">
        <thead>
            <td>Code</td>
            <td>Libelle</td>
            <td>Adresse</td>
            <td>Gerant</td>
            <td>Localite</td>
            <td>Actions</td>
        </thead>
        <tbody>
            <?php 
            $requete = $varCon->query("SELECT * FROM entrepot");
            $exist = $requete->num_rows;
            if ($exist) {
                while ($entrepot = $requete->fetch_assoc()) {
                    $emtrepots[] = $entrepot;
                }
                foreach ($emtrepots as $entrepot) { ?>
                <tr>
                    <td><?= $entrepot['codentrep'] ?></td>
                    <td><?= $entrepot['libentrep'] ?></td>
                    <td><?= $entrepot['adrentrep'] ?></td>
                    <td><?= $entrepot['nummatr'] ?></td>
                    <td><?= $entrepot['codloca'] ?></td>
                    <td>
                        <a class="bg-light text-warning" href="entrepots.php?editid=<?= $entrepot['codentrep'] ?>" name="modifier">
                            <i class="bi bi-pen-fill text-warning" title="Modifier" ></i>
                        </a>
                        <a href="entrepots.php?deleteid=<?= $entrepot['codentrep'] ?>" class="bg-light text-danger" name="supprimer"> 
                            <i class="bi bi-trash-fill text-danger" title="Supprimer" ></i>
                        </a>
                    </td>
                </tr>
        <?php 
            } 
        } else {

        }
        ?>
        </tbody>
    </table>
    <?php 
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            if(isset($_POST['codentrep'], $_POST['libentrep'], $_POST['adrentrep'], $_POST['nummatr'], $_POST['codloca'])) {
                if(!empty($_POST['codentrep']) && !empty($_POST['libentrep']) && !empty($_POST['adrentrep']) && !empty($_POST['nummatr']) && !empty($_POST['codloca'])) {
                    $codentrep = $_POST['codentrep'];
                    $libentrep =  $_POST['libentrep'];
                    $adrentrep = $_POST['adrentrep'];
                    $nummatr = $_POST['nummatr'];
                    $codloca = $_POST['codloca'];
                    $requete = $varCon->query("INSERT INTO entrepot(codentrep,libentrep,adrentrep,nummatr,codloca) VALUES('$codentrep', '$libentrep', '$adrentrep', '$nummatr', '$codloca')");
                    if ($requete) {
                        header("Location: entrepots.php");
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