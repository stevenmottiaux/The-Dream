<?php
require_once('./api.php');
$showResult = false; // Par défaut, pas de div result
// Vérifier si le formulaire a été soumis

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amountValue = $_POST['amount'];
   
    if (!is_numeric($amountValue)) {
        // Afficher un message d'erreur ou rediriger vers une page d'erreur
        echo "<script type='text/javascript'>alert('Veuillez entrer un montant valide.');
        window.location.href = 'index.php';</script>";
        exit;
}
}

if (isset($_POST['amount'])) {
	$amount = $_POST['amount'];
}	else {
	$amount = 0;
}
if( isset($_POST['from-currency']) && isset($_POST['to-currency']) ) {
	$from = $_POST['from-currency'];
	$to = $_POST['to-currency'];
} else {
	$from = 'EUR';
	$to = 'EUR';
}

$url = 'https://v6.exchangerate-api.com/v6/' . $apiKey . '/pair/' . $from . '/' . $to . '/' . $amount . '/';

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($ch);
$err = curl_error($ch);

curl_close($ch);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $data = json_decode($response, true);
    $baseCode = $data['base_code'];
	$targetCode = $data['target_code'];
	$targetAmount = $data['conversion_result'];
	$rate = $data['conversion_rate'];	
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ...

    // Stocker le résultat de la conversion dans des variables
    $targetAmount = $data['conversion_result'];
    $baseCode = $data['base_code'];
    $targetCode = $data['target_code'];
    $rate = $data['conversion_rate'];

    // Définir $showResult sur true pour afficher le div result
    $showResult = true;
}

// ...

// Vérifier si les variables sont définies avant d'essayer d'utiliser leur valeur
if ($showResult) {
    $result = "Le montant de $amount $baseCode vallent $targetAmount $targetCode avec un taux de conversion de $rate";
}
?> 