<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once 'twilio-php-app/vendor/autoload.php';

use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;

class Sensor extends CI_Controller
{
    public function post()
    {
        $asap = $this->input->get('nilai');

        if ($asap) {
            $data = [
                'nilai' => $asap
            ];

            $this->db->order_by('id', 'desc');

            $data_sebelumnya = $this->db->get('tb_asap', 1)->row();

            $asap_sebelumnya = $data_sebelumnya->nilai;

            // $awal  = date_create($data_sebelumnya->waktu);
            // $akhir = date_create(); // waktu sekarang
            // $diff  = date_diff($awal, $akhir);

            // $hari = $diff->d;
            // $jam = $diff->h;
            // $menit = $diff->i;

            if ($data_sebelumnya) {
                if ($asap_sebelumnya != $asap) {
                    $this->db->insert('tb_asap', $data);

                    echo 'Nilai sensor berhasil masuk ke db';
                } else {
                    echo 'Nilai sensor masih sama';
                }
            } else {
                $this->db->insert('tb_asap', $data);

                echo 'Nilai sensor berhasil masuk ke db';
            }
        }
    }

    public function kirimGambar()
    {
        $this->db->order_by('id', 'desc');
        $asap = $this->db->get('tb_asap', 1)->row();

        if ($asap) {
            if ($asap->nilai > 300) {
                $upload_foto = $_FILES['imageFile']['name'];
                if ($upload_foto) {
                    $dir = date('Y-m');

                    if (is_dir('uploads/' . $dir) === false) {
                        mkdir('uploads/' . $dir);
                        chmod('uploads/' . $dir, 0777);
                    }

                    $this->load->library('upload');
                    $config['upload_path']          = './uploads/' . $dir;
                    $config['allowed_types']        = 'jpg|jpeg|png';
                    $config['max_size']              = '10240';
                    $config['remove_spaces']        = TRUE;
                    $config['detect_mime']          = TRUE;
                    $config['encrypt_name']         = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload('imageFile')) {
                        echo 'Maaf, gambar tidak memenuhi persyaratan!';
                    } else {
                        $upload_data = $this->upload->data();

                        $data = [
                            'name'  => $dir . '/' . $upload_data['file_name'],
                        ];

                        $insert = $this->db->insert('tb_photos', $data);

                        if ($insert) {
                            $sid    = "ACf1a094e56b6e90a4ef4a48d87030efad";
                            $token  = "6f90b7820d10b5f387ab57df3f081ad4";
                            $twilio = new Client($sid, $token);

                            $mediaUrl = base_url('uploads/') . $dir . '/' . $upload_data['file_name'];

                            $message = $twilio->messages
                                ->create(
                                    "whatsapp:+6289660299603", // to 
                                    array(
                                        "from" => "whatsapp:+14155238886",
                                        "body" => "Nilai asap " . $asap->nilai . ' !',
                                        "mediaUrl"    => [$mediaUrl]
                                    )
                                );

                            echo 'Upload gambar ke web sukses';
                        } else {
                            echo 'Maaf, upload gambar ke web gagal!';
                        }
                    }
                }
            } else {
                echo 'Nilai asap masih normal';
            }
        } else {
            echo 'Asap masih null !';
        }
    }
}
