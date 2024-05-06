<?php
function Redirect_to($New_Location){
    header("Location:".$New_Location);
    exit;
}
function CheckUserExists($Username){
    global $ConnectingDB;
    $sql = "SELECT username FROM admins WHERE username=:userName";
    $stmt=$ConnectingDB->prepare($sql);
    $stmt->bindValue(':userName',$Username);
    $stmt ->Execute();
    $Result=$stmt->rowcount();
    if($Result==1){
        return true;
    }else{
        return false;
    }
}
?>