<?php
include "config.php";

$uid   = $_POST['firebase_uid'];
$email = $_POST['email'];
$nama  = $_POST['username'];

$q = mysqli_query($conn,
  "SELECT * FROM user WHERE firebase_uid='$uid'"
);

if(mysqli_num_rows($q)==0){
  mysqli_query($conn,"
    INSERT INTO user(firebase_uid,username,email,role)
    VALUES('$uid','$nama','$email','user')
  ");
}

$user = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT * FROM user WHERE firebase_uid='$uid'")
);

echo json_encode([
  "status"=>"success",
  "user"=>$user
]);
