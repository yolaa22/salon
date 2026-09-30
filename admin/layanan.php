<?php
require "auth.php"; require "../config/koneksi.php";
if(isset($_GET['hapus'])){$id=(int)$_GET['hapus'];$koneksi->query("DELETE FROM layanan WHERE id_layanan=$id");header("Location:layanan.php");exit;}
if($_SERVER['REQUEST_METHOD']==='POST'){
 $id=(int)$_POST['id'];$nama=$_POST['nama_layanan'];$des=$_POST['deskripsi'];$harga=(int)$_POST['harga'];$ikon=$_POST['ikon'];
 if($id){$s=$koneksi->prepare("UPDATE layanan SET nama_layanan=?,deskripsi=?,harga=?,ikon=? WHERE id_layanan=?");$s->bind_param("ssisi",$nama,$des,$harga,$ikon,$id);}
 else{$s=$koneksi->prepare("INSERT INTO layanan(nama_layanan,deskripsi,harga,ikon) VALUES(?,?,?,?)");$s->bind_param("ssis",$nama,$des,$harga,$ikon);}
 $s->execute();header("Location:layanan.php");exit;
}
$edit=null;if(isset($_GET['edit'])){$id=(int)$_GET['edit'];$edit=$koneksi->query("SELECT * FROM layanan WHERE id_layanan=$id")->fetch_assoc();}
$data=$koneksi->query("SELECT * FROM layanan ORDER BY id_layanan DESC");include "header.php";
?>
<div class="admin-wrap"><h1>Kelola Layanan</h1><div class="booking-box" style="margin:25px 0"><h2><?= $edit?'Edit':'Tambah' ?> Layanan</h2><form method="post"><input type="hidden" name="id" value="<?= $edit['id_layanan']??0 ?>"><div class="form-grid"><div class="form-group"><label>Nama</label><input name="nama_layanan" required value="<?= htmlspecialchars($edit['nama_layanan']??'') ?>"></div><div class="form-group"><label>Ikon Emoji</label><input name="ikon" value="<?= htmlspecialchars($edit['ikon']??'💄') ?>"></div><div class="form-group"><label>Harga</label><input type="number" name="harga" required value="<?= $edit['harga']??'' ?>"></div><div class="form-group full"><label>Deskripsi</label><textarea name="deskripsi" required><?= htmlspecialchars($edit['deskripsi']??'') ?></textarea></div></div><button class="btn">Simpan</button></form></div>
<div class="table-wrap"><table class="table"><tr><th>ID</th><th>Layanan</th><th>Harga</th><th>Aksi</th></tr><?php while($r=$data->fetch_assoc()): ?><tr><td><?= $r['id_layanan'] ?></td><td><?= htmlspecialchars($r['ikon'].' '.$r['nama_layanan']) ?></td><td>Rp <?= number_format($r['harga'],0,',','.') ?></td><td><a class="small-btn" href="?edit=<?= $r['id_layanan'] ?>">Edit</a> <a class="small-btn danger" href="?hapus=<?= $r['id_layanan'] ?>" onclick="return confirm('Hapus layanan?')">Hapus</a></td></tr><?php endwhile; ?></table></div></div>
<?php include "footer.php"; ?>