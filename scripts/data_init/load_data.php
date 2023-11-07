<?php
include_once("db.php");
require ('vendor/autoload.php');

$faker = Faker\Factory::create('en_PH');

$database = new Database();
$connection = $database->getConnection();

// $data = array();
// generate 15 records
// for($i=1; $i<=15; $i++){
//     array_push($data, $faker->unique()->province);
// }
// print_r($data);

// $sql = "INSERT INTO province(name) VALUES (:name)";
// $stmt = $connection->prepare($sql);


// foreach ($data as $row) {
//     $stmt->bindParam(':name', $row);
//     $stmt->execute();
// }
// generate 200 employee records

$employee_data = array();
 
for($i=1; $i<=200; $i++){
    $employee_row = array();
    array_push($employee_row, $faker->lastName(), $faker->firstName(),$faker->numberBetween($min = 1, $max = 55), $faker->address());
    array_push($employee_data, $employee_row);
}
print_r($employee_data);

$sql = "INSERT INTO employee(lastname, firstname, office_id, address) VALUES (:lastname, :firstname, :office_id, :address)";
$stmt = $connection->prepare($sql);


foreach ($employee_data as $row) {
    $stmt->bindParam(':lastname', $row[0]);
    $stmt->bindParam(':firstname', $row[1]);
    $stmt->bindParam(':office_id', $row[2]);
    $stmt->bindParam(':address', $row[3]);
    $stmt->execute();
}




?>