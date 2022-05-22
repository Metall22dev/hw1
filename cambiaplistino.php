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
            header("Location: listino.php");
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
  <link rel="stylesheet" type="text/css" href="listino.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <script src="listino.js" defer="true"></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</head>

<body class="no-scroll">
  <div class="overlay"></div>
  <!--HEADER (CONTENTENTE NAVBAR)-->
  <header>
    <div class="nav-bar">
      <div class="logo">
        <a href="#">Sannino's Auto</a>
      </div>
      <div class="menu">
        <ul>
          <li><a href="home_loggato.php">Home</a></li>
          <li><a href="#" class="active">Listino<span>.</span></a></li>
          <li><a href="#">Tecnologia</a></li>
          <li><a href="#">Produzione</a></li>
          <li>
            <div class="dropdown">
            <?php echo '<button class="dropbtn">' . $_SESSION["username"] .' <i class="arrow down"></i></button>'; ?>
              <div id="myDropdown" class="dropdown-content">
                  <a id ="logout" href="logout.php">Logout</a>
                  <a id="cambiap" href="#">Cambia profilo</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>
  <!--LOGIN-->
  <div class="login-popup" id="Login" style="display:block">
    <form action="cambiaplistino.php" method="POST" class="form-container">
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
  <!--VEICOLI-->
  <section class="vehicles" id="vehicles">

  <h1 class="heading"> popular vehicles</h1>

  <div class="swiper vehicles-slider">

      <div class="swiper-wrapper">

          <div class="swiper-slide box">
              <img src="image/vehicle-1.png" alt="">
              <div class="content">
                  <h3>new model</h3>
                  <div class="price"> <span>price : </span> $62,000/- </div>
                  <p>
                      new
                      <span class="fas fa-circle"></span> 2021
                      <span class="fas fa-circle"></span> automatic
                      <span class="fas fa-circle"></span> petrol
                      <span class="fas fa-circle"></span> 183mph
                  </p>
                  <a href="#" class="btn">check out</a>
              </div>
          </div>

          <div class="swiper-slide box">
              <img src="image/vehicle-2.png" alt="">
              <div class="content">
                  <h3>new model</h3>
                  <div class="price"> <span>price : </span> $62,000/- </div>
                  <p>
                      new
                      <span class="fas fa-circle"></span> 2021
                      <span class="fas fa-circle"></span> automatic
                      <span class="fas fa-circle"></span> petrol
                      <span class="fas fa-circle"></span> 183mph
                  </p>
                  <a href="#" class="btn">check out</a>
              </div>
          </div>

          <div class="swiper-slide box">
              <img src="image/vehicle-3.png" alt="">
              <div class="content">
                  <h3>new model</h3>
                  <div class="price"> <span>price : </span> $62,000/- </div>
                  <p>
                      new
                      <span class="fas fa-circle"></span> 2021
                      <span class="fas fa-circle"></span> automatic
                      <span class="fas fa-circle"></span> petrol
                      <span class="fas fa-circle"></span> 183mph
                  </p>
                  <a href="#" class="btn">check out</a>
              </div>
          </div>

          <div class="swiper-slide box">
              <img src="image/vehicle-4.png" alt="">
              <div class="content">
                  <h3>new model</h3>
                  <div class="price"> <span>price : </span> $62,000/- </div>
                  <p>
                      new
                      <span class="fas fa-circle"></span> 2021
                      <span class="fas fa-circle"></span> automatic
                      <span class="fas fa-circle"></span> petrol
                      <span class="fas fa-circle"></span> 183mph
                  </p>
                  <a href="#" class="btn">check out</a>
              </div>
          </div>

          <div class="swiper-slide box">
              <img src="image/vehicle-5.png" alt="">
              <div class="content">
                  <h3>new model</h3>
                  <div class="price"> <span>price : </span> $62,000/- </div>
                  <p>
                      new
                      <span class="fas fa-circle"></span> 2021
                      <span class="fas fa-circle"></span> automatic
                      <span class="fas fa-circle"></span> petrol
                      <span class="fas fa-circle"></span> 183mph
                  </p>
                  <a href="#" class="btn">check out</a>
              </div>
          </div>

          <div class="swiper-slide box">
              <img src="image/vehicle-6.png" alt="">
              <div class="content">
                  <h3>new model</h3>
                  <div class="price"> <span>price : </span> $62,000/- </div>
                  <p>
                      new
                      <span class="fas fa-circle"></span> 2021
                      <span class="fas fa-circle"></span> automatic
                      <span class="fas fa-circle"></span> petrol
                      <span class="fas fa-circle"></span> 183mph
                  </p>
                  <a href="#" class="btn">check out</a>
              </div>
          </div>

      </div>

      <div class="swiper-pagination"></div>

  </div>

  </section>

  <!--NEGOZIO-->
  <form id='search'>
          <h1>Cerca una cryptovaluta per visualizzarne il simbolo</h1>
          <label><input type='text' id ='content'></label>	
          
          <label><input class="submit" type='submit'></label>

        </form>
          
        <section id="album-view">
        </section>

  <section class="listino-completo">
  <div data-choice-id="blep" data-question-id="one">
      <img src="images/1_1.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="happy" data-question-id="one">
      <img src="./images/1_2.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="sleeping" data-question-id="one">
      <img src="./images/1_3.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="dopey" data-question-id="one">
      <img src="./images/1_4.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="burger" data-question-id="one">
      <img src="./images/1_5.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="cart" data-question-id="one">
      <img src="./images/1_6.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="nerd" data-question-id="one">
      <img src="./images/1_7.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="shy" data-question-id="one">
      <img src="./images/1_8.jpg"/>
      <p>asdadsa</p>
  </div>

  <div data-choice-id="sleepy" data-question-id="one">
      <img src="./images/1_9.jpg"/>
      <p>asdadsa</p>
  </div>
  </section>

  <!--FOOTER-->
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