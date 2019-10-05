<?php

try{
    $db = new PDO("mysql:host=localhost; dbname=pdobootcamp", "root", "");
}catch(PDOException $e){
    echo "Connection Error: " . $e->getMessage();
}

/** Insert Data */

$name = "Harman";
$email = "harry@gmail.com";
$password = "12345";

$result = $db->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");

$result = $db->prepare("INSERT INTO users (name, email, password) VALUES (?,?,?)");
$result->execute([$name, $email, $password]);

if($result){
    echo "Data Successfully Added";
}

/** Show Data */

$result = $db->prepare("SELECT * FROM users");
$result->execute();

$rows = $result->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $userData):

    echo $userData['user_id'], "<br>";
    echo $userData['name'], "<br>";
    echo $userData['email'], "<br>";

endforeach;

/** Update Data */

$name = "Harmanpreet Singh";
$email = "harman@gmail.com";
$password = "2345";
$user_id = "1";

$result = $db->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE user_id = ?");
$result->execute([$name, $email, $password, $user_id]);

if($result){
   echo "Record Updated Successfully";
}

/** Delete Data */

$user_id = "2";

$result = $db->prepare("DELETE FROM users WHERE user_id = ?");
$result->execute([$user_id]);

if($result){
    echo "Record Delete Succesfully";
}
