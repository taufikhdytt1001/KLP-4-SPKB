<?php 
  session_start();
  include_once 'apps/config/config.php';
  include_once 'kelola/edit_kriteria.php';

    // read
    $kriteria = tampil("SELECT * FROM tbl_kriteria ORDER BY id ASC");

    // tambah
      if(isset($_POST["submit"])){
        if(tambah($_POST) > 0 ){
          // atur session
          $_SESSION['pesan'] = "Data berhasil ditambahkan!";
          header("Location: data_kriteria.php");
          exit;
        }
        else{
          $_SESSION['pesan'] = "Data gagal ditambahkan!";
          header("Location: data_kriteria.php");
          exit;
        }
      }


      // ubah
      if( isset($_POST["submit2"])){
        //cek apakah data udah diubah
        if(ubah($_POST) > 0){
          $_SESSION['pesan'] = "Data berhasil diperbarui!";
          header("Location: data_kriteria.php");
          exit;
        }
        else{
          $_SESSION['pesan'] = "Data gagal diperbarui!";
          header("Location: data_kriteria.php");
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
    
    <title>Data Kriteria - SPK WP</title>
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
            <a class="navbar-brand">KOS KOS</a>
          </li>
        </ul>
      </nav>
    </header>
    
    <div class="content-wrapper "style="background-color: #f2f7ff;">
      <div class="container-fluid">
          
          <!-- Modal tambah-->
      <div class="card mb-3" style="border-radius: 20px; border:none;">
          <div class="row ms-3 mt-3" style="color:#525252;">
            <h4 style="margin-top:75px;">Data Kriteria</h4>
          </div>

          <div class="row ms-3 mt-3" style="color:#7E7474; font-weight:500;">
            <h6>Data kriteria merupakan data ukuran yang dijadikan acuan dalam melakukan penilaian terhadap suatu objek.</h6>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col align-self-start ms-3">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambah">
                Tambah Kriteria
                </button>
                      
                <div class="modal fade" id="tambah"  aria-labelledby="tPegawai" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header bg-primary text-white">
                          <h5 class="modal-title" id="tPegawai">FORM TAMBAH KRITERIA</h5>
                    
                      </div>
                    <div class="modal-body ">  
  <!-- ########################## Form tambah data Kriteria ##################### -->
                      <form action="" method="post" enctype="multipart/form-data" autocomplete="off">      
                        <div class="mb-3 row">
                            <label for="kriteria" class="col-sm-4 col-form-label ms-3">Kriteria</label>
                            <div class="col-sm">
                            <input type="text" class="form-control" id="kriteria" name="kriteria" required placeholder="Kriteria">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="bobot" class="col-sm-4 col-form-label ms-3">Bobot</label>
                            <div class="col-sm">
                            <input type="number" class="form-control" id="bobot" name="bobot" required placeholder="Nilai">
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            <label for="jns" class="col-sm-4 col-form-label ms-3">Jenis</label>
                            <div class="col-sm">
                            <select class="form-select" id="jns" name="jns" required>
                                    <option selected disabled>-Pilih-</option>
                                    <option value="Benefit">Benefit</option>
                                    <option value="Cost">Cost</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row ms-1">
                            <div class="col-sm">
                            <div class="form-text">
                                  <span style="font-size: 14px;">Keterangan:</span>
                                <br>           
                                  <span class="fw-6 me-2">Jenis :</span>
                                  <span style="margin-right: 15px;">Benefit = Semakin besar semakin baik,</span>                     
                                  <span style="margin-right: 15px;">Cost = Semakin kecil semakin baik</span>            
                            </div>
                            </div>
                          </div>
                        </div>
                        
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary" name="submit"><i class="far fa-save"></i> Simpan</button>
                        </div>
                      </form>
  <!-- ########################## FORM TAMBAH DATA ################################  -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <!-- ########################## MODAL ALERT  ################  -->
                          <?php if(isset($_SESSION['pesan'])) : ?>
              
                          <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                            <?= $_SESSION['pesan']; ?> 
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        
                          <?php  
                            session_destroy(); //menghilangkan session
                            endif; 
                          ?>
              <!-- ########################## AKHIR MODAL ALERT ####################                  -->
          </div>
        



  <!-- ########################## TABEL ################################                      -->
              <div class="table-responsive rounded  ms-4 me-4">
                  <table class="table table-bordered table-hover table-striped text-center" cellspacing="0">
                    <tr class="table-success">
                      <th>No</th>
                      <th>Kriteria</th>
                      <th>Bobot</th>
                      <th>Jenis</th>
                      <th>ِAksi</th>
                    </tr>

                    <!-- loop untuk table -->
                    <?php $i = 1; ?>
                          <?php foreach($kriteria as $row): ?>
                          <tr>
                              <td><?= $i; ?></td>
                              <td><?= $row["kriteria"]; ?></td>
                              <td><?= $row["bobot"]; ?></td>
                              <td><?= $row["jns"]; ?></td>

                              <td>
                                  <button type="button " class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?= $row["id"]; ?>">
                                    Ubah
                                  </button>
                                      ||
                                  <a onclick="return confirm('Yakin menghapus data ini?');" href="hapus_kriteria.php?id=<?=$row["id"]; ?>" class="btn btn-danger btn-sm">
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
    </div>
  <!-- ########################## AKHIR CONTAINER ################################                      --> 
  </div>  
  <!-- ########################## AKHIR WRAPPER ################################                      -->
        

  <!-- awal modal ubah data -->


  <?php $i = 0; ?>
  <?php foreach($kriteria as $row): $i++; ?>
  <div class="modal fade" id="edit<?= $row["id"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="staticBackdropLabel">FORM UBAH KRITERIA</h5>
        </div>
        <div class="modal-body">
        <form action="" method="post" enctype="multipart/form-data" autocomplete="off">      
          <div class="mb-3">
              <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
          </div>   
          <div class="mb-3 row">
              <label for="kriteria" class="col-sm-4 col-form-label ms-3">Kriteria</label>
              <div class="col-sm">
              <input type="text" class="form-control" id="kriteria" name="kriteria" required placeholder="Kriteria" value="<?= $row['kriteria'];?>">
              </div>
          </div>
          <div class="mb-3 row">
              <label for="bobot" class="col-sm-4 col-form-label ms-3">Bobot</label>
              <div class="col-sm">
              <input type="number" class="form-control" id="bobot" name="bobot" required placeholder="Nilai" value="<?= $row['bobot'];?>">
              </div>
          </div>
          <div class="mb-3 row">
              <label for="jns" class="col-sm-4 col-form-label ms-3">Jenis</label>
              <div class="col-sm">
              <select class="form-select" id="jns" name="jns" required>
                      <option selected disabled>-Pilih-</option>
                      <option value="Benefit" <?php if($row['jns'] == 'Benefit') echo"selected" ?>>Benefit</option>
                      <option value="Cost" <?php if($row['jns'] == 'Cost') echo"selected" ?>>Cost</option>
                  </select>
              </div>
          </div>
          <div class="mb-3 row ms-1">
              <div class="col-sm">
              <div class="form-text">
                  <span style="font-size: 14px;">Keterangan:</span>
                  <br>        
                  <span class="fw-6 me-2">Jenis :</span>
                  <span style="margin-right: 15px;">Benefit = Semakin besar semakin baik,</span>                     
                  <span style="margin-right: 15px;">Cost = Semakin kecil semakin baik</span>            
              </div>
              </div>
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
