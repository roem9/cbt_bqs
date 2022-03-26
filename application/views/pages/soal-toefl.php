<?php $this->load->view("_partials/header")?>
    <div class="page page-center" id="login">
        <div class="container-tight py-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="javascript:void()"><img src="<?= $link['value']?>/assets/img/logo.png" height="80" alt=""></a>
                    </div>
                    <h2 class="card-title text-center mb-4"><?= $title?></h2>
                    <?php if( $this->session->flashdata('pesan') ) : ?>
                        <?= $this->session->flashdata('pesan')?>
                    <?php else: ?>
                        <div class="mb-2">
                            <label class="form-label">
                            Password
                            </label>
                            <div class="input-group input-group-flat">
                            <input type="password" name="password" class="form-control"  placeholder="Password"  autocomplete="off">
                            <span class="input-group-text">
                                <a href="javascript:void(0)" class="link-secondary" title="Show password" data-bs-toggle="tooltip">
                                <svg width="24" height="24" id="showPassword">
                                    <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-eye" />
                                </svg>
                                <svg width="24" height="24" id="hidePassword" style="display:nones">
                                    <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-eye-off" />
                                </svg>
                                </a>
                            </span>
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="button" class="btn btn-primary w-100 btnSignIn" style="display:nones">Masuk</button>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>

    <div class="page page-center" id="transisi-sesi-1" style="display: none">
        <div class="container-tight py-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="javascript:void()"><img src="<?= $link['value']?>/assets/img/logo.png" height="80" alt=""></a>
                    </div>
                    <center>
                        <p><b>SESI 1 : LISTENING COMPREHENSION</b></p>
                        <p><i>Audio untuk tes hanya dapat diputar 1 (satu) kali.</i></p>
                        <p><i>Tes akan berakhir ketika audio berakhir dan Anda diwajibkan untuk submit jawaban Anda.</i></p>
                    </center>
                    <div class="form-footer">
                        <button type="button" class="btn btn-primary w-100 btnTransisi" data-id="sesi-1" >Mulai Tes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page page-center" id="transisi-sesi-2" style="display: none">
        <div class="container-tight py-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="javascript:void()"><img src="<?= $link['value']?>/assets/img/logo.png" height="80" alt=""></a>
                    </div>
                    <center>
                        <p><b>SESI 2 : STRUCTURE AND WRITTEN EXPRESSION</b></p>
                        <p><i>Tes dan timer akan langsung berjalan ketika Anda memulai tes ini dengan klik tombol "Next"</i></p>
                        <p><i>Tes akan berakhir ketika waktu pengerjaan habis dan Anda diwajibkan untuk submit jawaban Anda</i></p>
                    </center>
                    <div class="form-footer">
                        <button type="button" class="btn btn-primary w-100 btnTransisi" data-id="sesi-2">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page page-center" id="transisi-sesi-3" style="display: none">
        <div class="container-tight py-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <a href="javascript:void()"><img src="<?= $link['value']?>/assets/img/logo.png" height="80" alt=""></a>
                    </div>
                    <center>
                        <p><b>SESI 3 : READING COMPREHENSION</b></p>
                        <p><i>Tes dan timer akan langsung berjalan ketika Anda memulai tes ini dengan klik tombol "Next"</i></p>
                        <p><i>Tes akan berakhir ketika waktu pengerjaan habis dan Anda diwajibkan untuk submit jawaban Anda</i></p>
                    </center>
                    <div class="form-footer">
                        <button type="button" class="btn btn-primary w-100 btnTransisi" data-id="sesi-3">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="soal_tes" style="display: none">
        <div class="wrapper" id="elementtoScrollToID">
            <div class="sticky-top">
                <?php $this->load->view("_partials/navbar-header")?>
            </div>
            <div class="page-wrapper" id="">
                <div class="page-body">
                    <div class="container-xl">
                        <div class="row row-cards FieldContainer" data-masonry='{"percentPosition": true }'>
                            <?php if($soal['tipe_soal'] == "TOAFL" || $soal['tipe_soal'] == "TOEFL") :?>
                                <form action="<?= base_url()?>soal/add_jawaban_toefl" method="post" id="formSoal">
                            <?php else :?>
                                <form action="<?= base_url()?>soal/add_jawaban" method="post" id="formSoal">
                            <?php endif;?>
                                <input type="hidden" name="id_tes" value="<?= $id?>">
                                <div id="sesi-0">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <p>Data Diri<br><i>(Harap mengisi data diri sesuai dengan data yang sebenarnya)</i></p>
                                        </div>
                                        <div class="card-body">
                                            <?= $form?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-md btn-success btnNext" data-id="sesi-1">
                                                Next
                                                <svg width="20" height="20">
                                                    <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-right" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="sesi-1">
                                    <?php $index = 1;?>
                                    <?php $jumlah_sesi = 1;?>
    
                                    <input type="hidden" name="sesi-<?=$index + 1?>" value="<?= $sesi[0]['jumlah_soal']?>">
                                    <input type="hidden" name="kunci_sesi[]" value="<?= $sesi[0]['id_sub']?>">
    
                                    <?php foreach ($sesi[0]['soal'] as $i => $data) :
                                        $item = "";
    
                                        $padding = "";
                                        ?>
                                        <?php if($data['item'] == "soal") :?>
                                            <?php if($data['penulisan'] == "RTL") :?>
                                                <?php $soal = '<div dir="rtl" class="mb-3">'.$data['data']['soal'].'</div>' ?>
                                                <input type="hidden" name="jawaban_sesi_<?= $index?>[]" data-id="soal-<?= $i?>" id="jawaban_sesi_<?= $index?><?= $i?>" value="null">
                                                <?php $pilihan = "";?>
                                                <?php foreach ($data['data']['pilihan'] as $k => $choice) :?>
                                                    <?php $pilihan .= '
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <div class="text-right" dir="rtl">
                                                                    <label>
                                                                        <input type="radio" data-id="'.$index.'|'.$i.'"  name="radio-'.$index.'['.$i.']" value="'.$choice.'"> 
                                                                        <span>'.$choice.'</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>' ?>
                                                <?php endforeach;?>
                                                <?php $item = $soal.$pilihan;?>
                                            <?php else :?>
                                                <?php $soal = '<div class="mb-3">'.$data['data']['soal'].'</div>' ?>
                                                <input type="hidden" name="jawaban_sesi_<?= $index?>[]" data-id="soal-<?= $i?>" id="jawaban_sesi_<?= $index?><?= $i?>" value="null">
                                                <?php $pilihan = "";?>
                                                <?php foreach ($data['data']['pilihan'] as $k => $choice) :?>
                                                    <?php $pilihan .= '
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio" data-id="'.$index.'|'.$i.'"  name="radio-'.$index.'['.$i.']" value="'.$choice.'"> 
                                                                <span>'.$choice.'</span>
                                                            </label>
                                                        </div>' ?>
                                                <?php endforeach;?>
                                                <?php $item = $soal.$pilihan;?>
                                            <?php endif;?>
                                        <?php elseif($data['item'] == "petunjuk") :
                                                if($data['penulisan'] == "RTL"){
                                                    $item = '<div dir="rtl" class="mb-3">'.$data['data'].'</div>';
                                                } else {
                                                    $item = '<div dir="ltr" class="mb-3">'.$data['data'].'</div>';
                                                }?>
                                        <?php elseif($data['item'] == "audio") :
                                            $item = '<center>
                                                        <audio id="audio-'.$data['id_item'].'" class="audio" data-id="'.$data['id_item'].'"><source src="'.$link['value'].'/assets/myaudio/'.$data['data'].'?t='.time().'" type="audio/mpeg"></audio>
                                                        <progress id="seekbar-'.$data['id_item'].'" value="0" max="1" style="width:100%;"></progress><br>
                                                        <button class="btn btn-success btnAudio" data-id="'.$data['id_item'].'" type="button">'.tablerIcon("player-play", "").' play</button>
                                                        <p><small class="text-danger"><i>note : perhatian, audio hanya dapat diputar satu kali</i></small></p>
                                                    </center>
                                                    ';
                                        ?>
                                        <?php endif;?>
                                        <div class="shadow card mb-3 soalListening" id="soal-1-<?= $i?>" style="display: none">
                                            <div class="card-body <?= $padding?>" id="soal-<?= $i?>">
                                                
                                                <?= $item?>
    
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>

                                <div id="sesi-2">
                                    <?php $index = 2;?>
                                    <?php $jumlah_sesi = 2;?>

                                    <input type="hidden" name="sesi-<?=$index + 1?>" value="<?= $sesi[1]['jumlah_soal']?>">
                                    <input type="hidden" name="kunci_sesi[]" value="<?= $sesi[1]['id_sub']?>">
                                    
                                    <div class="mb-3" id="nomor-sesi-2" style="display:none">
                                        <?php 
                                            $no = 1;
                                            foreach ($sesi[1]['soal'] as $i => $data) :?>
                                            <?php if($data['item'] == "soal"):?>
                                                <a style="width:42px;height:30px;" class="btn btn-sm btn-block btn-light btn_number_2" id="btn-number-2-<?= $i?>" data-id="soal-2-<?= $i?>"><?= $no?></a>
                                                <?php $no++;?>
                                            <?php else :?>
                                                <a style="width:42px;height:30px;" class="btn btn-sm btn-block btn-light btn_number_2" data-id="soal-2-<?= $i?>"><?= tablerIcon("info-circle")?></a>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </div>

    
                                    <?php foreach ($sesi[1]['soal'] as $i => $data) :
                                        $item = "";
    
                                        $padding = "";
                                        ?>
                                        <?php if($data['item'] == "soal") :?>
                                            <?php if($data['penulisan'] == "RTL") :?>
                                                <?php $soal = '<div dir="rtl" class="mb-3">'.$data['data']['soal'].'</div>' ?>
                                                <input type="hidden" name="jawaban_sesi_<?= $index?>[]" data-id="soal-<?= $i?>" id="jawaban_sesi_<?= $index?><?= $i?>" value="null">
                                                <?php $pilihan = "";?>
                                                <?php foreach ($data['data']['pilihan'] as $k => $choice) :?>
                                                    <?php $pilihan .= '
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <div class="text-right" dir="rtl">
                                                                    <label>
                                                                        <input type="radio" data-btn="btn-number-2-'.$i.'" data-id="'.$index.'|'.$i.'"  name="radio-'.$index.'['.$i.']" value="'.$choice.'"> 
                                                                        <span>'.$choice.'</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>' ?>
                                                <?php endforeach;?>
                                                <?php $item = $soal.$pilihan;?>
                                            <?php else :?>
                                                <?php $soal = '<div class="mb-3">'.$data['data']['soal'].'</div>' ?>
                                                <input type="hidden" name="jawaban_sesi_<?= $index?>[]" data-id="soal-<?= $i?>" id="jawaban_sesi_<?= $index?><?= $i?>" value="null">
                                                <?php $pilihan = "";?>
                                                <?php foreach ($data['data']['pilihan'] as $k => $choice) :?>
                                                    <?php $pilihan .= '
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio" data-btn="btn-number-2-'.$i.'" data-id="'.$index.'|'.$i.'"  name="radio-'.$index.'['.$i.']" value="'.$choice.'"> 
                                                                <span>'.$choice.'</span>
                                                            </label>
                                                        </div>' ?>
                                                <?php endforeach;?>
                                                <?php $item = $soal.$pilihan;?>
                                            <?php endif;?>
                                        <?php elseif($data['item'] == "petunjuk") :
                                                if($data['penulisan'] == "RTL"){
                                                    $item = '<div dir="rtl" class="mb-3">'.$data['data'].'</div>';
                                                } else {
                                                    $item = '<div dir="ltr" class="mb-3">'.$data['data'].'</div>';
                                                }?>
                                        <?php elseif($data['item'] == "audio") :
                                            $item = '<center>
                                                        <audio id="audio-'.$data['id_item'].'" class="audio" data-id="'.$data['id_item'].'"><source src="'.$link['value'].'/assets/myaudio/'.$data['data'].'?t='.time().'" type="audio/mpeg"></audio>
                                                        <progress id="seekbar-'.$data['id_item'].'" value="0" max="1" style="width:100%;"></progress><br>
                                                        <button class="btn btn-success btnAudio" data-id="'.$data['id_item'].'" type="button">'.tablerIcon("player-play", "").' play</button>
                                                        <p><small class="text-danger"><i>note : perhatian, audio hanya dapat diputar satu kali</i></small></p>
                                                    </center>
                                                    ';
                                        ?>
                                        <?php endif;?>
                                        <div class="shadow card mb-3 soalStructure" id="soal-2-<?= $i?>" style="display: none">
                                            <div class="card-body <?= $padding?>" id="soal-<?= $i?>">
                                                
                                                <?= $item?>
                                                <?php $jumlah_soal = $sesi[1]['jumlah_soal'] - 1;?>

                                                <?php if($i == 0) : ?>
                                                    <div class="d-flex justify-content-end">
                                                        <a class="btn btn-sm btn-success btnNextStructure" data-id="soal-2-<?= $i+1?>">
                                                            <?= tablerIcon("arrow-right");?>
                                                        </a>
                                                    </div>
                                                <?php elseif($i == $jumlah_soal) :?>
                                                    <div class="d-flex justify-content-between">
                                                        <a class="btn btn-sm btn-success btnBackStructure" data-id="soal-2-<?= $i-1?>">
                                                            <?= tablerIcon("arrow-left");?>
                                                        </a>
                                                        
                                                        <button type="button" class="btn btn-md btn-success btnNext" data-id="sesi-<?= $index + 1?>">
                                                            Next
                                                            <svg width="20" height="20">
                                                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-narrow-right" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                <?php else :?>
                                                    <div class="d-flex justify-content-between">
                                                        <a class="btn btn-sm btn-success btnBackStructure" data-id="soal-2-<?= $i-1?>">
                                                            <?= tablerIcon("arrow-left");?>
                                                        </a>
        
                                                        <a class="btn btn-sm btn-success btnNextStructure" data-id="soal-2-<?= $i+1?>">
                                                            <?= tablerIcon("arrow-right");?>
                                                        </a>
                                                    </div>
                                                <?php endif;?>
    
                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>

                                <div id="sesi-3">
                                    <?php   
                                        $index = 3;
                                        $jumlah_sesi = 3;
                                    ?>

                                    <input type="hidden" name="sesi-<?=$index + 1?>" value="<?= $sesi[2]['jumlah_soal']?>">
                                    <input type="hidden" name="kunci_sesi[]" value="<?= $sesi[2]['id_sub']?>">

                                    <div class="mb-3" id="nomor-sesi-3" style="display:none">
                                        <?php 
                                            $no = 1;
                                            foreach ($sesi[2]['soal'] as $i => $data) :?>
                                            <?php if($data['tampil'] == "Ya") :?>
                                                <?php if($data['item'] == "soal"):?>
                                                    <a style="width:42px;height:30px;" class="btn btn-sm btn-block btn-light btn_number_3" id="btn-number-3-<?= $i?>" data-id="soal-3-<?= $i?>"><?= $no?></a>
                                                    <?php $no++;?>
                                                <?php else :?>
                                                    <a style="width:42px;height:30px;" class="btn btn-sm btn-block btn-light btn_number_3" data-id="soal-3-<?= $i?>"><?= tablerIcon("info-circle")?></a>
                                                <?php endif;?>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </div>
    
                                    <?php 
                                        // $i = 0;
                                        foreach ($sesi[2]['soal'] as $i => $data) :
                                        $item = "";
    
                                        $padding = "";
                                        ?>
                                        <?php if($data['item'] == "soal") :?>
                                            <?php if($data['penulisan'] == "RTL") :?>
                                                <?php $soal = '<div dir="rtl" class="mb-3">'.$data['data']['soal'].'</div>' ?>
                                                <input type="hidden" name="jawaban_sesi_<?= $index?>[]" data-id="soal-<?= $i?>" id="jawaban_sesi_<?= $index?><?= $i?>" value="null">
                                                <?php $pilihan = "";?>
                                                <?php foreach ($data['data']['pilihan'] as $k => $choice) :?>
                                                    <?php $pilihan .= '
                                                        <div class="mb-3">
                                                            <div class="form-check">
                                                                <div class="text-right" dir="rtl">
                                                                    <label>
                                                                        <input type="radio" data-btn="btn-number-3-'.$i.'" data-id="'.$index.'|'.$i.'"  name="radio-'.$index.'['.$i.']" value="'.$choice.'"> 
                                                                        <span>'.$choice.'</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>' ?>
                                                <?php endforeach;?>
                                                <?php $item = $soal.$pilihan;?>
                                            <?php else :?>
                                                <?php $soal = '<div class="mb-3">'.$data['data']['soal'].'</div>' ?>
                                                <input type="hidden" name="jawaban_sesi_<?= $index?>[]" data-id="soal-<?= $i?>" id="jawaban_sesi_<?= $index?><?= $i?>" value="null">
                                                <?php $pilihan = "";?>
                                                <?php foreach ($data['data']['pilihan'] as $k => $choice) :?>
                                                    <?php $pilihan .= '
                                                        <div class="mb-3">
                                                            <label>
                                                                <input type="radio" data-btn="btn-number-3-'.$i.'" data-id="'.$index.'|'.$i.'"  name="radio-'.$index.'['.$i.']" value="'.$choice.'"> 
                                                                <span>'.$choice.'</span>
                                                            </label>
                                                        </div>' ?>
                                                <?php endforeach;?>
                                                <?php $item = $soal.$pilihan;?>
                                            <?php endif;?>
                                        <?php elseif($data['item'] == "petunjuk") :
                                                if($data['penulisan'] == "RTL"){
                                                    $item = '<div dir="rtl" class="mb-3">'.$data['data'].'</div>';
                                                } else {
                                                    $item = '<div dir="ltr" class="mb-3">'.$data['data'].'</div>';
                                                }?>
                                        <?php elseif($data['item'] == "audio") :
                                            $item = '<center>
                                                        <audio id="audio-'.$data['id_item'].'" class="audio" data-id="'.$data['id_item'].'"><source src="'.$link['value'].'/assets/myaudio/'.$data['data'].'?t='.time().'" type="audio/mpeg"></audio>
                                                        <progress id="seekbar-'.$data['id_item'].'" value="0" max="1" style="width:100%;"></progress><br>
                                                        <button class="btn btn-success btnAudio" data-id="'.$data['id_item'].'" type="button">'.tablerIcon("player-play", "").' play</button>
                                                        <p><small class="text-danger"><i>note : perhatian, audio hanya dapat diputar satu kali</i></small></p>
                                                    </center>
                                                    ';
                                        ?>
                                        <?php endif;?>

                                        <?php if($data['tampil'] != "Tidak") :?>
                                            <div class="shadow card mb-3 soalReading" id="soal-3-<?= $i?>" style="display: none">
                                                <div class="card-body <?= $padding?>" id="soal-<?= $i?>">
                                                    

                                                <?php if($data['id_text'] != 0) :?>
                                                    <?php $text = textReading($data['id_text']) ;?>
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <?= $text['data'];?>
                                                        </div>
                                                        <div class="col-3">
                                                            <?= $item?>
                                                        </div>
                                                    </div>
                                                <?php else :?>
                                                    <?= $item;?>
                                                <?php endif;?>
                                                    <?php $jumlah_soal = $sesi[2]['jumlah_soal'] - 1;?>

                                                    <?php if($i == 0) : ?>
                                                        <div class="d-flex justify-content-end">
                                                            <a class="btn btn-sm btn-success btnNextReading" data-id="soal-3-<?= $i+1?>">
                                                                <?= tablerIcon("arrow-right");?>
                                                            </a>
                                                        </div>
                                                    <?php elseif($i == $jumlah_soal) :?>
                                                        <div class="d-flex justify-content-between">
                                                            <a class="btn btn-sm btn-success btnBackReading" data-id="soal-3-<?= $i-1?>">
                                                                <?= tablerIcon("arrow-left");?>
                                                            </a>
                                                            
                                                            <button type="button" class="btn btn-md btn-primary btnSimpan" data-id="sesi-<?= $index + 1?>">
                                                                <svg width="20" height="20">
                                                                    <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-device-floppy" />
                                                                </svg>
                                                                Simpan
                                                            </button>
                                                        </div>
                                                    <?php else :?>
                                                        <div class="d-flex justify-content-between">
                                                            <a class="btn btn-sm btn-success btnBackReading" data-id="soal-3-<?= $i-1?>">
                                                                <?= tablerIcon("arrow-left");?>
                                                            </a>
            
                                                            <a class="btn btn-sm btn-success btnNextReading" data-id="soal-3-<?= $i+1?>">
                                                                <?= tablerIcon("arrow-right");?>
                                                            </a>
                                                        </div>
                                                    <?php endif;?>
        
                                                </div>
                                            </div>
                                        <?php 
                                            $i++;
                                            endif;?>

                                    <?php endforeach;?>
                                </div>

                            </div>

                            </form>
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
    // structure 
        $(".btnNextStructure").click(function(){
            let id = $(this).data("id");

            $(".soalStructure").hide();
            $("#"+id).show();
        })

        $(".btnBackStructure").click(function(){
            let id = $(this).data("id");

            $(".soalStructure").hide();
            $("#"+id).show();
        })

        $(".btn_number_2").click(function(){
            let data = $(this).data("id");

            $(".soalStructure").hide();
            $("#"+data).show();
        })
    // structure 

    // reading 
    $(".btnNextReading").click(function(){
            let id = $(this).data("id");

            $(".soalReading").hide();
            $("#"+id).show();
        })

        $(".btnBackReading").click(function(){
            let id = $(this).data("id");

            $(".soalReading").hide();
            $("#"+id).show();
        })

        $(".btn_number_3").click(function(){
            let data = $(this).data("id");

            $(".soalReading").hide();
            $("#"+data).show();
        })
    // reading 

    var jumlah_soal_listening = <?= $sesi[0]['jumlah_soal']?>;

    function soalListening(){
        $(".audio")[0].play();
        $("#soal-1-1").show();

        i = 2;
        var intervalId = window.setInterval(function(){
            $(".soalListening").hide();
            $("#soal-1-"+i).show();
            
            if(i == jumlah_soal_listening){
                clearInterval(intervalId) 
                $("#transisi-sesi-2").show();
            }

            i++;
        }, 1000);
    }

    $(window).on('load', function (e) {
        $(".btnSignIn").show()
    })
    
    $('.audio').on('timeupdate', function() {
        let id = $(this).data("id");
        $('#seekbar-'+id).attr("value", this.currentTime / this.duration);
    });

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

    $(".btnSignIn").click(function(){
        let id_tes = $("input[name='id_tes']").val();
        let password = $("input[name='password']").val();

        $.ajax({
            url: "<?= base_url()?>soal/password_check",
            method: "POST",
            data: {id:id_tes, password:password},
            success: function(result){
                if(result){
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: 'Berhasil masuk',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#login").hide();
                    $("#soal_tes").show();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Password yang Anda masukkan salah'
                    })
                }
            }
        })
    })

    $(".btnAudio").click(function(){
        id = $(this).data("id");
        $("#audio-"+id)[0].play();
        $(this).hide();
    })

    $(".btnTransisi").click(function(){
        let id = $(this).data("id");
        
        Swal.fire({
            icon: 'question',
            html: 'Yakin akan memulai sesi ini?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
                $("#soal_tes").show();

                if(id != 'sesi-1'){
                    if(typeof countDown != 'undefined'){
                        clearInterval(countDown);
                    }

                    if(id == 'sesi-2'){
                        
                        var audios = document.getElementsByTagName('audio');  
                        for(var i = 0, len = audios.length; i < len;i++){  
                            if(audios[i]){  
                                audios[i].pause();  
                            }  
                        }

                        $("#soal-2-0").show();
                        $("#nomor-sesi-2").show();

                        sec = 25 * 60;
                    } else if(id == 'sesi-3'){
                        $("#soal-3-0").show();
                        $("#nomor-sesi-3").show();

                        sec = 55 * 60;
                    }

                    countDiv = document.getElementById("waktu"),
                    secpass,
                    countDown = setInterval(function () {
                        'use strict';
                        secpass(id);
                    }, 1000);
                } else {
                    soalListening();
                }

                // hide all id 
                $("div[id^='sesi-'").hide();
                $("div[id^='transisi-'").hide();

                // show sesi 
                $("#"+id).show();
                
                // scroll to top 
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#elementtoScrollToID").offset().top
                    }, 1000);
                }
            }
        })
    })

    var click = false;
    $(".btnNext").click(function(){
        let id = $(this).data("id");

        if(id == "sesi-1"){

            let form = "#sesi-0";

            let email = $(form+" [name='email']").val();
            let id_tes = "<?= $id?>"

            let eror = required(form);
            
            if(eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lengkapi data terlebih dahulu',
                })
            } else {
                let table = "<?= $table?>";
                
                $.ajax({
                    url: "<?= base_url()?>soal/email_check/"+table,
                    data: {email:email, id:id_tes},
                    dataType: "JSON",
                    method: "POST",
                    success: function(result){
                        if(result) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Maaf email Anda telah digunakan',
                            })
                        } else {
                            
                            Swal.fire({
                                icon: 'question',
                                html: 'Yakin akan memulai tes?',
                                showCloseButton: true,
                                showCancelButton: true,
                                confirmButtonText: 'Ya',
                                cancelButtonText: 'Tidak'
                            }).then(function (result) {
                                if (result.value) {
                                    $("#soal_tes").hide();

                                    // hide all id 
                                    $("div[id^='sesi-'").hide();
                                    $("div[id^='transisi-sesi'").hide();

                                    // show sesi 
                                    $("#transisi-"+id).show();

                                    // scroll to top 
                                    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                                        $([document.documentElement, document.body]).animate({
                                            scrollTop: $("#elementtoScrollToID").offset().top
                                        }, 1000);
                                    }
                                }
                            })
                        }
                    }
                })
            }
            
        } else {
            jumlah_soal = $("[name='"+id+"']").val();

            sesi = id.replace("sesi-", "");
            sesi = parseInt(sesi-1);

            // if($('#sesi-'+sesi+' input:radio:checked').length != jumlah_soal){
            
            //     $.each($("#sesi-"+sesi+" [name='jawaban_sesi_"+sesi+"[]']"), function(){
            //         index = $(this).data("id");
            //         $("#sesi-"+sesi+" #"+index).removeClass("list-group-item-danger")

            //         if($(this).val() == "null"){
            //             $("#sesi-"+sesi+" #"+index).addClass("list-group-item-danger")
            //         }
            //     })

            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Oops...',
            //         text: 'Anda belum menyelesaikan soal pada sesi ini',
            //     })
            // } else {
                // $.each($("#sesi-"+sesi+" [name='jawaban_sesi_"+sesi+"[]']"), function(){
                //     index = $(this).data("id");
                //     $("#sesi-"+sesi+" #"+index).removeClass("list-group-item-danger")

                //     if($(this).val() == "null"){
                //         $("#sesi-"+sesi+" #"+index).addClass("list-group-item-danger")
                //     }
                // })

                Swal.fire({
                    icon: 'question',
                    html: 'Yakin akan pindah ke sesi selanjutnya?<br><small style="font-size: 0.70em" class="form-text text-danger">Anda tidak akan bisa kembali ke sesi ini</small>',
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then(function (result) {
                    if (result.value) {
                        if(typeof countDown != 'undefined'){
                            clearInterval(countDown);
                        }

                        $("#soal_tes").hide();

                        // hide all id 
                        $("div[id^='sesi-'").hide();
                        $("div[id^='transisi-'").hide();

                        // show sesi 
                        $("#transisi-"+id).show();

                        // scroll to top 
                        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                            $([document.documentElement, document.body]).animate({
                                scrollTop: $("#elementtoScrollToID").offset().top
                            }, 1000);
                        }
                    }
                })
            // }
        }
    })
    
    $(".btnBack").click(function(){
        let id = $(this).data("id");
        $("div[id^='sesi-'").hide();
        $("#"+id).show();
    })

    $(".btnSimpan").click(function(){
        let id = $(this).data("id");
        jumlah_soal = $("[name='"+id+"']").val();

        sesi = id.replace("sesi-", "");
        sesi = parseInt(sesi-1);

        // if($('#sesi-'+sesi+' input:radio:checked').length != jumlah_soal){
        
        //     $.each($("#sesi-"+sesi+" [name='jawaban_sesi_"+sesi+"[]']"), function(){
        //         index = $(this).data("id");
        //         $("#sesi-"+sesi+" #"+index).removeClass("list-group-item-danger")

        //         if($(this).val() == "null"){
        //             $("#sesi-"+sesi+" #"+index).addClass("list-group-item-danger")
        //         }
        //     })

        //     Swal.fire({
        //         icon: 'error',
        //         title: 'Oops...',
        //         text: 'Anda belum menyelesaikan soal pada sesi ini',
        //     })
        // } else {
            Swal.fire({
                icon: 'question',
                html: 'Yakin telah menyelesaikan tes Anda?',
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then(function (result) {
                if (result.value) {
                    swal.fire({
                        html: '<h4>Menyimpan Jawaban Anda ...</h4>',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });

                    $(".btnSimpan").html("Menyimpan...");
                    $(".btnSimpan").prop("disabled", true);
                    $(".btnBack").prop("disabled", true);
                    $("#formSoal").submit()
                }
            })
        // }
    })

    function secpass(id) {
        'use strict';
        var min = Math.floor(sec / 60),
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
            if(id == 'sesi-2'){
                clearInterval(countDown);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Waktu Anda telah habis untuk mengerjakan soal structure',
                    allowOutsideClick: false,
                }).then(function (result) {
                    $("#soal_tes").hide();

                    // hide all id 
                    $("div[id^='sesi-'").hide();
                    $("div[id^='transisi-'").hide();

                    // show sesi 
                    $("#transisi-sesi-3").show();
                })
            } else {
                clearInterval(countDown);

                // scroll to top 
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#elementtoScrollToID").offset().top
                    }, 1000);
                }

                swal.fire({
                    title: 'Waktu Anda Telah Habis',
                    html: '<h4>Menyimpan Jawaban Anda ...</h4>',
                    allowOutsideClick: false,
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });

                $(".btnSimpan").html("Menyimpan...");
                $(".btnSimpan").prop("disabled", true);
                $(".btnBack").prop("disabled", true);
                $("#formSoal").submit()
            }
        }
    }

    $('input:radio').click(function () {
        let id = $(this).data("id");
        id = id.split("|");
        let value = $(this).val();
        $("#jawaban_sesi_"+id[0]+""+id[1]).val(value);

        let btn = $(this).data("btn");
        $("#"+btn).removeClass("btn-light");
        $("#"+btn).addClass("btn-success");
    });

    document.addEventListener('play', function(e){  
        var audios = document.getElementsByTagName('audio');  
        for(var i = 0, len = audios.length; i < len;i++){  
            if(audios[i] != e.target){  
                audios[i].pause();  
            }  
        }  
    }, true);
</script>