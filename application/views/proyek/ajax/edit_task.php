
<form action="<?= site_url('api/proyek/selesaikanTask');?>" method="post"
    class="js-validate needs-validation" enctype="multipart/form-data"
    novalidate>
    <input type="hidden" name="id" value="<?= $task->id;?>">
    <input type="hidden" name="proyek_id" value="<?= $task->proyek_id;?>">
    <?php if($task->bukti != null && $task->bukti != 0 && $task->bukti != ''):?>
    <div class="mb-3">
        <label class="form-label" for="formTask">Bukti penyelesaian <small
                class="text-danger">*</small></label>
        <div class="row">
            <div class="col-4">
                <a href="<?= base_url();?><?= $task->bukti;?>" target="_blank"
                    class="btn btn-outline-primary btn-sm text-left"><i
                        class="bi bi-file-earmark-<?= $task->icon;?>"></i> Bukti
                    penyelesaian</a>
            </div>
            <div class="col-8">
                <input type="file" name="file" id="formTask"
                    class="form-control form-control-sm"
                    accept="<?= $proyek->upload_string?>">
            </div>
        </div>
        <small class="text-secondary">Upload bukti penyelesaian task, berupa
            file <?= $proyek->upload_allowed?>. Maksimal 5Mb</small>
    </div>
    <input type="hidden" name="sudah_upload" value="1">
    <?php else:?>
    <div class="mb-3">
        <label class="form-label" for="formTask">Bukti penyelesaian <small
                class="text-danger">*</small></label>
        <!-- <input type="file" name="file" id="formTask"
            class="form-control form-control-sm"
            accept="application/pdf,.pdf" required> -->
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
        <small class="text-secondary">Upload bukti penyelesaian task, berupa
            file <?= $proyek->upload_allowed?>. Maksimal 5Mb</small>
    </div>
    <input type="hidden" name="sudah_upload" value="0">
    <?php endif;?>

    <div class="mb-3">
        <label class="form-label" for="formTaskKeterangan">Catatan <small
                class="text-secondary">(optional)</small></label>
        <textarea type="text" name="catatan"
            class="form-control form-control-sm ckeditor"
            placeholder="Keterangan" rows="3"><?= $task->catatan;?></textarea>
    </div>
    <!-- End Form -->
    <!-- End From -->
    <div class="modal-footer p-0 pt-3">
        <button type="button" class="btn btn-sm btn-white"
            data-bs-dismiss="modal">Batal</button>
        <button type="submit" onclick="inikirim()"
            class="btn btn-sm btn-success">Selesaikan</button>
    </div>
</form>

<script>
        Dropzone.autoDiscover = false;

        $('.dz-message').addClass('hidden');

        var foto_upload = new Dropzone(".dropzone", {
            autoProcessQueue: false,
            url: "<?= site_url('api/proyek/upload_bukti/'.$task->proyek_id.'/'.$task->id) ?>",
            maxFilesize: 2,
            maxFiles: 30,
            parallelUploads: 30,
            method: "post",
            acceptedFiles: "<?= $proyek->upload_string?>",
            paramName: "bukti",
            dictInvalidFileType: "File type not allowed",
            addRemoveLinks: true,
            init: function() {
                let myDropzone = this;
                let mockFile = null;
                let callback = null; // Optional callback when it's done
                let crossOrigin = null; // Added to the `img` tag for crossOrigin handling
                let resizeThumbnail = false; // Tells Dropzone whether it should resize the image first

                <?php if (!empty($task->bukti_task)) : ?>
                    <?php foreach ($task->bukti_task as $kkk => $taskvv) : ?>
                        mockFile = {
                            name: "<?= $taskvv->bukti; ?>",
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
                    url: '<?= site_url('api/proyek/delete_bukti/'.$task->proyek_id.'/'.$task->id) ?>',
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