<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description" content="Site de vente de produit">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Récapitulatif des produits</title>
</head>
<body>
    <div id="wrapper">

        <ul class="navbar">
                <li><a href="index.php">Ajouter un produit</a></li>
                <li><a href="recap.php">Voir mes produits</a></li>
        </ul>

        <main class="displayProduct">
            <h1>Mes produits :</h1>
            <div class="tableProduit">
            <?php

                // Conditions : Si la clé 'products' dans le tableau $_SESSION n'existe pas ou si la clé est vide, alors...
                if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                    echo "<p>Aucun produit en session...</p>";
                } else {
                    echo "<table class='table table-striped' border=1>",
                            "<thead>",
                                "<tr>",
                                    "<th>#</th>",
                                    "<th>Nom</th>",
                                    "<th>Prix</th>",
                                    "<th>-</th>",
                                    "<th>Quantité</th>",
                                    "<th>+</th>",
                                    "<th>Total</th>",
                                    "<th></th>",
                                "</tr>",
                            "</thead>",
                            "<tbody>";
                $totalGeneral = 0;

                // Pour chaque produit dans le tableau _SESSION, on va utilisé la méthode de clé/valeur
                foreach($_SESSION['products'] as $index => $product){
                    echo "<tr>",
                            "<td>".$index."</td>",
                            "<td>".$product['name']."</td>",
                            "<td>".$product['price']."&nbsp;€</td>",
                            "<td><a class='btn btn-danger'href='traitement.php?action=down-qtt&id=$index'><i class='fa-solid fa-minus'></i></a></td>",
                            "<td>".$product['qtt']."</td>",
                            "<td><a class='btn btn-success' href='traitement.php?action=up-qtt&id=$index'><i class='fa-solid fa-plus'></i></a></td>",
                            "<td>".$product['total']."&nbsp;€</td>",
                            "<td><a class='btn btn-warning' href='traitement.php?action=delete&id=$index'><i class='fa-solid fa-trash'></i></a></td>",
                        "</tr>";
                    $totalGeneral+= $product['total'];
                }

                echo "<tr>",
                        "<td colspan=4><strong>Total général : </strong></td>",
                        "<td colspan=2><strong>".
                            $test = "";
                            $result = 0;
                            foreach($_SESSION['products'] as $index => $product){
                                $result = $result + $product['qtt'];
                            }
                            echo $result
                        ."</strong></td>",
                        "<td><strong>".number_format($totalGeneral, 2, ", ", "&nbsp;")."&nbsp;€</strong></td>",
                        "<td></td>",
                    "</tr>",
                    "</tbody>",
                    "</table>";

                }
            ?>

            </div>
            <?php
            
            if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
                echo"";
            } else {
                echo '<a class="clear" href="traitement.php?action=clear">Vider le panier</a>';
                
            }

            if(!isset($_SESSION['message']) || empty($_SESSION['message'])){
                echo "";
            } else {
                echo $_SESSION["message"]; 
                unset($_SESSION["message"]); 
                
            }

            ?>
        </main>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>