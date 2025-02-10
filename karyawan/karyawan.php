<?php 
require_once('../_header.php'); 
$data_karyawan = query('SELECT * FROM master LIMIT 20 OFFSET 1');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Karyawan</title>
    <style>
    .btn-disabled {
        background-color: gray;
        pointer-events: none;
        color: white;
    }
    </style>
</head>
<body>
<div id="karyawan" class="main-content">
<div class="container">
<div class="baris">
<div class="selamat-datang">
<div class="col-header">
<h2 class="judul-md">Management Karyawan</h2>
</div>

<div class="col-header txt-right">
<a href="<?=url('karyawan/tambah.php')?>" class="btn-lg bg-primary">+ Tambah Karyawan</a>
</div>	
</div>
</div>

<div class="baris">
<div class="col">
<div class="card">
<div class="card-title card-flex">
<div class="card-col">
<h2>Daftar Karyawan</h2>	
</div>
</div>

<div class="card-body">
<div class="tabel-kontainer">
<table class="tabel-transaksi">
<thead>
	<tr>
		<th class="sticky">No</th>
		<th class="sticky">Nama Karyawan</th>
		<th class="sticky">Username</th>
		<th class="sticky">Email</th>
		<th class="sticky">Absensi</th>
		<th class="sticky">Action</th>
	</tr>
</thead>

<tbody>

	<?php $no = 1; ?>
	<?php foreach($data_karyawan as $karyawan) : ?>
		<tr>
			<td><?= $no ?></td>
			<td><?= $karyawan['nama'] ?></td>
			<td><?= $karyawan['username'] ?></td>
			<td><?= $karyawan['email'] ?></td>
			<td>
				<?php
				$tanggal = date('Y-m-d');
				$absen_masuk = query("SELECT * FROM absensi WHERE id_user = {$karyawan['id_user']} AND tanggal = '$tanggal' AND waktu_masuk IS NOT NULL");
				$absen_pulang = query("SELECT * FROM absensi WHERE id_user = {$karyawan['id_user']} AND tanggal = '$tanggal' AND waktu_pulang IS NOT NULL");

				$btn_masuk_class = empty($absen_masuk) ? 'btn-edit' : 'btn-disabled';
				$btn_pulang_class = empty($absen_pulang) ? 'btn-edit' : 'btn-disabled';
				?>
				<a href="<?=url('karyawan/absen_masuk.php')?>?id_user=<?=$karyawan['id_user']?>" class="btn <?= $btn_masuk_class ?>">Masuk</a>
				<a href="<?=url('karyawan/absen_pulang.php')?>?id_user=<?=$karyawan['id_user']?>" class="btn <?= $btn_pulang_class ?>">Pulang</a>
			</td>
			<td>
				<a href="<?=url('karyawan/edit.php')?>?id_user=<?=$karyawan['id_user']?>" class="btn btn-edit">Edit</a>
				<a href="<?=url('karyawan/hapus.php')?>?id_user=<?=$karyawan['id_user']?>" onclick="return confirm('Yakin akan menghapus?');"  class="btn btn-hapus">Hapus</a>
			</td>
		</tr>
		<?php $no++ ?>
	<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php require_once('../_footer.php'); ?>
</body>