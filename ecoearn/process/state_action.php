<?php

require_once "../classes/User.php";

// echo "<option>Loading Loading</option>";

//retrievve the id of the stae that was sent
// instantiate the class
//call the method
// loop through the lg and form a giant string with it and echo it;

$id = $_GET["id"];

$lg =  new User;
$lgs = $lg->fetch_lg($id);

$lga = "<option = ''>Select Local Government</option>";

foreach($lgs as $l){
        $ids = $l["lga_id"];
        $lga.="<option value='$ids'>".$l["lga_name"]."</option>";

}
echo $lga;



?>