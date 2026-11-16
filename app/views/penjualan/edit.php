<h2>Edit Penjualan</h2>

<p class="text-muted">No. transaksi: <?php echo e($data['old']['jual_no'] ?? ''); ?></p>

<?php
$old = $data['old'];
$aksi = 'update';
$tombol = 'UPDATE';

require ROOT . "app/views/penjualan/_form.php";
?>
