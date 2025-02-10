<?php
require_once('../_header.php');

// Cek apakah ada parameter id_user yang dikirim melalui URL
if (!isset($_GET['id_user'])) {
    header('Location: ' . url('karyawan.php'));
    exit;
}

$id_user = $_GET['id_user'];

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses absensi masuk
    $tanggal = date('Y-m-d');
    $waktu_masuk = date('H:i:s');
    
    // Query untuk menyimpan data absensi masuk
    $query = "INSERT INTO absensi (id_user, tanggal, waktu_masuk) VALUES ('$id_user', '$tanggal', '$waktu_masuk')";
    if (execute($query)) {
        echo "Absensi masuk berhasil disimpan!";
    } else {
        echo "Gagal menyimpan absensi masuk!";
    }
}

// Ambil data absensi karyawan
$absensi_karyawan = query("SELECT * FROM absensi WHERE id_user = '$id_user' ORDER BY tanggal DESC");

?>

<div class="container">
    <h2>Absen Masuk Karyawan</h2>
    <form action="" method="post">
        <p>Yakin ingin melakukan absensi masuk untuk karyawan dengan ID: <?= $id_user ?>?</p>
        <button type="submit" class="btn btn-primary">Absen Masuk</button>
        <a href="<?= url('karyawan/karyawan.php') ?>" class="btn btn-secondary">Batal</a>
    </form>

    <h3>Riwayat Absensi</h3>
    <table class="tabel-transaksi">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Waktu Masuk</th>
                <th>Waktu Pulang</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($absensi_karyawan as $absensi) : ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $absensi['tanggal'] ?></td>
                    <td><?= $absensi['waktu_masuk'] ?></td>
                    <td><?= $absensi['waktu_pulang'] ?></td>
                    <?php $no++ ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once('../_footer.php'); ?>