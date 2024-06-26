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
function Login_Attempt($Username,$Password){
    global $ConnectingDB;
    $sql="SELECT * FROM admins WHERE username=:userName AND password=:passWord LIMIT 1";
    $stmt= $ConnectingDB->prepare($sql);
    $stmt->bindValue(':userName',$Username);
    $stmt->bindValue(':passWord',$Password);
    $stmt->execute();
    $Found_Account = $stmt->fetch();
    if($Found_Account){
   return $Found_Account;
    }else{
        return null;
    }
}
function Confirm_Login(){
    if(isset($_SESSION["UserID"])){
        return true;
    }else{
       $_SESSION["ErrorMessage"]="Login Required";
       Redirect_to("Login.php") ;
    }
}
function TotalPosts(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM posts";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows= $stmt->fetch();
    $TotalPosts=array_shift($TotalRows);
    echo $TotalPosts;
}
function TotalCategories(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM categories";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows= $stmt->fetch();
    $TotalCategories=array_shift($TotalRows);
    echo $TotalCategories;
    
}
function TotalAdmins(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM admins";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows= $stmt->fetch();
    $TotalAdmins=array_shift($TotalRows);
    echo $TotalAdmins;
    
}
function TotalComments(){
    global $ConnectingDB;
    $sql = "SELECT COUNT(*) FROM comments";
    $stmt = $ConnectingDB->query($sql);
    $TotalRows= $stmt->fetch();
    $TotalComments=array_shift($TotalRows);
    echo $TotalComments;
}
?>