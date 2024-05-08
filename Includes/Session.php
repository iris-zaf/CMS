<?php
session_start();
function ErrorMessage(){
    if(isset($_SESSION["ErrorMessage"])){
        $Output= "<div class=\"alert alert-danger\">";
        $Output .=htmlentities($_SESSION["ErrorMessage"]);
        $Output .="</div>";
        unset($_SESSION["ErrorMessage"]);
        return $Output; 
    }
}
function SuccessMessage(){
    if(isset($_SESSION["SuccessMessage"])){
        $Output= "<div class=\"alert alert-success\">";
        $Output .=htmlentities($_SESSION["SuccessMessage"]);
        $Output .="</div>";
        unset($_SESSION["SuccessMessage"]);
        return $Output; 
    }
}

?>