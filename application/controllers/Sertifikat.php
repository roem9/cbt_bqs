<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Controller {

    
    public function __construct(){
        parent::__construct();
        $this->load->model("Main_model");
    }
    
    public function no($id){
        $peserta = $this->Main_model->get_one("peserta_toefl", ["md5(id)" => $id]);
        $peserta['link'] = $this->Main_model->get_one("config", ['field' => "web admin"]);
        if($peserta){
            $tes = $this->Main_model->get_one("tes", ["id_tes" => $peserta['id_tes']]);
            $peserta['nama'] = $peserta['nama'];
            $peserta['title'] = "Sertifikat ".$peserta['nama'];
            $peserta['t4_lahir'] = ucwords(strtolower($peserta['t4_lahir']));
            $peserta['tahun'] = date('Y', strtotime($tes['tgl_tes']));
            $peserta['bulan'] = date('m', strtotime($tes['tgl_tes']));
            $peserta['istima'] = poin("Listening", $peserta['nilai_listening']);
            $peserta['tarakib'] = poin("Structure", $peserta['nilai_structure']);
            $peserta['qiroah'] = poin("Reading", $peserta['nilai_reading']);
            $peserta['tgl_tes'] = $tes['tgl_tes'];
            $peserta['tgl_berakhir'] = date('Y-m-d', strtotime('+6 months', strtotime($tes['tgl_tes'])));

            $peserta['link_foto'] = config();

            $skor = ((poin("Listening", $peserta['nilai_listening']) + poin("Structure", $peserta['nilai_structure']) + poin("Reading", $peserta['nilai_reading'])) * 10) / 3;
            $peserta['skor'] = $skor;

            $peserta['no_doc'] = "{$peserta['no_doc']}/TOEFL/Digital/{$peserta['tahun']}";
        }

        // $this->load->view("pages/layout/header-sertifikat", $peserta);
        // $this->load->view("pages/soal/".$page, $data);
        $peserta['background'] = $this->Main_model->get_one("config", ["field" => 'background']);
        $this->load->view("pages/sertifikat", $peserta);
        // $this->load->view("pages/layout/footer");
    }

    public function download($id){
        $peserta = $this->Main_model->get_one("peserta_toefl", ["md5(id)" => $id]);
        $tes = $this->Main_model->get_one("tes", ["id_tes" => $peserta['id_tes']]);
        $peserta['nama'] = $peserta['nama'];
        $peserta['t4_lahir'] = ucwords(strtolower($peserta['t4_lahir']));
        $peserta['tahun'] = date('Y', strtotime($tes['tgl_tes']));
        $peserta['bulan'] = date('m', strtotime($tes['tgl_tes']));
        $peserta['listening'] = poin("Listening", $peserta['nilai_listening']);
        $peserta['structure'] = poin("Structure", $peserta['nilai_structure']);
        $peserta['reading'] = poin("Reading", $peserta['nilai_reading']);
        $peserta['tgl_tes'] = $tes['tgl_tes'];

        $skor = ((poin("Listening", $peserta['nilai_listening']) + poin("Structure", $peserta['nilai_structure']) + poin("Reading", $peserta['nilai_reading'])) * 10) / 3;
        $peserta['skor'] = $skor;

        $skor = round($skor);
        
        $peserta['no_doc'] = "{$peserta['no_doc']}/TOEFL/Digital/{$peserta['tahun']}";

        $peserta['config'] = $this->Main_model->config();
        $peserta['id_tes'] = $peserta['id_tes'];
        
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
                ]
            ], 
        ]);

        $mpdf->SetTitle("{$peserta['nama']}");
        $mpdf->WriteHTML($this->load->view('pages/sertifikat-download', $peserta, TRUE));
        $mpdf->Output("{$peserta['nama']}.pdf", "D");

    }
}

/* End of file Sertifikat.php */
