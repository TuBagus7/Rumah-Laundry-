<?php 
   require_once('../_header.php'); 
   $data_cs = query("SELECT * FROM tb_cuci_satuan");


      if (isset($_POST['order_cs'])) {
         $uploadDir = 'C:/xampp/htdocs/rumah_laundry/uploads/file_uploads_cs/'; // Direktori tempat file diunggah
         $uploadFile = $uploadDir . basename($_FILES['file_upload']['name']);
         $file_path = null;

         if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $uploadFile)) {
            $file_path = 'uploads/file_uploads_cs/' . basename($_FILES['file_upload']['name']); // Simpan jalur relatif
         }

         if (order_cs($_POST, $file_path) > 0) {
            echo '<div class="alert"><div class="box">
                     <img src="'.url('_assets/img/berhasil.png').'" height="68" alt="alert sukses">
                     <p>Order Berhasil Di Tambahkan</p>
                     <button onclick="window.location=\'http://localhost/rumah_laundry/\'" class="btn-alert">Ok</button>
                  </div></div>';
         } else {
            echo '<div class="alert"><div class="box">
                     <img src="'.url('_assets/img/gagal.png').'" height="68" alt="alert gagal">
                     <p>Order Gagal Di Tambahkan</p>
                     <button onclick="window.location=\'http://localhost/rumah_laundry/\'" class="btn-alert">Ok</button>
                  </div></div>';
         }
      }
?>

   <div id="order_cs" class="main-content">
      <div class="container">
         <div class="baris">
            <div class="col mt-2">
               <div class="card">
                  <div class="card-title card-flex">
                     <div class="card-col">
                        <h2>Dry Clean</h2>
                     </div>

                     <div class="card-col txt-right">
                        <a href="<?=url('order/order.php')?>" class="btn-xs bg-primary">Kembali</a>
                     </div>
                  </div>

                  <div class="card-body">
                     <form action="" method="post" enctype="multipart/form-data">
                        <div class="row-input">
                           <div class="col-form m-1">
                              <div class="form-grup">
                                 <label for="nama">Nama Pelanggan</label>
                                 <input type="text" name="nama_pel_cs" placeholder="Nama lengkap" autocomplete="off" id="nama">
                              </div>

                              <div class="form-grup">
                                 <label for="no-telp">Nomor Telepon</label>
                                 <input type="text" name="no_telp_cs" placeholder="Nomor Telepon" autocomplete="off" id="no-telp">
                              </div>

                              <div class="form-grup">
                                 <label for="alamat">Alamat</label>
                                 <textarea name="alamat_cs" rows="4" id="alamat"></textarea>
                              </div>

                              <div class="form-grup">
                                 <label for="file_upload">Upload File</label>
                                 <input type="file" name="file_upload" id="file_upload">
                              </div>
                           </div>

                           <div class="col-form m-1">
                              <div class="form-grup">
                                 <label for="pilih_paket">Pilih Paket</label>
                                 <select name="jenis_paket_cs" id="pilih_paket">
                                    <option>-- Pilih Jenis Paket --</option>
                                       <?php foreach ($data_cs as $cs) : ?>
                                       <option><?=$cs['nama_cs']?></option>
                                       <?php endforeach ?>
                                    </select>
                              </div>

                              <div class="form-grup">
                                 <label for="kuantitas">Jumlah Order Per/Pcs</label>
                                 <input type="number" name="jml_pcs" placeholder="Jumlah Order (Pcs)" autocomplete="off" id="kuantitas">
                              </div>

                              <div class="form-grup">
                                 <label for="tgl_order_msk">Tanggal Order Masuk</label>
                                 <input type="date" name="tgl_masuk_cs" autocomplete="off" id="tgl_order_msk">
                              </div>

                              <div class="form-grup">
                                 <label for="tgl_order_klr">Tanggal Order Keluar</label>
                                 <input type="date" name="tgl_keluar_cs" autocomplete="off" id="tgl_order_klr">
                              </div>

                              <div class="form-grup">
                                 <label for="ket">Keterangan</label>
                                 <textarea name="keterangan_cs" rows="4" id="ket"></textarea>
                              </div>
                           </div>
                        </div>
                        
                        <div class="form-footer">
                           <div class="buttons">
                              <button type="submit" name="order_cs" class="btn-sm bg-primary">Pesan</button>
                              <button type="reset" class="btn-sm bg-transparent">Batal</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php require_once('../_footer.php') ?>