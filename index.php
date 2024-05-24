<?php
session_start();
// var_dump($_SESSION["message"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Site de vente de produit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout produit</title>
</head>
<body>

    <div id="wrapper">

        <ul class="navbar">
            <li><a href="index.php">Ajouter un produit</a></li>
            <li><a href="recap.php">Voir mes produits</a></li>
        </ul>

        <main class="addProduct">
            <h1>Ajouter un produit</h1>

            <!-- Fichier à atteindre lorsque qu'on soumet le formulaire avec la méthode http -->
            <form action="traitement.php?action=add" method="post">
                <p>
                    <label>
                        Nom du produit :
                        <input type="text" name="name" class="form-control" maxlength="50">
                    </label>
                </p>
                <p>
                    <label>
                        Prix du produit :
                        <input type="number" step="any" name="price" class="form-control">
                    </label>
                </p>
                <p>
                    <label>
                        Quantité désirée :
                        <input type="number" name="qtt" value="1" class="form-control" min="1">
                    </label>
                </p>
                <p>
                    <input type="submit" class="btn btn-success" name="submit" value="Ajouter le produit">
                </p>
            </form>
            <div>
                <h4>Quantité de produit au total :
                <?php

                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                    echo "0";

                } else {
                    $result = 0;
                    foreach($_SESSION['products'] as $index => $product){
                        $result = $result + $product['qtt'];
                    }
                    echo $result;
                }
                echo "</h4>";

                if(!isset($_SESSION['message']) || empty($_SESSION['message'])){
                    echo "";
                } else {
                    echo "<p class='success'>".$_SESSION["message"]."</p>"; 
                    unset($_SESSION["message"]);
                }
                
                if(!isset($_SESSION['error']) || empty($_SESSION['error'])){
                    echo "";
                } else {
                    echo "<p class='error'>".$_SESSION["error"]."</p>";  
                    unset($_SESSION["error"]);
                    
                }
                ?>
            </div>
        </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>