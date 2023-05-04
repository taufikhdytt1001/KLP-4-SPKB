<?php 
    include_once 'apps/config/config.php';
    include_once 'kelola/edit_kriteria.php';
    include_once 'data_kriteria.php';

    // ambil id
    $id = $_GET["id"];

    if(hapus($id) > 0 ){
        $_SESSION['pesan'] = "Data berhasil dihapus!";
        echo "<script> 
        document.location.href = 'data_kriteria.php';        
        </script> ";
    }
    else{
        $_SESSION['pesan'] = "Data gagal dihapus!";
        echo "<script> 
        document.location.href = 'data_kriteria.php';        
        </script> ";
    }
?>