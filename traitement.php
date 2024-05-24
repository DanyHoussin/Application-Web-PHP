<?php

    // On va démarer une session pour l'utilisateur, si il avait déjà une session en son nom alors il retrouvera sa session, si il n'avait pas de session alors une nouvelle sera créer
    session_start();

    
    if(isset($_GET['action'])){
        
        switch($_GET['action']){

            case "add":
                 // Si le bouton submit a été presser par l'utilisateur, alors les données sont pris en compte
                if(isset($_POST['submit'])){

                    // Ces filtres sont à mettre dans la partie back, ils rajoutent une sécurité et ainsi ils ne peuvent etre édités dans le DevTool du navigateur du client

                    // Pour le filter sur la variable name, il accepte la saisie de cette dernière et transforme le côté dangereux du texte en quelque chose de sécurisé
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    // Filtre permettant de valider la variable si c'est un float, autorise aussi la présence de virgule et de point pour la décimal
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    
                    // Filtre permettant de valider la variable si c'est un entier (integer)
                    $qtt = filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);

                    // Si les 3 variables ne sont pas null ou faux, alors
                    if($name && $price && $qtt){

                        $product = [
                            "name" => $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt
                        ];

                        // Array push
                        $_SESSION['products'][] = $product;
                        $_SESSION["message"] = "Produit ajouté avec succes";
                        header("Location: index.php");
                    } else {
                        $_SESSION["error"] = "Erreur : veuillez saisir le nom ainsi que le prix du produit";
                        header("Location: index.php");
                    }
                }

                break;
            case "clear":
                unset($_SESSION["products"]);
                $_SESSION["message"] = "Les produits ont bien été supprimer";
                header("Location: recap.php");
                break;
        
            case "delete":
                unset($_SESSION["products"][$_GET['id']]);
                $_SESSION["message"] = "Le produit a bien été supprimer";
                header("Location: recap.php");
                break;

            case "down-qtt":
                if($_SESSION["products"][$_GET['id']]['qtt'] > 0){
                    $_SESSION["products"][$_GET['id']]['qtt'] --;
                    $_SESSION["products"][$_GET['id']]['total'] = $_SESSION["products"][$_GET['id']]['price']*$_SESSION["products"][$_GET['id']]['qtt'];
                    header("Location: recap.php");
                } else {
                    unset($_SESSION["products"][$_GET['id']]);
                    header("Location: recap.php");
                }

                break;

            case "up-qtt":
                $_SESSION["products"][$_GET['id']]['qtt'] ++;
                $_SESSION["products"][$_GET['id']]['total'] = $_SESSION["products"][$_GET['id']]['price']*$_SESSION["products"][$_GET['id']]['qtt'];

                header("Location: recap.php");
                
                break;
        
        }
   
    } else {
        // On va rediriger le client directement vers la page indiqué pour éviter qu'il est accès à cette page
        header("Location: index.php");

    }


