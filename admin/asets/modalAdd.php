<div onmousemove="hitungResidu();" class="modal fade" id="lapAddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brModalLabel">Form Tambah Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input placeholder="Kode Aset" type="text" name="IdAset" id="IdAset" class="form-control form-control-sm" autocomplete="off" required>
                                <input type="hidden" name="perioLap" id="perioLap" class="form-control" autocomplete="off" required value="<?= $allLap['periode']; ?>">
                            </div>
                            <div class="col">
                                <input placeholder="Nama Inventaris" type="text" name="nameINV" id="nameINV" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="kodeCbg" id="kodeCbg" required>
                                        <?php foreach ($AllCbg as $brs) : ?>
                                            <option value="<?= $brs["kode_cabang"]; ?>"><?= $brs["nama_cabang"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="kodeKas" id="kodeKas" required>
                                        <option value="">--- Pilih Kantor Kas ---</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="categori" id="categori" required>
                                        <option value="">Kategori Aset</option>
                                        <option id="categori" value="ELU">ELU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="jenis" id="jenis" required>
                                        <option value="">Jenis Aset</option>
                                        <option id="jenis" value="TANAH">TANAH</option>
                                        <option id="jenis" value="BANGUNAN">BANGUNAN</option>
                                        <option id="jenis" value="MESIN">MESIN</option>
                                        <option id="jenis" value="INVENTARIS">INVENTARIS</option>
                                        <option id="jenis" value="KENDARAAN">KENDARAAN</option>
                                        <option id="jenis" value="PERLENGKAPAN & LAIN-LAIN">PERLENGKAPAN & LAIN-LAIN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="pajak" id="pajak" required>
                                        <option value="">Type Harta</option>
                                        <?php foreach ($tyHA as $brs) : ?>
                                            <option id="pajak" value="<?= $brs["kelompok"]; ?>"><?= $brs["kelompok"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="masaManfaat">Masa Manfaat (Tahun)</label>
                                    <select class="form-control form-control-sm" name="masaManfaat" id="masaManfaat" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="tarif">Tarif Penyusutan (%)</label>
                                    <select class="form-control form-control-sm" name="tarif" id="tarif" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="nilaiResidu">Tanggal Perolehan</label>
                                <input type="text" name="tglPRL" id="tglPRL" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input placeholder="Jumlah" type="number" name="qty" id="qty" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Harga Beli (Rp.)" type="number" name="sold" id="sold" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input readonly placeholder="Nilai Residu" type="number" name="nilaiResidu" id="nilaiResidu" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Nilai Jumlah (Rp.)" readonly type="text" name="nilaiJumlah" id="nilaiJumlah" class="form-control form-control-sm" autocomplete="off" required>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="saveAset">
                        <i class="fas fa-save" style="margin-right: 10px;"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>