<?php 
  include_once 'apps/config/config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Perhitungan - SPK WP</title>
  </head>
  <body>

  <header class="fixed-nav sticky-footer" id="page-top" >
      <!-- Navigation-->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" style="margin-left:40px;" id="judul" href="index.php">SPK - WP</a>

        <ul class="navbar-nav bg-dark " id="exampleAccordion">
          <a class="nav-link" href="index.php">
            <span class="nav-link-text">Home</span>
          </a>

          <a class="nav-link" href="data_kriteria.php">
            <span class="nav-link-text">Data Kriteria</span>
          </a>

          <a class="nav-link" href="data_alternatif.php">
            <span class="nav-link-text">Data Alternatif</span>
          </a>

          <a class="nav-link" href="perhitungan.php">
            <span class="nav-link-text">Perhitungan</span>
          </a>
        </ul>

        <ul class="navbar-nav ms-auto">
          <li class="nav-item me-3">
            <a class="navbar-brand">KLP 4 - SPK B</a>
          </li>
        </ul>
      </nav>
    </header>
    
  <div class="content-wrapper " style="background-color: #f2f7ff;">
    <div class="container-fluid">

        
                
        <div class="card" style="border-radius: 20px; border:none; padding-bottom:20px;">
            <!-- <h6 class="card-header bg-primary text-white">Perhitungan</h6> -->
            <div class="row ms-3 mt-3" style="color:#525252;">
              <h4 style="margin-top:75px;">Perhitungan</h4>      
            </div>
          <div class="card-body mt-3">
                

            <!-- function -->

            <?php 

                function jml_kriteria(){
                    include_once 'apps/config/config.php';
                    global $conn;
                    $kriteria = $conn->query("SELECT * FROM tbl_kriteria ");
                    return $kriteria->num_rows;
                }
                function jml_alternatif(){
                    include_once 'apps/config/config.php';
                    global $conn;
                    $alternatif = $conn->query("SELECT * FROM tbl_alternatif ");
                    return $alternatif->num_rows;
                }
                function getBobot(){
                    include_once 'apps/config/config.php';
                    global $conn;
                    $bobot = $conn->query("SELECT * FROM tbl_kriteria ");
                    if(!$bobot){
                        echo $conn->connect_errno." - ".$conn->connect_error;
					        	exit();
                    }
                    $i=0;
                    while ($row = $bobot->fetch_assoc()) {
                        @$bbt[$i] = $row["bobot"];
                        $i++;
                    }
                    return $bbt;
                }

                function getJenis(){
                    include_once 'apps/config/config.php';
                    global $conn;
                    $jenis = $conn->query("SELECT * FROM tbl_kriteria ");
                    if(!$jenis){
                        echo $conn->connect_errno." - ".$conn->connect_error;
                        exit();
                    }
                    $i=0;
                    while ($row = $jenis->fetch_assoc()) {
                        @$jns[$i] = $row["jns"];
                        $i++;
                    }
                    return $jns;
                }

                function getNamaAlternatif(){
                    include_once 'apps/config/config.php';
                    global $conn;
                    $alternatif = $conn->query("SELECT * FROM tbl_alternatif ");
                    if(!$alternatif){
                        echo $conn->connect_errno." - ".$conn->connect_error;
                        exit();
                    }
                    $i=0;
                    while ($row = $alternatif->fetch_assoc()) {
                        @$alt[$i] = $row["alternatif"];
                        $i++;
                    }
                    return $alt; //perubahan 2
                }

                function getAlternatif(){
                    include_once 'apps/config/config.php';
                    global $conn;
                    $alternatif = $conn->query("SELECT * FROM tbl_alternatif ");
                    if(!$alternatif){
                        echo $conn->connect_errno." - ".$conn->connect_error;
                        exit();
                    }
                    $i=0;
                    while ($row = $alternatif->fetch_assoc()) {
                        @$alt[$i][0] = $row["k1"];
                        @$alt[$i][1] = $row["k2"];
                        @$alt[$i][2] = $row["k3"];
                        @$alt[$i][3] = $row["k4"];
                        @$alt[$i][4] = $row["k5"];
                        $i++;
                    }
                    return $alt;  // perubahan 1
                }

                function cmp($a, $b){
                    if ($a == $b) {
                        return 0;
                    }
                    return ($a < $b) ? -1 : 1;
                }

                function print_ar(array $x){	//just for print array
                    echo "<pre>";
                    print_r($x);
                    echo "</pre></br>";
                }
            ?>

            <?php 
                $alt = getAlternatif();
                $namaAlternatif = getNamaAlternatif();
                end($namaAlternatif);
                $arl2 = key($namaAlternatif)+1;
                $bobot = getBobot();
                $jenis = getJenis();
                $jmlh_krit = jml_kriteria();
                $jmlh_alt = jml_alternatif();
                $nbbt = 0;
                $nbkep = 0;
            
            

            // Awal Matriks Alternatif - Kriteria
                echo '<h6 class="text-center fw-bold">Matriks Alternatif - Kriteria</h6>';
                echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead><tr><th> Alternatif / Kriteria</th> <th>C1</th> <th>C2</th> <th>C3</th> <th>C4</th> <th>C5</th> </tr> </thead>";
                    for($i=0;$i<$jmlh_alt;$i++){

                        echo "<tr><td><b>A".($i+1)."</b></td>";

                        for($j=0;$j<$jmlh_krit;$j++){

                            echo "<td>".$alt[$i][$j]."</td>";
                        }
                        echo "</tr>";
                    }
                echo "</table><hr>";
            // Akhir Matriks Alternatif - Kriteria


            // Awal Perhitungan bobot
              echo '<h6 class="text-center fw-bold mt-5">Perhitungan Bobot Kepentingan</h6>';
              echo "<table class='table table-striped table-bordered table-hover'>";
              echo "<thead><tr><th></th><th>C1</th><th>C2</th><th>C3</th><th>C4</th><th>C5</th><th>Jumlah</th></tr></thead>";
              echo "<tr><td><b>Kepentingan</b></td>";
              for($i=0;$i<$jmlh_krit;$i++){
                $nbbt = $nbbt + $bobot[$i];
                echo "<td>".$bobot[$i]."</td>";
              }
              echo "<td>".$nbbt."</td></tr>";
              echo "<tr><td><b>Bobot Kepentingan</b></td>";
              for($i=0;$i<$jmlh_krit;$i++){
                $bobot_kep[$i] = ($bobot[$i]/$nbbt);
                $nbkep = $nbkep + $bobot_kep[$i];
                echo "<td>".round($bobot_kep[$i],3)."</td>";
              }
              echo "<td>".$nbkep."</td></tr>";
              echo "</table><hr>";
            // akhir Perhitungan bobot


            // Awal Perhitungan Wj / hitung pangkat
            echo '<h6 class="text-center fw-bold mt-5">Perhitungan Pangkat (W)</h6>';
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th></th><th>C1</th><th>C2</th><th>C3</th><th>C4</th><th>C5</th></tr></thead>";
              echo "<tr><td><b>Jenis</b></td>";
              for($i=0;$i<$jmlh_krit;$i++){
                echo "<td>".($jenis[$i])."</td>";
              }
              echo "</tr>";
              echo "<tr><td><b>Pangkat</b></td>";
              for($i=0;$i<$jmlh_krit;$i++){
                if($jenis[$i]=="Cost"){
                  $pangkat[$i] = (-1) * $bobot_kep[$i];
                  echo "<td>".round($pangkat[$i],3)."</td>";
                }
                else{
                  $pangkat[$i] = $bobot_kep[$i];
                  echo "<td>".round($pangkat[$i],3)."</td>";
                }
              }
              echo "</tr>";
            echo "</table><hr>";



            // Perhitungan vektor S
            echo '<h6 class="text-center fw-bold mt-5">Perhitungan Vektor S </h6>';
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th>Alternatif</th><th>S</th></tr></thead>";
            
            for($i=0;$i<$jmlh_alt;$i++){
              echo "<tr><td><b>A".($i+1)."</b></td>";
              for($j=0;$j<$jmlh_krit;$j++){
                $s[$i][$j] = pow(($alt[$i][$j]),$pangkat[$j]);
              }
              $ss[$i] = $s[$i][0] * $s[$i][1] * $s[$i][2] * $s[$i][3]*$s[$i][4];
              // rsort($ss);
              echo "<td>".round($ss[$i],3)."</td></tr>";
            }
            echo "</table><hr>";
            // akhir perhitungan vektor s



            // Awal perhitungan V
            echo '<h6 class="text-center fw-bold mt-5">Perhitungan V </h6>';
            echo "<table class='table table-striped table-bordered table-hover'>";
            echo "<thead><tr><th>Alternatif</th><th>V</th></tr></thead>";
            $total = 0;
            for($i=0;$i<$jmlh_alt;$i++){
              $total = $total + $ss[$i];
            }
            for($i=0;$i<$jmlh_alt;$i++){
              echo "<tr><td><b>".$namaAlternatif[$i]."</b></td>";
              $v[$i] = round($ss[$i]/$total,3);
              echo "<td>".$v[$i]."</td></tr>";
            }
            echo "</table><hr>";
            uasort($v,'cmp');
            // Akhir perhitungan V


            
            ?>

        
              <?php 
              
              for($i=0;$i<$arl2;$i++){ //new for 8 lines below
                if($i==0)
                  echo "<div class='alert alert-dismissible alert-success'><b><i>Dari tabel tersebut dapat disimpulkan bahwa ".$namaAlternatif[array_search((end($v)), $v)]." mempunyai hasil paling tinggi, yaitu ".current($v);
                elseif($i==($arl2-1))
                  echo "</br>Dan terakhir ".$namaAlternatif[array_search((prev($v)), $v)]." dengan nilai ".current($v).".</i></b></div>";
                else
                  echo "</br>Lalu diikuti dengan ".$namaAlternatif[array_search((prev($v)), $v)]." dengan nilai ".current($v);
              }
            ?>
            </div>        
        </div>
    </div>     
    <!-- akhir container -->
  </div>
 <!-- ########################## AKHIR content wrapper ################################                      --> 
</div>  
<!-- ########################## AKHIR Navigasi################################                      -->

  </body>
</html>
