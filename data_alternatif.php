<?php 

  session_start();
  include_once 'apps/config/config.php';
  include_once 'kelola/edit_alternatif.php';

    // read
    $alternatif = tampil("SELECT * FROM tbl_alternatif ORDER BY id ASC");


    // tambah
      if(isset($_POST["submit"])){
        if(tambah($_POST) > 0 ){
          // atur session
          $_SESSION['pesan'] = "Data berhasil ditambahkan!";
          header("Location: data_alternatif.php");
          exit;
        }
        else{
          $_SESSION['pesan'] = "Data gagal ditambahkan!";
          header("Location: data_alternatif.php");
          exit;
        }
      }


      // ubah
      if( isset($_POST["submit2"])){
        //cek apakah data udah diubah
        if(ubah($_POST) > 0){
          $_SESSION['pesan'] = "Data berhasil diperbarui!";
          header("Location: data_alternatif.php");
          exit;
        }
        else{
          $_SESSION['pesan'] = "Data gagal diperbarui!";
          header("Location: data_alternatif.php");
          exit;
        }
    }
  
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Data Alternatif - SPK WP</title>
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
  <div class="content-wrapper "style="background-color: #f2f7ff;">
    <div class="container-fluid">

        
        <!-- Modal tambah-->
    <div class="card mb-3" style="border-radius: 20px; border:none;">
      <div class="row ms-3 mt-3" style="color:#525252;">
          <h4 style="margin-top:75px;">Data Alternatif</h4>
          
        </div>
        <div class="row ms-3 mt-3" style="color:#7E7474; font-weight:500;">
          <h6>Data alternatif merupakan data yang berisi objek penilaian berupa kandidat-kandidat terhadap nilai kriteria yang ditentukan.</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col align-self-start ms-3">
              <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambah">
              <i class="fa fa-plus"></i>
              Tambah Alternatif
              </button>
                     
              <div class="modal fade" id="tambah"  aria-labelledby="tPegawai" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="tPegawai">FORM TAMBAH ALTERNATIF</h5>
                  
                    </div>
                  <div class="modal-body">  
 <!-- ########################## Form tambah data Alternatif ##################### -->
                    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">      
                      <div class="mb-3 row">
                          <label for="alternatif" class="col-sm-4 col-form-label ms-3">Alternatif</label>
                          <div class="col-sm">
                          <input type="text" class="form-control" id="alternatif" name="alternatif" required placeholder="Alternatif">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="k1" class="col-sm-4 col-form-label ms-3">C1 Harga kos</label>
                          <div class="col-sm">
                          <input type="number" class="form-control" id="k1" name="k1" required placeholder="Harga kos">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="k2" class="col-sm-4 col-form-label ms-3">C2 Jarak ke kampus	</label>
                          <div class="col-sm">
                          <input type="number" class="form-control" id="k2" name="k2" required placeholder="Jarak ke kampus">
                          </div>
                      </div>
                      
                      <div class="mb-3 row">
                          <label for="k3" class="col-sm-4 col-form-label ms-3">C3 Akses jalan</label>
                          <div class="col-sm">
                          <input type="number" class="form-control" id="k3" name="k3" required placeholder="Akses jalan">
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="k4" class="col-sm-4 col-form-label ms-3">C4 Kepadatan Penduduk</label>
                          <div class="col-sm">
                          <input type="number" class="form-control" id="k4" name="k4" required placeholder="Kepadataan Penduduk">                        
                          </div>
                      </div>
                      <div class="mb-3 row">
                          <label for="k5" class="col-sm-4 col-form-label ms-3">C5 Jam malam</label>
                          <div class="col-sm">
                          <input type="number" class="form-control" id="k5" name="k5" required placeholder="Jam malam">                        
                          </div>
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="submit"><i class="far fa-save"></i> Simpan</button>
                      </div>
                    </form>
 
                     <!-- ########################## FORM TAMBAH DATA ################################ -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      


<!-- ########################## MODAL ALERT  ################################  -->
            <?php if(isset($_SESSION['pesan'])) : ?>

            <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
               <?= $_SESSION['pesan']; ?> 
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          
            <?php  
              session_destroy(); //menghilangkan session
              endif; 
            ?>
<!-- ########################## AKHIR MODAL ALERT ################################                      -->

<!-- ########################## TABEL ################################                      -->

            <div class="table-responsive rounded mt-3 ms-3 me-3">
                <table class="table table-bordered table-hover table-striped text-center" cellspacing="0">
                  <tr class="table-success">
                    <th>No</th>
                    <th>Nama</th>
                    <th>C1 Harga kos</th>
                    <th>C2 Jarak ke kampus</th>
                    <th>C3 Akses jalan</th>
                    <th>C4 Kepadatan Penduduk</th>
                    <th>C5 Jam malam</th>
                    <th>ِAksi</th>
                  </tr>

                  <!-- loop untuk table -->
                  <?php $i = 1; ?>
                        <?php foreach($alternatif as $row): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $row["alternatif"]; ?></td>
                            <td><?= $row["k1"]; ?></td>
                            <td><?= $row["k2"]; ?></td>
                            <td><?= $row["k3"]; ?></td>
                            <td><?= $row["k4"]; ?></td>
                            <td><?= $row["k5"]; ?></td>

                            <td>
                              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $row["id"]; ?>">
                                Ubah
                              </button>
                                  ||
                              <a onclick="return confirm('Yakin menghapus data ini?');" href="hapus_alternatif.php?id=<?=$row["id"]; ?>" class="btn btn-danger btn-sm"   >
                                Hapus
                              </a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                            <?php endforeach ?>
                </table>
              <!-- akhihr tabel -->
              <!-- <div class="card-footer small text-muted"> Update <?= date("l, d-M-Y H:i:s") ?></div> -->
          </div>
  <!-- ########################## AKHIR TABEL ################################                      -->
      </div>
    </div>
  <!-- ########################## AKHIR CARD TABEL ################################                      -->
  <div class="table-responsive rounded mt-3 ms-3 me-3">
                <table class="table table-bordered table-hover table-striped text-center" cellspacing="0">
                  <tr class="table-success">
                    <th>Nilai</th>
                    <th>C1 Harga kos</th>
                    <th>C2 Jarak ke kampus</th>
                    <th>C3 Akses jalan</th>
                    <th>C4 Kepadatan Penduduk</th>
                    <th>C5 Jam malam</th>
                  </tr>

                  <tr>
                    <td>4</td>
                    <td>Sangat Banyak</td>
                    <td>Sangat Mahal (> Rp30.000)</td>
                    <td>Jauh (> 4 km)</td>
                    <td>Max 100 orang</td>
                    <td>Sangat Lengkap</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Banyak</td>
                    <td>Mahal (<= Rp30.000)</td>
                    <td>Agak Jauh (5-10 km)</td>
                    <td>Max 75 orang</td>
                    <td>Lengkap</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Sedang</td>
                    <td>Terjangkau (<= Rp20.000)</td>
                    <td>Dekat (2-3 km)</td>
                    <td>Max 50 orang</td>
                    <td>Kurang Lengkap</td>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Sedikit</td>
                    <td>Murah (<= Rp10.000)</td>
                    <td>Sangat Dekat (0-1 km)</td>
                    <td>Max 25 orang</td>
                    <td>Tidak Lengkap</td>
                  </tr>
                </table>
              <!-- akhihr tabel -->
              <!-- <div class="card-footer small text-muted"> Update <?= date("l, d-M-Y H:i:s") ?></div> -->
          </div>  
</div>
 <!-- ########################## AKHIR CONTAINER ################################                      --> 
</div>  
<!-- ########################## AKHIR WRAPPER ################################                      -->
       

<!-- awal modal ubah data -->

<?php 

?>

<?php $i = 0; ?>
<?php foreach($alternatif as $row): $i++; ?>
<div class="modal fade" id="edit<?= $row["id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="staticBackdropLabel">FORM UBAH ALTERNATIF</h5>
      </div>
      <div class="modal-body">
      <form action="" method="post" enctype="multipart/form-data" autocomplete="off"> 
            <div class="mb-3">
                <input type="hidden" name="id" id="id" value="<?= $row["id"]; ?>">
            </div>     
            <div class="mb-3 row">
                <label for="alternatif" class="col-sm-4 col-form-label ms-3">Alternatif</label>
                <div class="col-sm">
                    <input type="text" class="form-control" id="alternatif" name="alternatif" required placeholder="Alternatif" value="<?= $row["alternatif"]; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="k1" class="col-sm-4 col-form-label ms-3">C1 Harga kos</label>
                <div class="col-sm">
                <input type="number" class="form-control" id="k1" name="k1" required placeholder="Harga kos" value="<?= $row["k1"]; ?>">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="k2" class="col-sm-4 col-form-label ms-3">C2 Jarak ke kampus</label>
                <div class="col-sm">
                <input type="number" class="form-control" id="k2" name="k2" required placeholder="Jarak ke kampus" value="<?= $row["k2"]; ?>">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="k3" class="col-sm-4 col-form-label ms-3">C3 Akses jalan</label>
                <div class="col-sm">
                <input type="number" class="form-control" id="k3" name="k3" required placeholder="Akses jalan" value="<?= $row["k3"]; ?>">
            </div>
            </div>
            <div class="mb-3 row">
                <label for="k4" class="col-sm-4 col-form-label ms-3">C4 Kepadatan Penduduk</label>
                <div class="col-sm">
                <input type="number" class="form-control" id="k4" name="k4" required placeholder="Kepadatan Penduduk" value="<?= $row["k4"]; ?>">                        
            </div>
            </div>
            <div class="mb-3 row">
                <label for="k5" class="col-sm-4 col-form-label ms-3">C5 Jam malam</label>
                <div class="col-sm">
                <input type="number" class="form-control" id="k5" name="k5" required placeholder="Jam malam" value="<?= $row["k5"]; ?>">                        
            </div>
            </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="submit2"><i class="far fa-save"></i> Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>
<!-- akhir mdodal ubah data -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  </body>
</html>
