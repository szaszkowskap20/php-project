
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Historia</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="kalkulator.html">Kalkulator</a>
          
        </div>
      </nav>

    <div class="container-lg alert alert-dark ">
    
            <?php
                ob_start();
                session_start();
                $sessssion = $_SESSION['count'];
                for($i = 0; $i < $sessssion; $i++){
                    $nazwa = "wynik".$i.".txt";
                    
                    echo "<a href='$nazwa' class='stretched-link text-danger d-flex justify-content-center'>$nazwa</a><br>";
                     
                    
                    
                    
                }
            ?>

    </div>
    <!-- <input type="button" onClick = "generujWykres()" value="Wygeneruj wykres">
     
    <canvas id="obrazek" width="750" height="750" style="border:1px solid #000000;">
    </canvas> -->
</body>
</html>
