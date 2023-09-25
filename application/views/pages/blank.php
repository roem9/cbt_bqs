<?php $this->load->view("_partials/header")?>
    <div class="wrapper">
      <div class="sticky-top">
        <?php $this->load->view("_partials/navbar-header")?>
      </div>
      <div class="page-wrapper">
        <div class="page-body">
          <div class="container-xl d-flex flex-column justify-content-center">
            <div class="empty">
              <div class="empty-img">
                <svg width="128" height="128" class="text-danger">
                    <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-alert-triangle" />
                </svg>
              </div>
              <p class="empty-title">Link Tidak Ditemukan</p>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php $this->load->view("_partials/footer")?>