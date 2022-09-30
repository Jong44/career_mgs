<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('login');
	}

	public function proses_auth()
	{
		$this->load->model('Auth_model');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
	
			$cek = $this->Auth_model->cek($email, $password);
			if($cek->num_rows() > 0)
			{
				foreach($cek->result() as $data){
					foreach($cek->result() as $data){
						$sess_data['id_user'] = $data->id_user;
						$sess_data['username'] = $data->username;
						$sess_data['email'] = $data->email;
						$sess_data['industry'] = $data->industry;
						$sess_data['img_profile'] = $data->img_profile;
						$this->session->set_userdata($sess_data);
					}
				}
				redirect('user');
			}
			else
			{
				$this->session->set_flashdata('pesan', 'Maaf, kombinasi email dengan password salah.');
				redirect()->base_url();
			}
	}

	public function log_out()
	{
		$this->session->sess_destroy();
		redirect()->base_url();
	}
}
