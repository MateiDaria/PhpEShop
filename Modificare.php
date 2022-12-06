<?php
include("Conectare.php");
$error='';
if (!empty($_POST['id']))
{ if (isset($_POST['submit']))
{
if (is_numeric($_POST['id']))
{
$id=$_POST['id'];
$produs_nume = htmlentities($_POST['produs_nume'], ENT_QUOTES);
$produs_pret= htmlentities($_POST['produs_pret'], ENT_QUOTES);
$produs_img = htmlentities($_POST['produs_img'], ENT_QUOTES);
$produs_desc = htmlentities($_POST['produs_desc'], ENT_QUOTES);

if ($produs_nume == ''||$produs_pret==''||$produs_img==''||$produs_desc=='')
{
echo "<div> ERROR: Completati campurile obligatorii!</div>";
}else
{
if ($stmt = $mysqli->prepare("UPDATE produse SET
produs_nume=?, produs_pret=?, produs_img=?, produs_desc=? WHERE id='" . $id . "'"))
{
$stmt->bind_param("sdss", $produs_nume, $produs_pret, $produs_img,$produs_desc);
$stmt->execute();
$stmt->close();
}
else
{echo "ERROR: nu se poate executa update.";}
}
}
else
{echo "id incorect!";} }}?>
<html> <head><title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/></head>
<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <?php if ($_GET['id'] != '') { ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM produse where id='".$_GET['id']."'"))
            {
            if ($result->num_rows > 0)
            { $row = $result->fetch_object();?></p>
        <strong>Nume: </strong> <input type="text" name="produs_nume" value="<?php echo$row->produs_nume;
        ?>"/><br/>
        <strong>Pret: </strong> <input type="text" name="produs_pret" value="<?php echo$row->produs_pret;
        ?>"/><br/>
        <strong>Imagine: </strong> <input type="text" name="produs_img" value="<?php echo$row->produs_img; ?>"/><br/>
        <strong>Descriere </strong> <input type="text" name="produs_desc" value="<?php echo$row-> produs_desc; }}}?>"/><br/>

        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="Vizualizare.php">Index</a>
    </div></form></body> </html>