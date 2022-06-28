<?php $this->load->view("_partials/header")?>
    <?php 
        $data_peserta = $this->session->flashdata('pesan');
        $string = trim(preg_replace('/\s+/', ' ', $data_peserta['text']));
        $txt_soal = json_decode($string, true );
        $jawaban_peserta = $txt_soal['jawaban'];
        $no_soal = 0;
    ?>
    <div id="soal_tes">
        <div class="wrapper" id="elementtoScrollToID">
            <div class="sticky-top">
                <?php $this->load->view("_partials/navbar-header")?>
            </div>
            <div class="page-wrapper" id="">
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row row-cards FieldContainer" data-masonry='{"percentPosition": true }'>
                            <input type="hidden" name="id_tes" value="<?= $id?>">
                            <div class="page page-center" id="sesi-0">
                                <div class="container-tight py-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center mb-4">
                                                <?php if($tes['tipe_tes'] == 'Tes TOEFL Kolaborasi Universitas' || $tes['tipe_tes'] == 'Tes TOEFL Kolaborasi Perusahaan') :?>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="javascript:void()"><img src="<?= $link['value']?>/assets/img/logo.png" height="80" alt=""></a>
                                                        <a href="javascript:void()"><img src="<?= $link['value']?>/assets/logo/<?= $tes['id_tes']?>.png" height="80" alt=""></a>
                                                    </div>
                                                <?php else :?>
                                                    <a href="javascript:void()"><img src="<?= $link['value']?>/assets/img/logo.png" height="80" alt=""></a>
                                                <?php endif;?>
                                            </div>
                                            <h2 class="card-title text-center mb-4"><?= $title?></h2>
                                            <?= $data_peserta['msg'];?>
                                            <div class="mb-3">
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" class="btn btn-md btn-success btnNext" data-id="sesi-1">
                                                        Pembahasan
                                                        <svg width="20" height="20">
                                                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-right" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $index = 1;
                                $jumlah_sesi = COUNT($sesi);
                                foreach ($sesi as $sesi) :?>
                                <div id="sesi-<?=$index?>" style="display: none">

                                    <div class="form-floating mb-3">
                                        <select name="fontSize" class="form-control required">
                                            <option value="">Pilih Ukuran Tulisan</option>
                                            <option value="">Default</option>
                                            <option value="20px">20px</option>
                                            <option value="25px">25px</option>
                                            <option value="30px">30px</option>
                                        </select>
                                        <label>Ukuran Tulisan</label>
                                    </div>
                                    <div class="mb-3">
                                        <?php if($index == $jumlah_sesi) :?>
                                                <div class="d-flex justify-content-start">
                                                    <button type="button" class="btn btn-md btn-success btnBack" data-id="sesi-<?= $index - 1?>">
                                                        <svg width="20" height="20">
                                                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-left" />
                                                        </svg> 
                                                        Back
                                                    </button>
                                                </div>
                                        <?php else :?>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-md btn-success btnBack" data-id="sesi-<?= $index - 1?>">
                                                    <svg width="20" height="20">
                                                        <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-left" />
                                                    </svg> 
                                                    Back</button>
                                                <button type="button" class="btn btn-md btn-success btnNext" data-id="sesi-<?= $index + 1?>">
                                                    Next
                                                    <svg width="20" height="20">
                                                        <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-right" />
                                                    </svg>
                                                </button>
                                            </div>
                                        <?php endif;?>
                                    </div>
                                    <input type="hidden" name="sesi-<?=$index + 1?>" value="<?= $sesi['jumlah_soal']?>">
                                    <input type="hidden" name="kunci_sesi[]" value="<?= $sesi['id_sub']?>">
                                    <?php foreach ($sesi['soal'] as $i => $data) :
                                        $color = "";
                                        $item = "";
                                        ?>
                                        <?php if($data['item'] == "soal") :?>
                                            <?php $soal = '<div class="mb-3">'.$data['data']['soal'].'</div>' ?>
                                            <input type="hidden" name="jawaban_sesi_<?= $index?>[]" data-id="soal-<?= $i?>" id="jawaban_sesi_<?= $index?><?= $i?>" value="null">
                                            <?php $pilihan = "";?>
                                            <?php foreach ($data['data']['pilihan'] as $k => $choice) :?>
                                                <?php if($jawaban_peserta[$no_soal][3] == "benar") :?>
                                                    <?php
                                                        if($choice == $data['data']['jawaban']){
                                                            $pilihan .= '
                                                                <div class="mb-3">
                                                                    <label>
                                                                        <input type="radio" data-id="'.$index.'|'.$i.'"  value="'.$choice.'" checked disabled> 
                                                                        '.$choice.' '.tablerIcon("circle-check", "text-success").'
                                                                    </label>
                                                                </div>';
                                                        } else {
                                                            $pilihan .= '
                                                                <div class="mb-3">
                                                                    <label>
                                                                        <input type="radio" data-id="'.$index.'|'.$i.'"  value="'.$choice.'" disabled> 
                                                                        '.$choice.'
                                                                    </label>
                                                                </div>';
                                                        }
                                                    ?>
                                                    <?php $pembahasan_soal = $data['data']['pembahasan_benar'];?>
                                                <?php elseif($jawaban_peserta[$no_soal][3] == "salah") :
                                                    $color = "list-group-item-danger";
                                                    ?>
                                                    <?php
                                                        if($choice == $data['data']['jawaban']){
                                                            $pilihan .= '
                                                                <div class="mb-3">
                                                                    <label>
                                                                        <input type="radio" data-id="'.$index.'|'.$i.'"  value="'.$choice.'" checked disabled> 
                                                                        '.$choice.' '.tablerIcon("circle-check", "text-success").'
                                                                    </label>
                                                                </div>';
                                                        } else if($choice == $jawaban_peserta[$no_soal][2]){
                                                            $pilihan .= '
                                                                <div class="mb-3">
                                                                    <label>
                                                                        <input type="radio" data-id="'.$index.'|'.$i.'"  value="'.$choice.'" checked disabled> 
                                                                        '.$choice.' '.tablerIcon("circle-x", "text-danger").'
                                                                    </label>
                                                                </div>';
                                                        } else {
                                                            $pilihan .= '
                                                                <div class="mb-3">
                                                                    <label>
                                                                        <input type="radio" data-id="'.$index.'|'.$i.'"  value="'.$choice.'" disabled> 
                                                                        '.$choice.'
                                                                    </label>
                                                                </div>';
                                                        }
                                                    ?>
                                                    <?php $pembahasan_soal = $data['data']['pembahasan_salah'];?>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                            <?php 
                                                $pembahasan = '
                                                <div class="accordion" id="accordion-example-'.$i.'">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pembahasan'.$i.'" aria-expanded="true">
                                                            Pembahasan Jawaban
                                                            </button>
                                                        </h2>
                                                        <div id="pembahasan'.$i.'" class="accordion-collapse collapse" data-bs-parent="#accordion-example-'.$i.'">
                                                            <div class="accordion-body pt-0">
                                                                '.$pembahasan_soal.'
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>';?>
                                            <?php 
                                                $item = $soal.$pilihan.$pembahasan;
                                                $no_soal++;
                                            ?>
                                        <?php elseif($data['item'] == "petunjuk") :
                                                if($data['penulisan'] == "RTL"){
                                                    $item = '<div dir="rtl" class="mb-3">'.$data['data'].'</div>';
                                                } else {
                                                    $item = '<div dir="ltr" class="mb-3">'.$data['data'].'</div>';
                                                }?>
                                        <?php elseif($data['item'] == "audio") :
                                            $item = '<center><audio controls controlsList="nodownload"><source src="'.$link['value'].'/assets/myaudio/'.$data['data'].'" type="audio/mpeg"></audio></center>';
                                        ?>
                                        <?php endif;?>
                                        <div class="shadow card mb-3 soal">
                                            <div class="card-body <?= $color?>" id="soal-<?= $i?>">
                                                
                                                <?= $item?>
                            
                                            </div>
                                        </div>
                                    <?php endforeach;?>

                                    <div class="mb-3">
                                        <?php if($index == $jumlah_sesi) :?>
                                                <div class="d-flex justify-content-start">
                                                    <button type="button" class="btn btn-md btn-success btnBack" data-id="sesi-<?= $index - 1?>">
                                                        <svg width="20" height="20">
                                                            <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-left" />
                                                        </svg> 
                                                        Back
                                                    </button>
                                                </div>
                                        <?php else :?>
                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-md btn-success btnBack" data-id="sesi-<?= $index - 1?>">
                                                    <svg width="20" height="20">
                                                        <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-left" />
                                                    </svg> 
                                                    Back</button>
                                                <button type="button" class="btn btn-md btn-success btnNext" data-id="sesi-<?= $index + 1?>">
                                                    Next
                                                    <svg width="20" height="20">
                                                        <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-right" />
                                                    </svg>
                                                </button>
                                            </div>
                                        <?php endif;?>
                                    </div>

                                </div>
                            <?php 
                                $index++;
                                endforeach;?>
                        </div>
                    </div>
                </div>
                <?php $this->load->view("_partials/footer-bar")?>
            </div>
        </div>
    </div>

    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?>

<?php $this->load->view("_partials/footer")?>

<script>
    $("#hidePassword").hide();
    
    $("#showPassword").click(function(){
        $("input[name='password']").prop('type', 'text');
        $("#showPassword").hide();
        $("#hidePassword").show()
    })
    
    $("#hidePassword").click(function(){
        $("input[name='password']").prop('type', 'password');
        $("#showPassword").show();
        $("#hidePassword").hide()
    })

    $("select[name='fontSize']").change(function(){
        let size = $(this).val();
        $(".soal").css("font-size",size);
        $(this).val(size)
    })

    var click = false;
    $(".btnNext").click(function(){
        let id = $(this).data("id");
                        
        // hide all id 
        $("div[id^='sesi-'").hide();
        // show sesi 
        $("#"+id).show();
        
        // scroll to top 
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#elementtoScrollToID").offset().top
            }, 1000);
        }
    })
    
    $(".btnBack").click(function(){
        let id = $(this).data("id");
        $("div[id^='sesi-'").hide();
        $("#"+id).show();

        // scroll to top 
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#elementtoScrollToID").offset().top
            }, 1000);
        }
    })

    function secpass() {
        'use strict';
        
        var min     = Math.floor(sec / 60),
            remSec  = sec % 60;
        
        if (remSec < 10) {
            
            remSec = '0' + remSec;
        
        }
        if (min < 10) {
            
            min = '0' + min;
        
        }
        countDiv.innerHTML = min + ":" + remSec;
        
        if (sec > 0) {
            sec = sec - 1;
        } else {
            clearInterval(countDown);
            $("#formSoal").submit();
        }
    }

    $('input:radio').click(function () {
        let id = $(this).data("id");
        id = id.split("|");
        let value = $(this).val();
        $("#jawaban_sesi_"+id[0]+""+id[1]).val(value);
    });
</script>