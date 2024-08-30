<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "berhasil"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda berhasil menambahkan buku baru ...</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?page=buku'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }else if($_GET['info'] == "ubah"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda berhasil mengubah buku ...</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?page=buku'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php        
    }else if($_GET['info'] == "gagal"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>anda gagal menambahkan buku baru ...</p>
    <button type="button" class="btn-close" onclick="location.href = '../ui/header.php?aksi=daftar-buku'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php        
    }
}
?>