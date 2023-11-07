<?php
$employee_data = array();

for($i=1; $i<=200; $i++){
    $employee_row = array();
    array_push($employee_row, $faker->lastName(), $faker->firstName(),$faker->numberBetween($min = 1, $max = 55), $faker->address());
    array_push($employee_data, $employee_row);
}
print_r($employee_data);