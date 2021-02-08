<?php
$jumdatph = 10;
$jumalldat = count(addBranch("SELECT * FROM users"));
$jumhal = ceil($jumalldat / $jumdatph);
$aktpage = (isset($_GET["page"])) ? $_GET["page"] : 1;
$dtawl = ($jumdatph * $aktpage) - $jumdatph;
$user = addBranch("SELECT * FROM users LIMIT $dtawl, $jumdatph");
?>

<div class="table-responsive">
    <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
            <tr align="center">
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Kode Cabang</th>
                <th>Kantor Kas</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($user as $brs) : ?>
                <tr align="center">
                    <td><?= $no; ?></td>
                    <td><?= $brs["nama"]; ?></td>
                    <td><?= $brs["username"]; ?></td>
                    <td><?= $brs["lokasi_cbg"]; ?></td>
                    <td><?= $brs["lokasi_kas"]; ?></td>
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="text-center">
        <span class="btn btn-primary">Halaman</span>
        <div class="btn-group">
            <?php if ($aktpage > 1) : ?>
                <a href="?page=<?= $aktpage - 1; ?>" class="btn" style="border-color: black;"><i class="fas fa-angle-left"></i></a>
            <?php endif; ?>
            <?php for ($a = 1; $a <= $jumhal; $a++) : ?>
                <?php if ($a == $aktpage) : ?>
                    <a href="?page=<?= $a; ?>" class="btn btn-success" style="font-weight: bold; border-color: black;"><?= $a; ?>
                    </a>
                <?php else : ?>
                    <a href="?page=<?= $a; ?>" class="btn" style="border-color: black;"><?= $a; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($aktpage < $jumhal) : ?>
                <a href="?page=<?= $aktpage + 1; ?>" class="btn" style="border-color: black;"><i class="fas fa-angle-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>