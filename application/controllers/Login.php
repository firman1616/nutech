<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


    public function index()
    {
        $this->load->view('login');
    }

    public function login_form()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        // admin
        $where1 = array(
            'username' => $username,
            'password' => $password,
            'level' => 1
        );
        $cek1 = $this->M_data->get_data_by_id("tbl_user", $where1);

        if ($cek1->num_rows() > 0) {
            foreach ($cek1->result() as $row) {
                $id = $row->id_user;
                $nama = $row->nama_user;
                $dept = $row->dept_user;
                // $lengkap = $row->nama_lengkap;
            }
            $data_session = array(
                'status'     => true,
                'level'     => 1,
                'id'        => $id,
                'nama'        => $nama,
                'dept_user'    => $dept

            );
            $this->session->set_userdata($data_session);
            redirect(base_url("Dashboard"));
        } else {
            $this->session->set_flashdata('flash', 'Wrong');

            redirect(base_url('Login'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('Login'));
    }
}
