<?php
// Isi formulir penjualan, dipakai oleh input.php dan edit.php
// Variabel yang dibutuhkan: $old (nilai isian), $aksi, $tombol
$items = $old['items'] ?? [];

// Minimal tampil satu baris kosong
if (!$items) {
    $items = [['produk' => '', 'qty' => '1']];
}
?>

<form action="<?php echo URL; ?>/penjualan/<?php echo $aksi; ?>" method="post">
    <?php echo csrf_field(); ?>
    <?php if (isset($old['jual_id'])) : ?>
        <input type="hidden" name="jual_id" value="<?php echo (int) $old['jual_id']; ?>">
    <?php endif; ?>

    <table class="table table-hover">
        <tr>
            <td style="width: 20%">TANGGAL</td>
            <td><input type="date" name="jual_tgl" class="form-control" required
                    min="2000-01-01" max="<?php echo date('Y-m-d'); ?>"
                    value="<?php echo e($old['jual_tgl'] ?? date('Y-m-d')); ?>"></td>
        </tr>
        <tr>
            <td>PEMBELI</td>
            <td><input type="text" name="jual_pembeli" class="form-control" maxlength="100" required
                    value="<?php echo e($old['jual_pembeli'] ?? ''); ?>"></td>
        </tr>
        <tr>
            <td>CATATAN</td>
            <td><input type="text" name="jual_catatan" class="form-control" maxlength="255"
                    value="<?php echo e($old['jual_catatan'] ?? ''); ?>"></td>
        </tr>
    </table>

    <h5>Daftar Produk</h5>

    <?php if (empty($data['listproduk'])) : ?>
        <div class="alert alert-warning">Belum ada produk. <a href="<?php echo URL; ?>/produk/input">Input produk</a> terlebih dahulu.</div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>PRODUK</th>
                    <th class="text-end">HARGA</th>
                    <th>JUMLAH</th>
                    <th class="text-end">SUBTOTAL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="baris-item">
                <?php foreach ($items as $item) : ?>
                    <?php require ROOT . "app/views/penjualan/_baris.php"; ?>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-end">TOTAL</th>
                    <th class="text-end" id="total-penjualan">Rp 0</th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <template id="template-baris">
        <?php
        $item = ['produk' => '', 'qty' => '1'];
        require ROOT . "app/views/penjualan/_baris.php";
        ?>
    </template>

    <button type="button" id="tambah-baris" class="btn btn-secondary mb-3">+ Tambah Produk</button>

    <div>
        <input type="submit" value="<?php echo $tombol; ?>" class="btn btn-primary">
        <a href="<?php echo URL; ?>/penjualan" class="btn btn-secondary">KEMBALI</a>
    </div>
</form>

<script src="<?php echo AST; ?>/js/penjualan.js"></script>
