<?php
include("Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $produs_nume = htmlentities($_POST['produs_nume'], ENT_QUOTES);
    $produs_pret = htmlentities($_POST['produs_pret'], ENT_QUOTES);
    $produs_img = htmlentities($_POST['produs_img'], ENT_QUOTES);
    $produs_desc = htmlentities($_POST['produs_desc'], ENT_QUOTES);


    if ($produs_nume == '' || $produs_pret == ''|| $produs_img==''|| $produs_desc=='')
    {

        $error = ' ERROR: Campuri goale!';
    } else {

        if ($stmt = $mysqli->prepare("INSERT into produse (produs_nume, produs_pret, produs_img,  produs_desc) VALUES (?, ?, ?, ? )"))
        {
            $stmt->bind_param("sdss", $produs_nume, $produs_pret, $produs_img,  $produs_desc);
            $stmt->execute();
            $stmt->close();
        }
// eroare le inserare
        else
        {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
// se inchide conexiune mysqli
$mysqli->close();
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
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <strong>Nume: </strong> <input type="text" name="produs_nume" value=""/><br/>
        <strong>Pret: </strong> <input type="text" name="produs_pret" value=""/><br/>
        <strong>Imagine: </strong> <input type="text" name="produs_img" value=""/><br/>
        <strong>Descriere: </strong> <input type="text" name="produs_desc" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare.php">Index</a>
    </div></form>
</body>