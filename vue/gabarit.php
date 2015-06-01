<!doctype html>
<html lang="fr">

  <head>
    <meta charset="UTF-8" />
    <!-- Bootstrap Core CSS -->
    <link href="./business-casual/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./business-casual/css/business-casual.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    <link rel="icon" type="" href="./business-casual/img/favicon.png" />



    <title><?= $titre ?></title>   <!-- title -->
  </head>

  <body>
    
      
      <header>
        <div class="brand">
          <a href="index.php"><h1>Bienvenue sur le Forum Latinus</h1></a>
        </div>
          <div class="address-bar"><p><small>Le forum latinus est un forum qui a pour but<br />  de promouvoir le latin, par l'utilisation de superbe <br /> texte issu du Lorem Ipsum !</small></p></div>
        
      </header>
      
      
      <div class="container">
        <div class="row">
          <div class="box">
            <div class="col-lg-12"  align="center">
              <?= $contenu ?>   <!-- Contenu -->
             </div>
           </div>
         </div>
      </div>

    
      <footer id="footerForum">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <p><b> Forum Latinus </b> - Copyright © Dumas Loïc </p>
            </div>
          </div>
        </div>
      </footer>
      
  </body>
</html>