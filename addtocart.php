<?php

    session_start();    

    if(!isset($_SESSION["username"])) {
        header("Location: accedi.php"); 
        exit;   
    }

    // Verifica dati GET
    if(isset($_GET["img"]) && isset($_GET["titolo"]) && isset($_GET["prezzo"]) && isset($_GET["quantita"]))
    {
        // Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");

        $img = mysqli_real_escape_string($conn, $_GET["img"]);
        $titolo = mysqli_real_escape_string($conn, $_GET["titolo"]);
        $prezzo = mysqli_real_escape_string($conn, $_GET["prezzo"]);
        $quantita = mysqli_real_escape_string($conn, $_GET["quantita"]);

        mysqli_query($conn, "INSERT INTO carrello (username_utente, titolo, prezzo, quantita, immagine) VALUES " . "('" . $_SESSION['username'] . "', '$titolo', '$prezzo', '$quantita', '$img');") or die ("Errore: ".mysqli_error($conn));
        // Chiudi connessione
        mysqli_close($conn);
    }
?>