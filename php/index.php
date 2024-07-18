<?php
session_start();
// Vérifier si les valeurs sont déjà enregistrées en session
if (!isset($_SESSION['currencies'])) {
    // Appel à l'API pour obtenir les valeurs
    include_once('./getcurrencies.php');

    // Stocker les valeurs dans la session
    $_SESSION['currencies'] = $currencies;
} else {
    // Utiliser les valeurs enregistrées en session
    $currencies = $_SESSION['currencies'];
}

include_once('./convert.php');
include_once('./swapcurrencies.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convertisseur de devises</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <div class="container">
    <h1>Convertisseur de devises</h1>
    <a><a href="./connect.php">Retour</a>
    <form id="form" action="index.php" method="post">
        <div class="form-group">
            <label for="amount">Montant</label>
            <input type="text" class="form-control" name="amount" id="amount" placeholder="Ajouter le montant à convertir">
        </div>
        <div class=" form-group">
            <label for="from-currency">Devise de départ</label>
            <select class="form-control" name="from-currency" id="from-currency">
                <?php
                 foreach ($currencies as $currencyInfo) {
                    $currencyCode = $currencyInfo[0];
                    $currencyName = $currencyInfo[1];
                    echo '<option value="' . $currencyCode . '">' . $currencyCode . ' - ' . $currencyName . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="to-currency">Devise finale</label>
            <select class="form-control" name="to-currency" id="to-currency">
                <?php
                 foreach ($currencies as $currencyInfo) {
                    $currencyCode = $currencyInfo[0];
                    $currencyName = $currencyInfo[1];
                    echo '<option value="' . $currencyCode . '">' . $currencyCode . ' - ' . $currencyName . '</option>';
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Convertir</button>
    </form>
    <form method="post" action="swapcurrencies.php">
        <button type="submit" class="btn btn-primary" name="swapButton">Echanger</button>
    </form>
    <?php if ($showResult): ?>
    <div class="result">
        <?php echo $result; ?>
    </div>
    <?php endif; ?>
    </div>
    <script> 
    // Evite que le formulaire ne soir réenvoyé lors du refresh de la page
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>