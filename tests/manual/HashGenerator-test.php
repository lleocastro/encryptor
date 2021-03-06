<?php

require_once (__DIR__ . '/../bootstrap.php');
use \Encryptor\Suite\HashGenerator;

$hash1 = new HashGenerator();
$hash2 = new HashGenerator();
$hash3 = new HashGenerator();

$data = "Hello World!";
$tag = "<?php phpinfo(); ?>"; //Safety against scripts injections.
echo 'Text: ' . htmlentities($data);

echo "<br>";
echo "<br>";

$encryptedData1 = $hash1->encode($data);
$encryptedData2 = $hash2->encode($data);

echo 'Encrypted: ' . $encryptedData1;

echo "<br>";
echo "<br>";

// // //$x = explode(strlen($encryptedData1)/2, $encryptedData1);
// // //var_dump($x[0]);
// // var_dump(str_replace("int()", "", substr($encryptedData1, 0, (strlen($encryptedData1)/2)-strlen($encryptedData1))));
// // echo "<br>";
// // var_dump(str_replace("int()", "", substr($encryptedData1, (strlen($encryptedData1)/2)-strlen($encryptedData1)), strlen($encryptedData1)));
// echo $encryptedData1;
// echo "<br>";
// $q =  base64_encode(str_replace("int()", "", substr($encryptedData1, (strlen($encryptedData1)/2)-strlen($encryptedData1)), strlen($encryptedData1))).base64_encode(str_replace("int()", "", substr($encryptedData1, 0, (strlen($encryptedData1)/2)-strlen($encryptedData1))));

// echo "<br>";
// echo base64_decode($q);




// echo "<br>";
// var_dump($encryptedData1);
// //echo "<br>";
// //var_dump($encryptedData2);
// //echo "<br>";

$output = $hash3->isEquals("Hello World!", $encryptedData2);
echo 'Hashs Comparables: ';
var_dump(htmlentities($output));

echo "<br>";
echo "<br>";
