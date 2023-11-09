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

function generateEmployees($num_of_rows){

    global $faker;
    global $database;
    global $connection;

    $employee_data = array();
 
    for($i=1; $i<=$num_of_rows; $i++){
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
}

// Generate and insert 50 rows into the "Office" table
function generateOffice($num_of_rows){

    global $faker;
    global $database;
    global $connection;
    
    for ($i = 1; $i <= $num_of_rows; $i++) {
        $name = $faker->company;
        $contactnum = $faker->phoneNumber;
        $email = $faker->email;
        $address = $faker->address;
        $city = $faker->city;
        $country = $faker->country;
        $postal = $faker->postcode;


        // The values of address from faker is at least 100
        // DATABASE is altered because the maximum length for address is only 45

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
}

// Generate and insert 500 rows into the "Transaction" table
function generateTransaction($num_of_rows){

    global $faker;
    global $database;
    global $connection;

    $max_date = date('Y-m-d');

    for ($i = 1; $i <= $num_of_rows; $i++) {
        $employee_id = $faker->numberBetween(1, 50);
        $office_id = $faker->numberBetween(1, 50);
        $datelog = $faker->dateTimeBetween('-20 years', $max_date)->format('Y-m-d');
        $action = $faker->randomElement(['IN', 'OUT', 'COMPLETE']);
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

}

generateOffice(50);
generateEmployees(200);
generateTransaction(500);


?>