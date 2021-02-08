<div class="modal fade" id="asetEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="brModalLabel">Form Edit Aset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input readonly placeholder="Kode Aset" type="text" name="asetID" id="asetID" class="form-control form-control-sm" autocomplete="off" required>
                                <input type="hidden" name="periodeLap" id="periodeLap" class="form-control" autocomplete="off" required value="<?= $allLap['periode']; ?>">
                            </div>
                            <div class="col">
                                <input placeholder="Nama Inventaris" type="text" name="INVnm" id="INVnm" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <select readonly class="form-control form-control-sm" name="cabang" id="cabang" required>
                                        <option value="">--- Pilih Kantor Cabang ---</option>
                                        <?php foreach ($AllCbg as $brs) : ?>
                                            <option value="<?= $brs["kode_cabang"]; ?>"><?= $brs["nama_cabang"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select readonly class="form-control form-control-sm" name="kas" id="kas" required>
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
                                    <select class="form-control form-control-sm" name="kate" id="kate" required>
                                        <option value="">Kategori Aset</option>
                                        <option id="kate" value="ELU">ELU</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="jns" id="jns" required>
                                        <option value="">Jenis Aset</option>
                                        <option id="jns" value="TANAH">TANAH</option>
                                        <option id="jns" value="BANGUNAN">BANGUNAN</option>
                                        <option id="jns" value="MESIN">MESIN</option>
                                        <option id="jns" value="INVENTARIS">INVENTARIS</option>
                                        <option id="jns" value="KENDARAAN">KENDARAAN</option>
                                        <option id="jns" value="PERLENGKAPAN & LAIN-LAIN">PERLENGKAPAN & LAIN-LAIN</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <select class="form-control form-control-sm" name="pjk" id="pjk" required>
                                        <option value="">Tipe Hatra/Aktiva (Pajak)</option>
                                        <?php foreach ($tyHA as $brs) : ?>
                                            <option id="pajak" value="<?= $brs["kelompok"]; ?>"><?= $brs["kelompok"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="masaManfaatEdit">Masa Manfaat (Tahun)</label>
                                    <select class="form-control form-control-sm" name="masaManfaatEdit" id="masaManfaatEdit" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-label-group">
                                    <label for="tarifEdit">Tarif Penyusutan (%)</label>
                                    <select class="form-control form-control-sm" name="tarifEdit" id="tarifEdit" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label for="tglBeli">Tanggal Perolehan</label>
                                <input type="text" name="tglBeli" id="tglBeli" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input placeholder="Jumlah" type="number" name="jumlah" id="jumlah" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Harga Beli (Rp.)" type="number" name="harga" id="harga" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input readonly placeholder="Nilai Residu" type="number" name="nilaiResiduEdit" id="nilaiResiduEdit" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                            <div class="col">
                                <input placeholder="Nilai Jumlah (Rp.)" readonly type="text" name="nilaiJumlahEdit" id="nilaiJumlahEdit" class="form-control form-control-sm" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="ubah">
                        <i class="fas fa-save" style="margin-right: 10px;"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>