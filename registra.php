<?php
    session_start();

    //Verifica l'esistenza di dati provenienti dalla richiesta POST (ci saranno sempre poiche ho messo required nell'<input>, quindi la verifica lato client, ma faccio lo stesso la verifica anche lato server)
    if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["psw"]) && isset($_POST["cpsw"])) {
        //Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");
        //Faccio l'escape di cio' che ricevo dal form per evitare problemi di SQL injection
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $password = mysqli_real_escape_string($conn, $_POST["psw"]);
        $cpassword = mysqli_real_escape_string($conn, $_POST["cpsw"]);

        $usernamecheck = mysqli_query($conn, "SELECT * FROM utenti WHERE username = '".$username."'");
        $emailcheck = mysqli_query($conn, "SELECT * FROM utenti WHERE email = '".$email."'");

        if (mysqli_num_rows($usernamecheck) > 0) {
            $usrerror = 'Username già in uso';
        } else if (mysqli_num_rows($emailcheck) > 0) {
            $mailerror ='Email già in uso';
        } else if ($password != $cpassword) {
            echo 'La conferma della password non corrisponde';
            } else {
                $passmd5 = md5($password); 
                $query = "INSERT INTO utenti (username, email, password) VALUES ('$username', '$email', '$passmd5');";
                $res = mysqli_query($conn, $query) or die ("Errore: ".mysqli_error($conn));

                if ($res) {
                    header("Location: reg_success.html"); 
                    exit();
                }
                else {
                    header("Location: reg_fail.html");
                    exit();
                }
            }
    } else {
        echo "<h1>Devi compilare tutti i campi</h1>";
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registration.css">
    <script src="registration_validation.js" defer="true"></script>
   </head>
<body>
  <div class="wrapper">
    <h2>Registrazione</h2>
    <form action="registra.php" method="POST">
      <div class="input-box">
        <input type="text" placeholder="Inserisci il tuo username" id="username" name="username" required>
      </div>
      <div class="input-box">
        <input type="text" placeholder="Inserisci la tua email" id="email" name="email" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Inserisci password" id="psw" name="psw" required>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Conferma password" id="cpsw" name="cpsw" required>
      </div>
      <div class="policy">
        <input type="checkbox" required>
        <h3>Accetto tutti i termini & condizioni</h3>
      </div>
      <div class="input-box button">
        <input type="Submit" value="Registrati" name="btn-save">
      </div>
      <div class="text">
        <h3>Possiedi già un account? <a href="index.html">Accedi adesso</a></h3>
      </div>
    </form>
    <div id="error">
        <?php
        if (mysqli_num_rows($usernamecheck) > 0) {
            print_r($usrerror);
        } else if (mysqli_num_rows($emailcheck) > 0) {
            print_r($mailerror);
        } 
        ?>
    </div>
  </div>
</body>
</html>