<?php
    include "index.php";

    
    if(isset($_POST["imie"]) && isset($_POST["nazwisko"]) && isset($_POST["email"]) && isset($_POST["placa_netto"]) && isset($_POST["dodaj"]))
    {
        $czy_wykonac = true;
        if($_POST["imie"] == "")
        {
            echo "pusta";
            sleep(2);
            header("location:index.php");
        }
        // if(!isset($_POST["imie"]))
        // {
        //     echo "brak imienia<br>";
        //     $czy_wykonac = false;
        // }
        // if(!isset($_POST["nazwisko"]))
        // {
        //     echo "brak nazwiska<br>";
        //     $czy_wykonac = false;
        // }
        // if(!isset($_POST["email"]))
        // {
        //     echo "brak emaila<br>";
        //     $czy_wykonac = false;
        // }
        // elseif(!strpos($_POST["email"],"@"))
        // {
        //     echo "nieprawidłowy format emaila<br>";
        //     $czy_wykonac = false;
        // }
        // if(!isset($_POST["placa_netto"]))
        // {
        //     echo "brak płacy netto<br>";
        //     $czy_wykonac = false;
        // }
    
        // if($czy_wykonac)
        // {
        //     dodawanie($_POST["imie"], $_POST["nazwisko"], $_POST["email"],$_POST["placa_netto"]);
        // }
    }
?>