<?php

    use Facundo\Notas\models\Note;

    $uuid = $_GET['id'];

    echo $uuid;

    Note::delete($uuid);

    header('Location: http://localhost:8000/?view=home');


?>