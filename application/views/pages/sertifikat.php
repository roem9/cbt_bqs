<?php $this->load->view("_partials/header")?>
    
    <div class="wrapper" id="elementtoScrollToID">
        <!-- <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
        </div> -->
        <div class="page-wrapper" id="">
            <div class="page-body">
                <div class="container-xl">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-6">
                                <?php if(isset($nama)) :?>
                                    <div class="card shadow mb-4">
                                        <div class="card-body text-gray-900">
                                            <center>
                                                <img src="<?= $link['value']?>/assets/img/logo.png?t=<?= time()?>" width=150 class="img-fluid mb-3" alt="">
                                            </center>
                                        <!-- </div>
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between"> -->
                                            <h5 class="m-0 font-weight-bold text-dark">No. Sertifikat : </i><?= $no_doc?></h5>
                                        <!-- </div> -->
                                        <!-- <div class="card-body text-gray-900"> -->
                                            <p class="mt-3">
                                                Nama : <?= ucwords(strtolower($nama))?><br>
                                                TTL : <?= $t4_lahir?>, <?= tgl_indo($tgl_lahir)?><br>
                                                Alamat : <?= ucwords(strtolower($alamat))?>
                                            </p>
                                            <p>
                                                Nilai Listening : <?= $istima?><br>
                                                Nilai Structure : <?= $tarakib?><br>
                                                Nilai Reading : <?= $qiroah?><br>
                                                Skor TOEFL : <?= $skor_toefl?>
                                            </p>
                                            <p>
                                                Tgl Tes : <?= tgl_indo(date("Y-m-d", strtotime($tgl_tes)))?><br>
                                            </p>
                                            <p><small class="text-danger"><i>Catatan : Peserta di atas telah mengikuti TOEFL ITP Prediction yang dilaksanakan secara online. Ujian tersebut tidak berafiliasi dengan  Educational Testing Service (ETS).</i></small></p>
                                        </div>
                                    </div>
                                <?php else :?>
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-dark">Sertifikat Tidak Tersedia</i></h6>
                                        </div>
                                        <div class="card-body text-gray-900">
                                            <div class="alert alert-warning"><i class="fa fa-exclamation-circle text-warning mr-3"></i>Maaf Sertifikat Anda Tidak Ditemukan</div>
                                        </div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view("_partials/footer")?>