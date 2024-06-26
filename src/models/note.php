<?php

namespace Facundo\Notas\models;

USE Facundo\Notas\lib\Database;

USE PDO;


class note extends Database {

    private string $uuid;

    public function __construct(private string $title, private string $content) {

        parent::__construct();

        $this->uuid = uniqid();


    }

    public function save(){
        $query = $this->connect()->prepare('INSERT INTO note (uuid, title, content, updated) VALUES (:uuid, :title, :content, NOW())');
        $query->execute([
            'uuid' => $this->uuid,
            'title' => $this->title,
            'content' => $this->content,
        ]);
    }

    public function update(){

        $query = $this->connect()->prepare('UPDATE note SET title = :title, content = :content, updated = NOW() WHERE uuid = :uuid');
        $query->execute(['uuid' => $this->uuid, 'title' => $this->title, 'content' => $this->content,]);

    }

    public static function delete($uuid){
        $db = new Database();
        $query = $db->connect()->prepare('DELETE FROM note WHERE uuid = :uuid');
        $query->execute([
            'uuid' => $uuid
        ]);

    }

    public static function get($uuid){
        $db = new Database();
        $query = $db->connect()->prepare('SELECT * FROM note WHERE uuid = :uuid');
        $query->execute([
            'uuid' => $uuid
        ]);

        $note = Note::createFromArray($query->fetch(PDO::FETCH_ASSOC));

        return $note;

    }

    public static function getAll(){

        $db = new Database();
        $query = $db->connect()->query('SELECT * FROM note');


        $notes = [];
        while($row = $query->fetch(PDO::FETCH_ASSOC)){
            $note = Note::createFromArray($row);
            array_push($notes, $note);
        }

        return $notes;
    }

    public static function createFromArray($arr):Note{
        $note = new Note($arr['title'], $arr['content']);
        $note->setUUID($arr['uuid']);

        return $note;
    }

    public function getUUID(){
        return $this->uuid;
    }

    public function setUUID($value){
        $this->uuid = $value;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($value){
        $this->title = $value;
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($value){
        $this->content = $value;
    }

}


?>