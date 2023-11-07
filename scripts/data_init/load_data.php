<?php
include_once("db.php");
require ('vendor/autoload.php');

$faker = Faker\Factory::create('en_PH');

$database = new Database();
$connection = $database->getConnection();

$data = array();

// generate 15 records
for($i=1; $i<=15; $i++){
    array_push($data, $faker->unique()->province);
}

// Generate and insert 50 rows into the "Office" table
for ($i = 1; $i <= 50; $i++) {
    $name = $faker->company;
    $contactnum = $faker->phoneNumber;
    $email = $faker->email;
    $address = $faker->address;
    $city = $faker->city;
    $country = $faker->country;
    $postal = $faker->postcode;

    $sql = "INSERT INTO office (name, contactnum, email, address, city, country, postal) VALUES (:name, :contactnum, :email, :address, :city, :country, :postal)";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contactnum', $contactnum);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':postal', $postal);
    $stmt->execute();
}

// Generate and insert 500 rows into the "Transaction" table
for ($i = 1; $i <= 500; $i++) {
    $employee_id = $faker->numberBetween(1, 50);
    $office_id = $faker->numberBetween(1, 50);
    $datelog = $faker->date;
    $action = $faker->randomElement(['Action1', 'Action2', 'Action3']);
    $remarks = $faker->sentence;
    $documentcode = $faker->word;

    $sql = "INSERT INTO transaction (employee_id, office_id, datelog, action, remarks, documentcode) VALUES (:employee_id, :office_id, :datelog, :action, :remarks, :documentcode)";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':employee_id', $employee_id);
    $stmt->bindParam(':office_id', $office_id);
    $stmt->bindParam(':datelog', $datelog);
    $stmt->bindParam(':action', $action);
    $stmt->bindParam(':remarks', $remarks);
    $stmt->bindParam(':documentcode', $documentcode);
    $stmt->execute();
}
print_r($data);

$sql = "INSERT INTO province(name) VALUES (:name)";
$stmt = $connection->prepare($sql);


foreach ($data as $row) {
    $stmt->bindParam(':name', $row);
    $stmt->execute();
}

?>