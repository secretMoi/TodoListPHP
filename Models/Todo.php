<?php
namespace Models;

class Todo extends BaseModel
{
    public $ID;
    public $Titre;
    public $Contenu;
    public $DateCreation;
    public $DateModif;
    public $Status;
}