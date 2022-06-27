<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Main_model");
        $this->load->model("Other_model");
        ini_set('xdebug.var_display_max_depth', '10');
        ini_set('xdebug.var_display_max_children', '256');
        ini_set('xdebug.var_display_max_data', '1024');
    }

    public function id($id_peserta){
        $data['background'] = $this->Main_model->get_one("config", ["field" => 'background']);
        $data['link'] = $this->Main_model->get_one("config", ['field' => "web admin"]);

        $data['title'] = "Member Area Tes TOEFL Prediction Online";
        $data['peserta'] = $this->Main_model->get_one("peserta_bussiness", ["md5(id_peserta)" => $id_peserta]);

        $data['tes_peserta'] = $this->Main_model->get_all("tes_peserta_bussiness", ["md5(id_peserta)" => $id_peserta], "skor_toefl", "DESC");

        // javascript 
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
        ];

        if( $this->session->flashdata('pesan') ) {
            $this->load->view("pages/selesai-tes", $data);
        } else {
            $this->load->view("pages/member-bussiness", $data);
        }
    }

    public function test($id_peserta){
        // $tes = $this->Main_model->get_one("tes", ["md5(id_tes)" => $id_tes, "status" => "Berjalan"]);
        $peserta = $this->Main_model->get_one("peserta_bussiness", ["md5(id_peserta)" => $id_peserta]);

        $data['background'] = $this->Main_model->get_one("config", ["field" => 'background']);
        
        $data['link'] = $this->Main_model->get_one("config", ['field' => "web admin"]);
        
        if($peserta){

            $this->db->from("soal");
            $this->db->where(["hapus" => 0, "status" => "Ready"]);
            $this->db->order_by("RAND()");
            $tes = $this->db->get()->row_array();

            // var_dump($tes);

            $soal = $this->Main_model->get_one("soal", ["id_soal" => $tes['id_soal']]);
            $sesi = $this->Main_model->get_all("sesi_soal", ["id_soal" => $soal['id_soal']]);

            $data['peserta'] = $peserta;
            $data['title'] = "TOEFL PREDICTION TEST";
            $data['tes']['waktu'] = 120;
            $data['soal'] = $soal;
            foreach ($sesi as $i => $sesi) {
                
                if($peserta['tampilan_soal'] == "Training V1"){
                    $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub']], 'urutan');
                } else if($peserta['tampilan_soal'] == "Training V2"){
                    $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub']], 'urutan');
                } else if($peserta['tampilan_soal'] == "TOEFL ITP"){
                    $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub'], "tampil" => "Ya"], 'urutan');
                }

                $data['sesi'][$i] = [];
                $number = 1;
                foreach ($sub_soal as $j => $soal) {
                    if($soal['item'] == "soal"){
                        // from json to array 
                        // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                        $string = trim(preg_replace('/\s+/', ' ', $soal['data']));
                        // $txt_soal = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $soal['data']), true );
                        $txt_soal = json_decode($string, true );
                        
                        if($soal['penulisan'] == "RTL"){
                            $no = $this->Other_model->angka_arab($number).". ";
                            $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                        } else {
                            $no = $number.". ";
                            $txt_soal['soal'] = str_replace("{no}", $no, $txt_soal['soal']);
                        }

                        $data['sesi'][$i]['soal'][$j]['id_item'] = $soal['id_item'];
                        $data['sesi'][$i]['soal'][$j]['item'] = $soal['item'];
                        $data['sesi'][$i]['soal'][$j]['data']['soal'] = $txt_soal['soal'];
                        $data['sesi'][$i]['soal'][$j]['data']['pilihan'] = $txt_soal['pilihan'];
                        $data['sesi'][$i]['soal'][$j]['data']['jawaban'] = $txt_soal['jawaban'];
                        $data['sesi'][$i]['soal'][$j]['penulisan'] = $soal['penulisan'];
                        $data['sesi'][$i]['soal'][$j]['id_text'] = $soal['id_text'];
                        $data['sesi'][$i]['soal'][$j]['tampil'] = $soal['tampil'];
                        $data['sesi'][$i]['soal'][$j]['waktu_soal'] = $soal['waktu_soal'];

                        if(isset($txt_soal['pembahasan_benar'])){
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_benar'] = $txt_soal['pembahasan_benar'];
                        } else {
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_benar'] = "";
                        }
            
                        if(isset($txt_soal['pembahasan_salah'])){
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_salah'] = $txt_soal['pembahasan_salah'];
                        } else {
                            $data['sesi'][$i]['soal'][$j]['data']['pembahasan_salah'] = "";
                        }
                        
                        $number++;

                    } else if($soal['item'] == "petunjuk" || $soal['item'] == "audio" || $soal['item'] == "gambar"){
                        $data['sesi'][$i]['soal'][$j] = $soal;
                    }

                    if($peserta['tampilan_soal'] == "Training V1"){
                        $data['sesi'][$i]['jumlah_soal'] = COUNT($this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub'], "item" => "soal"]));
                    } else if($peserta['tampilan_soal'] == "Training V2"){
                        $data['sesi'][$i]['jumlah_soal'] = COUNT($this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub'], "item" => "soal"]));
                    } else if($peserta['tampilan_soal'] == "TOEFL ITP"){
                        $data['sesi'][$i]['jumlah_soal'] = COUNT($this->Main_model->get_all("item_soal", ["id_sub" => $sesi['id_sub'], "tampil" => "Ya"]));
                    }

                    $data['sesi'][$i]['id_sub'] = $sesi['id_sub'];
                }
            }

            // javascript 
            $data['js'] = [
                "ajax.js",
                "function.js",
                "helper.js",
            ];

            
            if($this->session->flashdata('pesan') && $tes['pembahasan'] == "Ya"){
                $this->load->view("pages/soal-pembahasan", $data);
            } else {
                if($data['soal']['tipe_soal'] == "TOEFL"){
                    if($peserta['tampilan_soal'] == "Training V1"){
                        $this->load->view("pages/bussiness-soal-toefl-training-v1", $data);
                    } else if($peserta['tampilan_soal'] == "Training V2"){
                        $this->load->view("pages/bussiness-soal-toefl-training-v2", $data);
                    } else if($peserta['tampilan_soal'] == "TOEFL ITP"){
                        $this->load->view("pages/bussiness-soal-toefl-itp", $data);
                    }
                } else {
                    $this->load->view("pages/soal", $data);
                }
            }
        } else {
            $data['title'] = "Blank Link";
            $this->load->view("pages/blank", $data);
        }

    }

    public function add_jawaban_toefl(){
        $config = $this->config();

        $id_peserta = $this->input->post("id_peserta");
        $id_soal = $this->input->post("id_soal");

        $soal = $this->Main_model->get_one("soal", ["id_soal" => $id_soal]);
        $sesi = COUNT($this->Main_model->get_all("sesi_soal", ["id_soal" => $soal['id_soal']]));
        $id_sub = $this->input->post("kunci_sesi");
        
        $text = "";

        
        for ($i=1; $i < $sesi+1; $i++) {
            $benar = 0;
            $salah = 0;
            $nilai = "";
            $id = $id_sub[$i-1];
            $sub_soal = $this->Main_model->get_all("item_soal", ["id_sub" => $id, "item" => "soal"], 'urutan');
            $jawaban = $this->input->post("jawaban_sesi_".$i);
            // $jum_soal = COUNT($sub_soal);
            foreach ($sub_soal as $j => $sub_soal) {
                // from json to array 
                $string = trim(preg_replace('/\s+/', ' ', $sub_soal['data']));
                $txt_soal = json_decode($string, true );

                $sub_soal = $txt_soal['jawaban'];
                if($sub_soal == $jawaban[$j]){
                    $status = "benar";
                    $benar++;
                } else {
                    $status = "salah";
                    $salah++;
                }
                $no = $j+1;
                $text .= '['.$i.','.$no.',"'.$jawaban[$j].'","'.$status.'"],';
            }

            if($i == 1){
                $nilai_listening = $benar;
            } elseif ($i == 2) {
                $nilai_structure = $benar;
            } elseif ($i == 3) {
                $nilai_reading = $benar;
            }
        }

        
        $text = substr($text, 0, -1);
        $text = '{"jawaban":['.$text.']}';
        
        $skor = skor($nilai_listening, $nilai_structure, $nilai_reading);

        $data = [
            "id_peserta" => $id_peserta,
            "id_soal" => $id_soal,
            "waktu_mulai" => $this->input->post("waktu_mulai"),
            // "sisa_waktu_structure" => $this->input->post("sisa_waktu_structure"),
            // "sisa_waktu_reading" => $this->input->post("sisa_waktu_reading"),
            "nilai_listening" => $nilai_listening,
            "nilai_structure" => $nilai_structure,
            "nilai_reading" => $nilai_reading,
            "jawaban" => $text,
            "skor_toefl" => $skor
        ];

        $id = $this->Main_model->add_data("tes_peserta_bussiness", $data);

        // add barcode 
            if($tes['tipe_tes'] == 'Tes TOEFL (Bersertifikat)'){
                $this->add_sertifikat_toefl($id);
            }
        // add barcode 

        $data['msg'] = "
            Selamat Anda Telah Menyelesaikan TES TOEFL PREDICTION Online, Berikut ini hasil dari tes Anda : <br>
            Nilai Listening : ".poin("Listening", $nilai_listening)."<br>
            Nilai Structure : ".poin("Structure", $nilai_structure)."<br>
            Nilai Reading : ".poin("Reading", $nilai_reading)."<br>
            SKOR TOEFL : ".$skor."<br>
        ";

        $this->session->set_flashdata('pesan', $data);

        redirect(base_url("peserta/id/".md5($id_peserta)), $data);
    }

    public function config(){
        $data = $this->Main_model->get_all("config");
        return $data;
    }

    public function add_sertifikat(){
        $id = $this->input->post("id");
        
        $tes = $this->Main_model->get_one("tes_peserta_bussiness", ["id" => $id]);
        if($tes){
            $this->Main_model->edit_data("tes_peserta_bussiness", ["id_peserta" => $tes['id_peserta']], ["status" => "off"]);
            $this->Main_model->edit_data("tes_peserta_bussiness", ["id" => $id], ["status" => "on"]);
        }

        $config = $this->config();

        $peserta = $this->Main_model->get_one("peserta_bussiness", ["id_peserta" => $tes['id_peserta']]);
        
        $date = date('Y', strtotime($tes['tgl_tes']));

        $this->db->select("CONVERT(no_doc, UNSIGNED INTEGER) AS num");
        $this->db->from("peserta_bussiness as a");
        $this->db->join("tes_peserta_bussiness as b", "a.id_peserta = b.id_peserta");
        $this->db->where(["YEAR(tgl_tes)" => $date, "b.status" => "on"]);
        $this->db->order_by("num", "DESC");
        $data = $this->db->get()->row_array();

        if($data) $no = $data['num']+1;
        else $no = 1;

        if($no > 0 && $no < 10) $no_doc = "00".$no;
        elseif($no >= 10 && $no < 100) $no_doc = "0".$no;
        elseif($no >= 100) $no_doc = $no;
        

        if($peserta['no_doc'] == ""){
            $this->load->library('qrcode/ciqrcode'); //pemanggilan library QR CODE
    
            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224,255,255); // array, default is array(255,255,255)
            $config['white']        = array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);
    
            $image_name=$peserta['id_peserta'].'.png'; //buat name dari qr code sesuai dengan nim
    
            $params['data'] = $config[1]['value']."/sertifikat/peserta/no/".md5($peserta['id_peserta']); //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

            $data = $this->Main_model->edit_data("peserta_bussiness", ["id_peserta" => $peserta['id_peserta']], ["no_doc" => $no_doc]);
        }

        if($data) return 1;
        else return 0;
    }

    public function sertifikat($no = "no", $id){
        $peserta = $this->Main_model->get_one("peserta_bussiness", ["md5(id_peserta)" => $id]);
        $tes = $this->Main_model->get_one("tes_peserta_bussiness", ["md5(id_peserta)" => $id, "status" => "on"]);
        $peserta['nama'] = ucwords(strtolower($peserta['nama_peserta']));
        $peserta['t4_lahir'] = ucwords(strtolower($peserta['t4_lahir']));
        $peserta['tahun'] = date('Y', strtotime($tes['tgl_tes']));
        $peserta['bulan'] = date('m', strtotime($tes['tgl_tes']));
        $peserta['listening'] = poin("Listening", $tes['nilai_listening']);
        $peserta['structure'] = poin("Structure", $tes['nilai_structure']);
        $peserta['reading'] = poin("Reading", $tes['nilai_reading']);
        $peserta['tgl_tes'] = $tes['tgl_tes'];

        // $skor = ((poin("Listening", $peserta['nilai_listening']) + poin("Structure", $peserta['nilai_structure']) + poin("Reading", $peserta['nilai_reading'])) * 10) / 3;
        $peserta['skor'] = $tes['skor_toefl'];
        
        $peserta['no_doc'] = "RLE/TP-PB/{$peserta['tahun']}/{$peserta['bulan']}/{$peserta['no_doc']}";

        $peserta['config'] = $this->Main_model->config();
        $peserta['id_tes'] = $peserta['id_tes'];
        $peserta['id'] = $peserta['id_peserta'];
        
        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [210, 297], 'orientation' => 'L',
        // , 'margin_top' => '43', 'margin_left' => '25', 'margin_right' => '25', 'margin_bottom' => '35',
            'fontdata' => $fontData + [
                'rockb' => [
                    'R' => 'ROCKB.TTF',
                ],'rock' => [
                    'R' => 'ROCK.TTF',
                ],
                'arial' => [
                    'R' => 'arial.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],
                'bodoni' => [
                    'R' => 'BOD_R.TTF',
                ],
                'calibri' => [
                    'R' => 'CALIBRI.TTF',
                ],
                'cambria' => [
                    'R' => 'CAMBRIAB.TTF',
                ],
                'montserrat' => [
                    'R' => 'Montserrat-Regular.ttf',
                ],
                'times' => [
                    'R' => 'timesbd.ttf',
                ],
                'oleo' => [
                    'R' => 'OleoScript-Bold.ttf',
                ]
            ], 
        ]);

        $mpdf->SetTitle("{$peserta['nama']}");
        $mpdf->WriteHTML($this->load->view('pages/sertifikat-file', $peserta, TRUE));
        $mpdf->Output("{$peserta['nama']}.pdf", "I");

    }
}

/* End of file Peserta.php */