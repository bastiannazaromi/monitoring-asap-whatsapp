<?php
class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('nama'))) {
            redirect('auth');
        }

        $this->db->where('nama', $this->session->userdata('nama'));
        $this->d_admin = $this->db->get('tb_admin')->row();
    }

    public function index()
    {
        $this->db->order_by('id', 'desc');
        $asap = $this->db->get('tb_asap', 1)->row();

        $data = [
            'title' => 'Dashboard',
            'page'  => 'admin/dashboard',
            'data'  => $asap
        ];

        $this->load->view('admin/index', $data);
    }

    public function rekap()
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('tb_asap')->result_array();

        $data = [
            'title' => 'Rekap',
            'asap'  => $query,
            'page'  => 'admin/rekap',
        ];

        $this->load->view('admin/index', $data);
    }

    public function gambar()
    {
        $this->db->order_by('id', 'desc');
        $gambar = $this->db->get('tb_photos')->result_array();

        $data = [
            'title' => 'Gambar from ESP32 CAM',
            'gambar'  => $gambar,
            'page'  => 'admin/gambar',
        ];

        $this->load->view('admin/index', $data);
    }

    public function delete($id)
    {
        $this->db->delete('tb_asap', ['id' => $id]);
        redirect('rekap');
    }

    public function delete_gambar($id)
    {
        $this->db->where('id', $id);
        $gambar = $this->db->get('tb_photos')->row();

        $path = FCPATH . 'uploads/';
        unlink($path . $gambar->name);

        $this->db->delete('tb_photos', ['id' => $id]);

        redirect('gambar');
    }

    public function get_realtime()
    {
        $count = $this->db->get('tb_asap')->num_rows();

        $this->db->order_by('id', 'desc');
        $data = $this->db->get('tb_asap', 1)->row();

        echo json_encode([
            'data'      => $data,
            'count'     => $count
        ]);
    }

    // cetak
    public function pdf()
    {
        $this->db->order_by('id', 'desc');
        $asap = $this->db->get('tb_asap')->result_array();

        $this->load->library('Dompdf_gen');

        $data['asap'] = $asap;
        $this->load->view('admin/asap_pdf', $data);
        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);
        $html = preg_replace('/>\s+</', '><', $html);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("rekap_asap.pdf", array('Attachment' => 0));
    }

    public function user()
    {
        $data = [
            'title'  => 'Admin',
            'user'   => $this->db->get('tb_admin')->result(),
            'page'  => 'admin/user'
        ];

        $this->load->view('admin/index', $data);
    }

    public function addUser()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]', [
            'matches'   => 'Password dont match',
            'min_length'    => 'Password to short'
        ]);
        $this->form_validation->set_rules('password2', 'Retype Password', 'trim|required|min_length[5]|matches[password1]');


        if ($this->form_validation->run() == FALSE) {
            # code...
            redirect('admin/user');
        } else {
            # code...
            $data = [
                'nama'          => htmlspecialchars($this->input->post('nama', true)),
                'password'      => password_hash($this->input->post('password1'), PASSWORD_BCRYPT),
                'foto'          => 'default.jpg',
            ];

            $this->db->insert('tb_admin', $data);
            redirect('admin/user');
        }
    }

    public function deleteUser($id)
    {
        $this->db->delete('tb_admin', ['id'  => $id]);
        
        redirect('admin/user', 'refresh');
    }
}
