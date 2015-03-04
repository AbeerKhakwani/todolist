<?php
class Task
{
    private $description;

    function __construct($description){
        $this->description = $description;
    }

    function setDescription($new_description){
        $this->description =$new_description;
    }

    function getDescription(){
        return $this->description;
    }

    function save(){
         array_push($_SESSION["list_description"],$this);
    }

    static function getAll(){
        return $_SESSION["list_description"];
    }

    static function clearAll(){
        $_SESSION['list_description']=array();
    }
}
?>
