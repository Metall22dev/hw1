<?php
    session_start();

    //Verifica l'esistenza di dati provenienti dalla richiesta POST (ci saranno sempre poiche ho messo required nell'<input>, quindi la verifica lato client, ma faccio lo stesso la verifica anche lato server)
    if (isset($_POST["username"]) && isset ($_POST["psw"]))
    {
        //Connessione al database
        $conn = mysqli_connect("localhost", "root", "", "account");
        //Faccio l'escape di cio' che ricevo dal form per evitare problemi di SQL injection
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["psw"]);
        $passmd5 = md5($password);
        //Cerca utente con quelle credenziali
        $query = "SELECT * FROM utenti WHERE username = '".$username."' AND password = '".$passmd5."'";
        $res = mysqli_query($conn, $query) or die ("Errore: ".mysqli_error($conn));
        //Verifico se sono riuscito ad accedere (quindi se le credenziali corrette)
        if (mysqli_num_rows($res) > 0) {
            //Imposto la variabile di sessione
            $_SESSION["username"] = $_POST["username"];
            // Torno alla pagina una volta loggato
            header("Location: home_loggato.php");
            exit;
        }
        else 
        {
            $errore = 'Username o password errati';  
        }
    
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sannino's Auto</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="script.js" defer="true"></script>
</head>

<body class="no-scroll">
  <div class="overlay">
  </div>
  <header>
    <div class="nav-bar">
      <div class="logo">
        <a href="index.html">Sannino's Auto</a>
      </div>
      <div class="menu">
        <ul>
          <li><a id="home" class="active">Home<span>.</span></a></li>
          <li><a id="listino">Listino</a></li>
          <li><a id="tecnologia">Tecnologia</a></li>
          <li><a id="produzione">Produzione</a></li>
          <li><a id="accedi">Accedi</a></li>
        </ul>
      </div>
    </div>
    <div class="hero">
      <div class="row">
        <div class="left-sec">
          <div class="content">
            <h2><span>BENVENUTO</span><br>Utente</h2>
            <p>È brutto chiamarti in questo modo, ma purtroppo non so chi sei. Effettua l'accesso per farti riconoscere e per poter sbloccare tutte le funzionalità del sito.</p>
          </div>
          <button class="accedi-btn">
            <a href="#">Accedi</a><span><i class="fa fa-arrow-circle-o-right"></i></span>
          </button>
          <div class="information">
            <div class="production">
              <p>Production</p>
              <h2>1966-2019</h2>
            </div>
            <div class="production">
              <p>Designer</p>
              <h2>George Angersbach</h2>
            </div>
          </div>
        </div>
        <div class="right-sec">
          <div class="my-car">
            <div><img src="images/1.png"></div>
            <div><img src="images/2.png"></div>
            <div><img src="images/3.png"></div>
            <div><img src="images/4.png"></div>
            <div><img src="images/5.png"></div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <div class="login-popup" id="Login" style="display:block">
    <form action="accedi.php" method="POST" class="form-container">
      <button type="button" class="btn cancel">X</button>
      <h1>Accedi</h1>
  
      <label for="username"><b>Nome utente</b></label>
      <input type="text" placeholder="Inserisci nome utente" name="username" required>
  
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Inserisci password" name="psw" required>
      <?php
        echo "<p id='err' style='color:red; display:block; margin-bottom:2vh'>$errore</p>";
      ?>
      <p>Non sei ancora registrato?</p><a href="registration.html">Registrati adesso!</a>
  
      <button type="submit" id="invia" class="btn">Login</button>
    </form>
  </div>
  <footer>
    <div class="testo-footer">
      <p>STEFANO SANNINO 1000002144 HW1</p>
    </div>
    <div class="social-media">
      <ul>
        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
      </ul>
    </div>
  </footer>

</script>
</body>
</html>