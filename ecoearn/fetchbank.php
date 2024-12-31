<?php

$apiUrl = 'https://api.paystack.co/bank';
$headers = ['Authorization: Bearer sk_test_b0f52a81905d44962e8423996060cde0399271d8Y','content-Type:application/json'];


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
curl_close($ch);


if ($response === false) {
    echo "<p class='alert alert-warning col-md-12'>Ensure that you are connected to the Internet</p>";
    exit();
}

$data = json_decode($response,true);


if (isset($data['data']) && is_array($data['data'])) {
    $bankslist = $data['data']; 
} else {
    echo "Error: No bank data found.";
    exit();
}

// echo '<pre>';
// print_r($data);
// echo '</pre>';

?>
