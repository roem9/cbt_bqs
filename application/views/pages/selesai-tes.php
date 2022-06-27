<?php $this->load->view("_partials/header")?>
    <div class="page page-center" id="login">
        <div class="container-tight py-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="javascript:void()"><img src="<?= $link['value']?>/assets/img/logo.png" height="80" alt=""></a>
                    </div>
                    <h2 class="card-title text-center mb-4"><?= $title?></h2>
                    <?= $this->session->flashdata('pesan')['msg']?>
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-block mb-3" onClick="window.location.reload();">Member Area</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $this->load->view("_partials/footer")?>