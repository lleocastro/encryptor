<?php

require_once (__DIR__ . '/../bootstrap.php');
use \Encryptor\Suite\SMCrypter;

$smCrypt1 = new SMCrypter();
$smCrypt2 = new SMCrypter();

$phase = "My EMAIL is 'leonardo_carvalho@outlook.com' and (10+5/2*7=0999) <><because yes. çÇ>";
$alphabet = 'A, B, C, D, E, F, G, H, I, J, K, L, M, N, O, P, Q, R, S, T, U, V, W, X, Y, Z, Ç';
$especials = '! @ # $ % ¨ & * ( ) _ + = , . ; / ? | \\ ° ° : ^ ~ ] } { [ ´ ` º ª';
$accentuation = 'í ,ó, é,á, ú, õ, ẽ, ã, ẽ, ũ, ñ, â, ô';
$numbers = '1 2 3 4 5 6 7 8 9 0';
$tag = '<?php echo "hello!" ?>';

$originalValue = $phase;
echo 'Original Text: ' . htmlentities($originalValue);

echo "<br>";
echo "<br>";

$key = $smCrypt1->keyGenerator();
//$key = 3000000;
//$key = 'VE16Z2pNPT1RTzVn';
echo 'Generated Key: ' . $key;

echo "<br>";
echo "<br>";

$en = $smCrypt1->encode($key, $originalValue);
echo 'Encrypted Text: '.$en;

echo "<br>";
echo "<br>";

echo 'Decrypted Text: '.$smCrypt2->decode($key, $en);

echo "<br>";
echo "<br>";

$key = 134635;
$value = 32;

//var_dump(str_ireplace('"', '', "((({$value}{$smCrypt2->getCodeX()[1]}{$key}){$smCrypt2->getCodeX()[1]}{$key}){$smCrypt2->getCodeX()[0]}{$key})"));

echo "<br>";
echo "<br>";

//var_dump(("((({$value}{$smCrypt2->getCodeX()[1]}{$key}){$smCrypt2->getCodeX()[1]}{$key}){$smCrypt2->getCodeX()[0]}{$key})"));

echo "<br>";
echo "<br>";
