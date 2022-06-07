<?php
 
 
 ob_start();
session_start();

function kwadratowa($a, $b, $c)
{
    $delta = $b * $b - (4 * $a * $c);
    echo $delta."<br>";
    if ($delta == 0) {
        $x = (-$b) / (2 * $a);
        $wynik = array($delta, $x);
		return $wynik;
    }
    if($delta > 0) {
        
        
        $pier = pierwiastkowanie($delta);
        //echo "<br>PIer: ";
        //var_dump($pier);
        $is_intiger = true;
        $delta_str = (string) $pier;
        //echo "<br>Delta string : ";
        //var_dump($delta_str);
        for($i = 0; $i < strlen($delta_str); $i++){
            if($delta_str[$i] == ',' || $delta_str[$i] == '.' || $delta_str[$i] == chr(8730)){
                $is_intiger = false;
            }
        }
        //var_dump($is_intiger);
        if($is_intiger){
            $x = (-$b - $pier) / (2 * $a);
            
            $x2 = (-$b + $pier) / (2 * $a);
        }
        else{
            $x_x = -$b/(2*$a);
            $zn = "√";
            $licz = array();
            //echo $pier."<br>";
            $dl = strlen($pier);
            //var_dump($dl);
            $pod_pier = "";
            for($i = 0; $i < strlen($pier); $i++){
                //echo "w petli<br>";
                //echo $pier[$i]."<br>";
                if($pier[$i] == chr(8730)){
                   // echo "w ifie<br>";
                    for($k = 0; $k < $i; $k++){
                        //echo "czynnik".$pier[$k]."<br>";
                        array_push($licz, $pier[$k]);
                        
                       
                        
                    }
                    for($z = $i+1; $z < strlen($pier); $z++){
                        $pod_pier .= $pier[$z];
                    }
                    $i = strlen($pier);
                }
            }
            //echo "licz str: <br>";
            //var_dump($licz);
            //$d = count()
            $licz_st = "";
            foreach($licz as &$value){
                $licz_st .= $value;
            }
            //var_dump($licz_st);
            $licz_int = floatval($licz_st);
            //var_dump($licz_int);
            $dd = $licz_int / ($a * 2);
            //var_dump($dd);
            if($dd > 0){
                $x = $x_x."-".$dd."√".$pod_pier;
                $x2 = $x_x."+".$dd."√".$pod_pier;
            }else{
                $x = $x_x."+".$dd."√".$pod_pier;
                $x2 = $x_x."-".$dd."√".$pod_pier;
            }
            

        }
        //echo pierwiastkowanie($delta);
		
		$wyniki = array($delta, $x, $x2);
		return $wyniki;
    }else{
        $wyniki = array(-1);
        return $wyniki;
    }
}

function pierwiastkowanie($number){
    //echo "number: ";
    //var_dump($number);
    //echo "<br>number sqrt: ";

    //var_dump(sqrt($number));
    $is_intiger = true;
    $number_str = (string) sqrt($number);
    //var_dump($number_str);
    for($i = 0; $i < strlen($number_str); $i++){
        if($number_str[$i] == ',' || $number_str[$i] == '.'){
            $is_intiger = false;
        }
    }
    //var_dump($is_intiger);
    if($is_intiger){
        return sqrt($number);
    }else{
        $k = 2;
        $czynniki = array();
        $pier = sqrt($number);
        while($number > 1){
            while($number % $k == 0){
                array_push($czynniki, $k);
                
                $number /= $k;
            }
            $k++;
        }
      
        sort($czynniki);
        $z = count($czynniki);
        //echo "count ".$z;
        $i = 0;
        $przed_sqrt = array();
        $w = array();
        while($i < $z - 1){
            if($czynniki[$i] == $czynniki[$i + 1]){

                array_push($przed_sqrt, $czynniki[$i]);
                $i += 2;
            }
            else{
                array_push($w, $czynniki[$i]);
                $i++;
            }
        }
        
        if(count($przed_sqrt) == 0){
            return "√".$number;
        }
        else{
            $przed = 1;
            for($i = 0; $i < count($przed_sqrt); $i++){
                $przed = $przed * $przed_sqrt[$i];
            }
            $pod = 1;
            
            for($i = 0; $i < count($w); $i++){
                $pod = $pod * $w[$i];
            }

            return $przed.chr(8730).$pod;
        }

    }
}

function kanoniczna($a, $b, $delta){
    $p = (-$b) / (2 * $a);
    $q = (-$delta) / (4 * $a);
    if($p >= 0 && $q >= 0){
        if($a == 1){
            $kanoniczna = "(x -".$p.")<sup>2</sup> + ".$q;
        }
        else{
            $kanoniczna = $a."(x -".$p.")<sup>2</sup>  + ".$q;
        }
        return $kanoniczna;
    }
    if($p >= 0 && $q < 0){
        $q = $q * (-1);
        if($a == 1){
            $kanoniczna = "(x -".$p.")<sup>2</sup> - ".$q;
        }
        else{
            $kanoniczna = $a."(x -".$p.")<sup>2</sup>  - ".$q;
        }
        return $kanoniczna;
    }
    if($p < 0 && $q >= 0){
        $p = $p * (-1);
        if($a == 1){
            $kanoniczna = "(x + ".$p.")<sup>2</sup>  + ".$q;
        }
        else{
            $kanoniczna = $a."(x + ".$p.")<sup>2</sup>  + ".$q;
        }
        return $kanoniczna;
    }
    if($p < 0 && $q < 0){
        $p = $p * (-1);
        $q = $q * (-1);
        if($a == 1){
            $kanoniczna = "(x + ".$p.")<sup>2</sup>  - ".$q;
        }
        else{
            $kanoniczna = $a."(x + ".$p.")<sup>2</sup>  - ".$q;
        }
        return $kanoniczna;
    }
    
}

function iloczynowa($wynik, $a){
    if($wynik[0] == 0){
        $iloczynowa = $a."(x - (".$wynik[1]."))<sup>2</sup> ";
    }else{
        $iloczynowa = $a."(x - (".$wynik[1]."))(x - (".$wynik[2]."))";
    }
    return $iloczynowa;
}




function app(){
    
    // if(!isset($_COOKIE['quanto'])){
    //     setcookie('quanto', 1, time()+3600);
    // }
    // else{
    //     echo 'powieksza, wartpsc';
    //     $quanto = $_COOKIE['quanto'];
    // }

    if(isset($_COOKIE['quanto'])){
        $wieViel = $_COOKIE['quanto'] + 1;
    }
    else{
        $wieViel = 1;
    }

    setcookie('quanto', $wieViel, time()+3600);

    if(!isset($_SESSION['count'])){
        $_SESSION['count'] = 0;
    }else{
        $_SESSION['count']++;
    }
    
    //echo "<br> Cookies ".$_COOKIE['quanto']."<br>";
    if($wieViel <= 6){
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    // $mappe = "wyniki";
    // if(!file_exists($mappe)){
    //     mkdir("wyniki");
    // }
    //echo $_SESSION['count'];
    //var_dump($_SESSION['count']);
    $file = "wynik".$_SESSION['count'].".txt";
    $myFile = fopen($file, "w");
    $wy_a =  "a = ".$a."<br>";
    echo "<div class='container-lg alert alert-secondary'>";
    echo $wy_a;
    $wy_b = "b = ".$b."<br>";
    echo $wy_b;
    $wy_c = "c = ".$c."<br>";
    echo $wy_c;
    $wynik = kwadratowa($a, $b, $c);
    $delta = $wynik[0];
    $wynik_plik = "a = ".$a." b = ".$b." c = ".$c." delta = ".$delta;
    fwrite($myFile, $wynik_plik);
    echo "delta = ".$delta."<br>";
    echo "</div>";
    if($delta == 0){
        //echo "delta = ".$delta."<br>";
        echo "Funkcja ma jedno rozwiązanie: ".$wynik[1]."<br>";
        echo "Postać kanoniczna: f(x) = ".kanoniczna($a, $b, $delta)."<br>";
        echo "Postać iloczynowa: f(x) = ".iloczynowa($wynik, $a);
        $wynik_wynik = "Funkcja ma jedno rozwiązanie".$wynik[1];
        fwrite($myFile, $wynik_wynik);
        $wynik_wynik = "Postać kanoniczna: f(x) = ".kanoniczna($a, $b, $delta);
        fwrite($myFile, $wynik_wynik);
        $wynik_wynik = "Postać iloczynowa: f(x) = ".iloczynowa($wynik, $a);
        fwrite($myFile, $wynik_wynik);
    }
    elseif($delta > 0){
        //echo "delta = ".$delta."<br>";
        echo "<div class='container-lg alert alert-primary'>";
        echo "<div>Funkcja ma dwa rozwiązania: <br>x<sub>1</sub> = ".$wynik[1]."<br>x<sub>2</sub> = ".$wynik[2]."</div>";
        echo "<div>Postać kanoniczna: f(x) = ".kanoniczna($a, $b, $delta)."</div>";
        echo "<div>Postać iloczynowa: f(x) = ".iloczynowa($wynik, $a)."</div>";
        echo "</div>";
        $wynik_wynik = "Funkcja ma dwa rozwiązania";
        fwrite($myFile, $wynik_wynik);
        $wynik_wynik = "x = ".$wynik[1];
        fwrite($myFile, $wynik_wynik);
        $wynik_wynik = "x = ".$wynik[2];
        fwrite($myFile, $wynik_wynik);
        $wynik_wynik = "Postać kanoniczna: f(x) = ".kanoniczna($a, $b, $delta);
        fwrite($myFile, $wynik_wynik);
        $wynik_wynik = "Postać iloczynowa: f(x) = ".iloczynowa($wynik, $a);
        fwrite($myFile, $wynik_wynik);
    }else{
        //echo "delta = ".$delta."<br>";
        echo "Brak miejsc zerowych!!<br>";
        echo "Postać kanoniczna: f(x) = ".kanoniczna($a, $b, $delta)."<br>";
   
    }
    fclose($myFile);
    }else{
        echo "Możesz wykonać tylko pięć działań w ciągu godziny";
    }
    
    
    //unlink("wynik.txt");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Rozwiązanie</title>
    <!-- <script text="type/javascript">
        function generujWykres(a,b,c)
        {
            var canvas = document.getElementById('obrazek');
            var ctx = canvas.getContext('2d');
            var w = canvas.width;
            var h= canvas.height;
            ctx.translate(w/2,h/2);
            
            
            //os x
            ctx.moveTo(-w/2,0);
            ctx.lineTo(w/2,0);

            //os y
            ctx.moveTo(0,-h/2);
            ctx.lineTo(0,h/2);

            
            ctx.stroke();
            step = 0.05;
            for(x = -100; x < 101; x+=step)
            {
                skala=30;
                wartosc = -((a.value * x * x) + (b.value * x) + c.value);

                x1= x + step;
                wartosc2 = -(a.value*x1*x1 + b.value*x1 + c.value)
                ctx.moveTo(x*skala, skala*wartosc);
                ctx.lineTo(x1*skala, skala*wartosc2);
                ctx.stroke();
            }
        }
    </script> -->
</head>
<body>
<nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="kalkulator.html">Kalkulator</a>
          <a class="navbar-brand" href="historia.php">Historia</a>
        </div>
      </nav>
    <div style="font-size: 25px;">
        <?php
            if(isset($_POST["przycisk"])){
                if(empty($_POST["a"]) || empty($_POST["b"]) || empty($_POST["c"])){
                    echo "<b><p font=\"red\"> Wypełnij wszystkie pola!!! <br><br></p>";
                    echo "<a href=\"kalkulator.html\"> Powrót do formularza</a>";
                }else {
                    app();
                    //wykres();
                }
            } 
            else {
                header("kalkulator.html");
            }
        

        ?>
    </div>
   
    <!-- <input type="button" onClick = "generujWykres()" value="Wygeneruj wykres">
     
    <canvas id="obrazek" width="750" height="750" style="border:1px solid #000000;">
    </canvas> -->
</body>
</html>
