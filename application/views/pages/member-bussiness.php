<?php $this->load->view("_partials/header")?>
    
    <div class="wrapper" id="elementtoScrollToID">
        <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
        </div>
        <div class="page-wrapper" id="">
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-cards FieldContainer" data-masonry='{"percentPosition": true }'>
                        <div class="card mb-3">
                            <div class="card-header">
                                <h4>Data Peserta</h4>
                            </div>
                            <div class="card-body">
                                <p>
                                    <?= tablerIcon("calendar", "me-1");?> <?= $peserta['tgl_input'];?>
                                </p>
                                <p>
                                    <?= tablerIcon("user", "me-1");?> <?= $peserta['nama_peserta'];?>
                                </p>
                                <p>
                                    <?= tablerIcon("phone", "me-1");?> <?= $peserta['no_hp'];?>
                                </p>
                                <p>
                                    <?= tablerIcon("mail", "me-1");?> <?= $peserta['email'];?>
                                </p>
                            </div>
                        </div>
                        
                        <?php if(count($tes_peserta) >= $peserta['jumlah_tes']) :?>
                            <div class="alert alert-danger" role="alert">
                                <?= tablerIcon("alert-circle", "me-1 text-danger")?> Kuota Tes Anda Telah Habis (<?= COUNT($tes_peserta)?>/<?= $peserta['jumlah_tes']?>)
                            </div>
                        <?php else :?>
                            <div class="alert alert-success mb-3" role="alert">
                                <div class="d-flex justify-content-between">
                                    <span>
                                        <?= tablerIcon("alert-circle", "me-1 text-success")?> Kuota Tes Anda (<?= COUNT($tes_peserta)?>/<?= $peserta['jumlah_tes']?>)
                                    </span>

                                    <span>
                                        <a href="<?= base_url()?>peserta/test/<?= md5($peserta['id_peserta'])?>" target="_blank" class="btn btn-success">Mulai Tes TOEFL</a>
                                    </span>
                                </div>
                            </div>
                        <?php endif;?>

                        <?php if($tes_peserta) :
                            $no = 1;
                        ?>
                            <?php foreach ($tes_peserta as $tes_peserta) :?>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h4>Test <?= $no?></h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p>Waktu Tes : <?= date("d M Y, H:i", strtotime($tes_peserta['tgl_tes']))?></p>
                                        <p>Nilai Listening : <b><?= poin("Listening", $tes_peserta['nilai_listening'])?></b> </p>
                                        <p>Nilai Structure : <b><?= poin("Structure", $tes_peserta['nilai_structure'])?></b> </p>
                                        <p>Nilai Reading &nbsp; : <b><?= poin("Reading", $tes_peserta['nilai_reading'])?></b> </p>
                                        <div class="d-flex justify-content-between">
                                            <p>Skor TOEFL : <b><?= skor($tes_peserta['nilai_listening'], $tes_peserta['nilai_structure'], $tes_peserta['nilai_reading'])?></b></p>
                                            <?php if($tes_peserta['status'] == "off") :?>
                                                <a href="javascript:void(0)" class="btn btn-success addSertifikat" data-skor="<?= $tes_peserta['skor_toefl']?>" data-id="<?= $tes_peserta['id']?>"><?= tablerIcon("award", "me-1")?> Buat Sertifikat</a>
                                            <?php else :?>
                                                <a href="<?= base_url()?>peserta/sertifikat/no/<?= md5($peserta['id_peserta'])?>" target="_blank" class="btn btn-warning"><?= tablerIcon("award", "me-1")?> Sertifikat</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                $no++;
                                endforeach;?>
                        <?php endif;?>

                    </div>
                </div>
            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>

<?php $this->load->view("_partials/footer")?>

<!-- load javascript -->
<?php  
    if(isset($js)) :
        foreach ($js as $i => $js) :?>
            <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
            <?php 
        endforeach;
    endif;    
?>

<script>
    var url_base = "<?= base_url()?>"; 

    $(".addSertifikat").click(function(){
        let skor = $(this).data("skor");
        let id = $(this).data("id");

        Swal.fire({
            icon: 'question',
            text: 'Yakin akan membuat sertifikat dengan skor toefl '+skor+'?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
                data = {id:id}

                let result = ajax(url_base+"peserta/add_sertifikat", "POST", data);
                location.reload();
            }
        })
    })
</script>