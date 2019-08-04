<?php
require_once __DIR__ . '\includes\db_connection.php';

$db = OpenCon();

// PDO

$name = $_GET["name"];
var_dump("The name is: $name");
$like_name = "$name";
$limit = $_GET["limit"];

// SELECT QUERY
// $stmt = $db->prepare("SELECT *
//                       FROM usertab
//                       WHERE username LIKE ?
//                       LIMIT ?");

// $stmt = $db->prepare("INSERT INTO usertab (username, password) VALUES (?, ?)");
$stmt = $db->prepare("DELETE FROM `usertab` WHERE `usertab`.`username` = ?");
//SETTING THE QUESTION MARKS
$stmt->bind_param(
  "s",
  $name
  // $lssimit
);
$stmt->execute();
//
// $result = $stmt->get_result();
// $data = [];
//
// while($row = $result->fetch_assoc()){
//   $data[] = $row;
// }

// var_dump($data);

?>
