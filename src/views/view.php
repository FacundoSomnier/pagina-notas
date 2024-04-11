<?php
use Facundo\Notas\models\note;

if (count($_POST) > 0) {
    //Actualizar nota;
    $title = isset($_POST['title']) ? $_POST['title'] : 'title de prueba';
    $content = isset($_POST['content']) ? $_POST['content'] : 'content de prueba';
    $uuid = $_POST['id'];

    $note = Note::get($uuid);
    $note->setTitle($title);
    $note->setContent($content);

    $note->update();


} else if(isset($_GET["id"])){
    $note = Note::get($_GET["id"]);
} else{
    header('Location: http://localhost:8000/?view=home');
}
?>

<!DOCTYPE html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="src/views/resources/main.css">


</head>
<body>
<?php require 'resources/navbar.php'; ?>
<h1>View note</h1>
<form action="?view=view&id=<?php echo $note->getUUID(); ?>" method="POST">
    <input type="text" name="title" placeholder="Title..."  value="<?php echo $note->getTitle(); ?>">
    <input type="hidden" name="id" value="<?php echo $note->getUUID(); ?>">
    <textarea name="content" id="" cols="30" rows="10"><?php echo $note->getContent(); ?></textarea>

    <input type="submit" value="Update note">
    <input type="button" value="Delete note" onclick="window.location.href='?view=delete&id=<?php echo $note->getUUID(); ?>'">

</form>

</body>
</html>