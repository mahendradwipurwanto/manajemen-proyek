
<form action="<?= site_url('api/proyek/edit');?>" method="post" class="js-validate needs-validation" enctype="multipart/form-data"
    novalidate>
    <input type="hidden" name="id" value="<?= $proyek->id;?>">
    <!-- Form -->
    <div class="mb-3 row">
        <div class="col-8">
            <label class="form-label" for="formJudul">Nama Proyek</label>
            <input type="text" name="judul" id="formJudul" class="form-control form-control-sm"
                value="<?= $proyek->judul;?>" <?= $proyek->is_selesai == 1 ? 'readonly' : 'required'?>>
        </div>
        <div class="col-4">
            <label class="form-label" for="formKode">Kode Proyek  <i
                    class="bi bi-info-square-fill" data-bs-toggle="tooltip" data-bs-html="true"
                    title="Kode sebagai kunci/id proyek anda untuk mengenali pekerjaan dari proyek ini."></i></label>
            <input type="text" name="kode" id="formKode" class="form-control form-control-sm alphanum"
                placeholder="Ex: PYK01" value="<?= $proyek->kode;?>" readonly>
        </div>
    </div>
    <div class="mb-3">
        <label class="form-label" for="formSelesaikanProyek">Selesaikan Proyek</label>
        <div class="form-check form-switch mb-4">
            <input type="checkbox" class="form-check-input" id="formSelesaikan" name="is_selesai"
                <?= $proyek->is_selesai == 1 ? 'checked' : '';?>>
            <label class="form-check-label" for="formSelesaikan">Selesaikan proyek? saat proyek selesai,
                maka staff tidak dapat mengakses proyek ini</label>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-6">
            <label class="form-label" for="formPeriodeMulai">Periode Mulai</label>
            <input type="date" name="periode_mulai" id="formPeriodeMulai"
                class="form-control form-control-sm"
                value="<?= date('Y-m-d', $proyek->periode_mulai);?>"
                <?= $proyek->is_selesai == 1 ? 'readonly' : 'required'?>>
        </div>
        <div class="col-6">
            <label class="form-label" for="formPeriodeSelesai">Periode Selesai</label>
            <input type="date" name="periode_selesai" id="formPeriodeSelesai"
                class="form-control form-control-sm"
                value="<?= date('Y-m-d', $proyek->periode_selesai);?>"
                <?= $proyek->is_selesai == 1 ? 'readonly' : 'required'?>>
        </div>
        <?php if($proyek->is_selesai == 0):?>
        <div class="col-12 mt-3">
            <div class="alert alert-soft-primary mb-0">
                <small class="text-secondary">Periode mulai dan selesai digunakan sebagai acuan laporan
                    mengenai ketepatan waktu penyelesaian proyek, anda dapat mengubah hal ini nanti jika
                    terjadi kendala saat proses pengerjaan berlangsung</small>
            </div>
        </div>
        <?php endif;?>
    </div>

    <div class="mb-3">
        <label for="formKeterangan" class="form-label">Berkas pendukung (optional)</label>
            <div action="#" class="dropzone p-1">
                <div class="fallback">
                </div>
                <div class="dz-message needsclick">
                    <div class="mb-2">
                        <i class="display-4 text-muted mdi mdi-upload-network-outline"></i>
                    </div>

                    <h4>Drop file atau klik untuk mengunggah.</h4>
                </div>
            </div>
        <small class="text-secondary">Upload file pdf. Maksimal 5Mb</small>
    </div>

    <div class="mb-3">
        <label for="formKeterangan" class="form-label">Tipe File yang diperbolehkan</label>
        <div class="row">
            <div class="col-4">
                <!-- Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" id="checkPdf" name="upload_type[pdf]" class="form-check-input"
                        value="application/pdf" <?= isset($proyek->upload_type->pdf) ? 'checked' : '';?>>
                    <label class="form-check-label" for="checkPdf">pdf</label>
                </div>
                <!-- End Checkbox -->
                <!-- Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" id="checkDocx" name="upload_type[docx]" class="form-check-input"
                        value="application/vnd.openxmlformats-officedocument.wordprocessingml.document" <?= isset($proyek->upload_type->docx) ? 'checked' : '';?>>
                    <label class="form-check-label" for="checkDocx">Docx (word file)</label>
                </div>
                <!-- End Checkbox -->
                <!-- Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" id="checkPptx" name="upload_type[pptx]" class="form-check-input"
                        value="application/vnd.openxmlformats-officedocument.presentationml.presentation" <?= isset($proyek->upload_type->pptx) ? 'checked' : '';?>>
                    <label class="form-check-label" for="checkPptx">Pptx (powerpoint file)</label>
                </div>
                <!-- End Checkbox -->
            </div>
            <div class="col-4">
                <!-- Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" id="checkXlsx" name="upload_type[xlsx]" class="form-check-input"
                        value="vapplication/vnd.openxmlformats-officedocument.spreadsheetml.sheet" <?= isset($proyek->upload_type->xlsx) ? 'checked' : '';?>>
                    <label class="form-check-label" for="checkXlsx">Xlsx (Excel file)</label>
                </div>
                <!-- End Checkbox -->
                <!-- Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" id="checkJpg" name="upload_type[jpg]" class="form-check-input" value="image/jpg" <?= isset($proyek->upload_type->jpg) ? 'checked' : '';?>>
                    <label class="form-check-label" for="checkJpg">jpg</label>
                </div>
                <!-- End Checkbox -->
            </div>
            <div class="col-4">
                <!-- Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" id="checkJpeg" name="upload_type[jpeg]" class="form-check-input" value="image/jpeg" <?= isset($proyek->upload_type->jpeg) ? 'checked' : '';?>>
                    <label class="form-check-label" for="checkJpeg">jpeg</label>
                </div>
                <!-- End Checkbox -->
                <!-- Checkbox -->
                <div class="form-check mb-3">
                    <input type="checkbox" id="checkPng" name="upload_type[png]" class="form-check-input" value="image/png" <?= isset($proyek->upload_type->png) ? 'checked' : '';?>>
                    <label class="form-check-label" for="checkPng">png</label>
                </div>
                <!-- End Checkbox -->
            </div>
        </div>
        <small class="text-secondary">Pilih tipe file yang diperbolehkan untuk staff mengunggah berkas
            verifikasi task mereka. (harap pilih minimal 1)</small>
    </div>

    <div class="mb-3">
        <label for="formKeterangan" class="form-label">Keterangan <small
                class="text-secondary">(optional)</small></label>
        <?php if($proyek->is_selesai == 1):?>
        <p><?= $proyek->keterangan;?></p>
        <?php else:?>
        <textarea name="keterangan" class="form-control form-control-sm ckeditor" id="formKeterangan"
            rows="3" placeholder="Keterangan"
            <?= $proyek->is_selesai == 1 ? 'readonly' : ''?>><?= $proyek->keterangan;?></textarea>
        <?php endif;?>
    </div>
    <!-- End Form -->
    <div class="modal-footer p-0 pt-3">
        <button type="button" class="btn btn-sm btn-white" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-sm btn-primary" onclick="inikirim()">Ubah Proyek</button>
        <a href="<?= site_url('api/proyek/hapus/'.$proyek->id);?>"
            class="btn btn-sm btn-soft-danger">Hapus Proyek</a>
    </div>
</form>

<script>
        Dropzone.autoDiscover = false;

        $('.dz-message').addClass('hidden');

        var foto_upload = new Dropzone(".dropzone", {
            autoProcessQueue: false,
            url: "<?= site_url('api/proyek/upload_pendukung/'.$proyek->id) ?>",
            maxFilesize: 2,
            maxFiles: 30,
            parallelUploads: 30,
            method: "post",
            acceptedFiles: ".pdf",
            paramName: "pendukung",
            dictInvalidFileType: "File type not allowed",
            addRemoveLinks: true,
            init: function() {
                let myDropzone = this;
                let mockFile = null;
                let callback = null; // Optional callback when it's done
                let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
                let resizeThumbnail = false; // Tells Dropzone whether it should resize the image first

                <?php if (!empty($proyek->file_pendukung)) : ?>
                    <?php foreach ($proyek->file_pendukung as $kkk => $taskvv) : ?>
                        mockFile = {
                            name: "<?= $taskvv->file; ?>",
                            size: 10*1024
                        };

                        myDropzone.displayExistingFile(mockFile, "<?= base_url(); ?>assets/images/pdf.png", callback, crossOrigin, resizeThumbnail);
                    <?php endforeach; ?>
                <?php endif; ?>
                let fileCountOnServer = 2; // The number of files already uploaded
                myDropzone.options.maxFiles = myDropzone.options.maxFiles - fileCountOnServer;
            },
            removedfile: function(file) {
                var fileName = file.name;

                $.ajax({
                    type: 'POST',
                    url: '<?= site_url('api/proyek/delete_pendukung/'.$proyek->id) ?>',
                    data: {
                        filename: fileName,
                        request: 'delete'
                    },
                    success: function(data) {
                        console.log('success: ' + data);
                    }
                });

                var _ref;
                return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            }
        });

        function inikirim() {
            foto_upload.processQueue();
        }
</script>