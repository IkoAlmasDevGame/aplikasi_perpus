<?php 
namespace controller;
use model\PeopleAuth;
use model\absensi;
use model\keterangan;
use model\memberList;
use model\bukuList;
use model\pengaturan;
use model\ListPeminjaman;

class Authentication {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new PeopleAuth($konfig);
    }

    public function SignIn(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : strip_tags($_POST['userInput']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $data = $this->konfig->Login($userInput, $password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_akun = htmlspecialchars($_GET['id_akun']) ? htmlentities($_GET['id_akun']) : strip_tags($_GET['id_akun']);
        $data = $this->konfig->delete($id_akun);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function buatedit(){
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : strip_tags($_POST['username']);
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : strip_tags($_POST['email']);
        $nama = htmlentities($_POST['nama']) ? htmlspecialchars($_POST['nama']) : strip_tags($_POST['nama']);
        $password = md5(htmlspecialchars($_POST['password']), false);
        $repassword = md5(htmlspecialchars($_POST['repassword']), false);
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : strip_tags($_POST['role']);
        $data = $this->konfig->create($username, $email, $nama, $password, $repassword, $role);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class attedance {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new absensi($konfig);
    }

    public function attdance(){
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : $_POST['nama'];
        $tanggal = htmlspecialchars($_POST['tanggal_input']) ? htmlentities($_POST['tanggal_input']) : $_POST['tanggal_input'];
        $absensi = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : $_POST['jam'];
        $jam = htmlspecialchars($_POST['jam2']) ? htmlentities($_POST['jam2']) : $_POST['jam2'];
        $data = $this->konfig->simpan_absensi($nama, $tanggal, $absensi, $jam);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class document {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new keterangan($konfig);
    }

    public function buat_keterangan(){
        $nama = htmlspecialchars($_POST['nama']) ? htmlentities($_POST['nama']) : strip_tags($_POST['nama']);
        $keterangan = htmlspecialchars($_POST['keterangan']) ? htmlentities($_POST['keterangan']) : strip_tags($_POST['keterangan']);
        $alasan = htmlspecialchars($_POST['alasan']) ? htmlentities($_POST['alasan']) : strip_tags($_POST['alasan']);
        $tanggal = htmlspecialchars($_POST['tanggal']) ? htmlentities($_POST['tanggal']) : strip_tags($_POST['tanggal']);
        $jam = htmlspecialchars($_POST['jam']) ? htmlentities($_POST['jam']) : strip_tags($_POST['jam']);
        $data = $this->konfig->simpan_keterangan($nama, $keterangan, $alasan, $tanggal, $jam);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class AnggotaList {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new memberList($konfig);
    }

    public function buatedit(){
        $nim = (int)htmlentities($_POST['nim']) ? (int)htmlspecialchars($_POST['nim']) : (int)strip_tags($_POST['nim']);
        $nama = htmlentities($_POST['nama_anggota']) ? htmlspecialchars($_POST['nama_anggota']) : strip_tags($_POST['nama_anggota']);
        $tempat = htmlentities($_POST['tempat_lahir']) ? htmlspecialchars($_POST['tempat_lahir']) : strip_tags($_POST['tempat_lahir']);
        $tanggal = htmlentities($_POST['tanggal_lahir']) ? htmlspecialchars($_POST['tanggal_lahir']) : strip_tags($_POST['tanggal_lahir']);
        $jenis = htmlentities($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : strip_tags($_POST['jenis_kelamin']);
        $prodi = htmlentities($_POST['prodi_kuliah']) ? htmlspecialchars($_POST['prodi_kuliah']) : strip_tags($_POST['prodi_kuliah']);
        $data = $this->konfig->CreateUpdate($nim,$nama,$tempat,$tanggal,$jenis,$prodi);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_akun = htmlspecialchars($_GET['id_anggota']) ? htmlentities($_GET['id_anggota']) : strip_tags($_GET['id_anggota']);
        $data = $this->konfig->delete($id_akun);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function status(){
        $status = htmlspecialchars($_POST['status_anggota']) ? htmlentities($_POST['status_anggota']) : strip_tags($_POST['status_anggota']);
        $id_anggota = htmlspecialchars($_POST['id_anggota']) ? htmlentities($_POST['id_anggota']) : strip_tags($_POST['id_anggota']);
        $data = $this->konfig->statusCreate($status, $id_anggota);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class ListBook {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new bukuList($konfig);
    }

    public function buatedit(){
        $judul = htmlentities($_POST['judul_buku']) ? htmlspecialchars($_POST['judul_buku']) : strip_tags($_POST['judul_buku']);
        $pengarang = htmlentities($_POST['pengarang_buku']) ? htmlspecialchars($_POST['pengarang_buku']) : strip_tags($_POST['pengarang_buku']);
        $penerbit = htmlentities($_POST['penerbit_buku']) ? htmlspecialchars($_POST['']) : strip_tags($_POST['']);
        $tahun = htmlentities($_POST['tahun_terbit']) ? htmlspecialchars($_POST['tahun_terbit']) : strip_tags($_POST['tahun_terbit']);
        $isbn = htmlspecialchars($_POST['number1'])."-".htmlspecialchars($_POST['number2'])."-".htmlspecialchars($_POST['number3'])."-".htmlspecialchars($_POST['number4'])."-".htmlspecialchars($_POST['number5']);
        $jumlah = htmlentities($_POST['jumlah_buku']) ? htmlspecialchars($_POST['jumlah_buku']) : strip_tags($_POST['jumlah_buku']);
        $lokasi = htmlentities($_POST['lokasi_buku']) ? htmlspecialchars($_POST['lokasi_buku']) : strip_tags($_POST['lokasi_buku']);
        $tanggal = htmlentities($_POST['tanggal_input']) ? htmlspecialchars($_POST['tanggal_input']) : strip_tags($_POST['tanggal_input']);
        $data = $this->konfig->createUpdate($judul, $pengarang, $penerbit, $tahun, $isbn, $jumlah, $lokasi, $tanggal);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id_buku = htmlspecialchars($_GET['id_buku']) ? htmlentities($_GET['id_buku']) : strip_tags($_GET['id_buku']);
        $data = $this->konfig->delete($id_buku);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class settings {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new pengaturan($konfig);
    }

    public function edit(){
        # code Jam Masuk
        $uid_jam = htmlspecialchars($_POST['id_jam']) ? htmlentities($_POST['id_jam']) : strip_tags($_POST['id_jam']);
        $jam_masuk = htmlspecialchars($_POST['jam_masuk']) ? htmlentities($_POST['jam_masuk']) : strip_tags($_POST['jam_masuk']);
        # code Sistem Website
        $uid = htmlspecialchars($_POST['id_sistem']) ? htmlentities($_POST['id_sistem']) : strip_tags($_POST['id_sistem']);
        $nama = htmlspecialchars($_POST['developer']) ? htmlentities($_POST['developer']) : strip_tags($_POST['developer']);
        $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);
        $data = $this->konfig->update($uid_jam, $jam_masuk, $uid, $nama, $status);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class Peminjaman {
    protected $konfig;
    public function __construct($konfig)
    {
        $this->konfig = new ListPeminjaman($konfig);
    }

    public function perpanjang(){
        $uid = htmlspecialchars($_GET['id']) ? htmlentities($_GET['id']) : strip_tags($_GET['id']);
        $id_buku = htmlspecialchars($_GET['id_buku']) ? htmlentities($_GET['id_buku']) : strip_tags($_GET['id_buku']);
        $tgl_kembali = htmlspecialchars($_GET['tgl_kembali']) ? htmlentities($_GET['tgl_kembali']) : strip_tags($_GET['tgl_kembali']);
        $lambat = htmlspecialchars($_GET['lambat']) ? htmlentities($_GET['lambat']) : strip_tags($_GET['lambat']);
        $data = $this->konfig->LongReturn($uid,$id_buku,$tgl_kembali,$lambat);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function pengembalian(){
        $uid = htmlspecialchars($_GET['id']) ? htmlentities($_GET['id']) : strip_tags($_GET['id']);
        $id_buku = htmlspecialchars($_GET['id_buku']) ? htmlentities($_GET['id_buku']) : strip_tags($_GET['id_buku']);
        $data = $this->konfig->return($uid, $id_buku);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function buatPerjanjian(){
        $id_buku = htmlspecialchars($_POST['id_buku']) ? htmlentities($_POST['id_buku']) : strip_tags($_POST['id_buku']);
        $id_anggota = htmlspecialchars($_POST['id_anggota']) ? htmlentities($_POST['id_anggota']) : strip_tags($_POST['id_anggota']);
        $nim = htmlspecialchars($_POST['nim']) ? htmlentities($_POST['nim']) : strip_tags($_POST['nim']);
        $tgl_pinjam = htmlspecialchars($_POST['tgl_pinjam']) ? htmlentities($_POST['tgl_pinjam']) : strip_tags($_POST['tgl_pinjam']);
        $tgl_kembali = htmlspecialchars($_POST['tgl_kembali']) ? htmlentities($_POST['tgl_kembali']) : strip_tags($_POST['tgl_kembali']);
        $status = htmlspecialchars($_POST['status']) ? htmlentities($_POST['status']) : strip_tags($_POST['status']);
        $data = $this->konfig->create($id_buku,$id_anggota,$nim,$tgl_pinjam,$tgl_kembali,$status);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}
?>