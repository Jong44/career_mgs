<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct()
	{
		parent:: __construct();
        $this->load->model('user_model');
        $this->load->library('upload');
		$this->load->helper('date');
        if($this->session->userdata('id_user') == null){
			redirect()->base_url();
		}
		$this->load->library("pagination");
	}

	public function index()
	{
		$data['chart'] = $this->user_model->getYears();		
		$data['countNotifications'] = $this->user_model->countNotif();
		$data['job'] = $this->user_model->getPublishJobs();
		$data['countActiveJob'] = $this->user_model->countPublishJob();
		$data['countDraftJob'] = $this->user_model->countDraftJob();
		$data['countCandidates'] = $this->user_model->countCandidates();
		$data['recent'] = $this->user_model->recentApply();
		$data['recentJobs'] = $this->user_model->recentJobs();
		$this->load->view('partials/sidebar',$data);
		$this->load->view('dashboard',$data);
	}

	public function jobs()
	{
		$data['title'] = "active";
		$jobs = $this->input->post('jobs');
		$urutan = $this->input->post('urutan');
		$exp = $this->input->post('expired');
		$data['countNotifications'] = $this->user_model->countNotif();
		$data['jobs'] = $this->user_model->getAllJob();
		$data['job'] = $this->user_model->searchJob($jobs,$urutan,$exp);
		$this->load->view('partials/sidebar',$data);
		$this->load->view('jobs', $data);
	}

	public function candidates($offset=NULL)
	{	
		$config['base_url'] = base_url() . 'user/candidates';
		$config['total_rows'] = $this->user_model->countCandidates();
		$config["per_page"] = 10;
		$config["uri_segment"] = 3;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['offset'] = $offset;
		$this->pagination->initialize($config);
		$data["links"] = $this->pagination->create_links();
		$data['countNotifications'] = $this->user_model->countNotif();	
		$data['job'] = $this->user_model->getPublishJobs();
		$name = $this->input->post('name');
		$jobs = $this->input->post('jobs');
		$rate = $this->input->post('rate');
		$data['candidates'] = $this->user_model->getCandidates($name, $jobs, $rate,$config["per_page"],$offset);
		$this->load->view('partials/sidebar');
		$this->load->view('candidates', $data);
	}

	public function setting($id_user)
	{
		$data['job'] = $this->user_model->getPublishJobs();
		$data['countNotifications'] = $this->user_model->countNotif();
		$data['user'] = $this->user_model->getUser($id_user);
		$this->load->view('partials/sidebar');
		$this->load->view('setting', $data);
	}

	public function update()
	{
		$config['upload_path'] = './assets/img/profile/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encryp_name'] = TRUE;
		$gbr = $this->upload->data();
        $username = $this->input->post('username');
        $filename = $username.$gbr['file_ext'];
        $config['file_name'] = $filename;

        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']))
        {
			if ($this->upload->do_upload('filefoto'))
			{
				$gbr = $this->upload->data();
                $username = $this->input->post('username');
                $filename = $username.$gbr['file_ext'];
				$config['image_library']='gd2';
				$config['source_image']='./assets/img/profile/'.$gbr['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '100%';
                $config['width']= 840;
                $config['height']= 450;
				$config['new_image']= './assets/img/profile/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$gambar = $filename;
				$id_user = $this->input->post('id_user');
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$no_hp = $this->input->post('no_hp');
				$industry = $this->input->post('industry');
				$country = $this->input->post('country');
				$state = $this->input->post('state');
				$city = $this->input->post('city');
				$postal_code = $this->input->post('postal_code');
				$time_zone = $this->input->post('time_zone');
				$language = $this->input->post('language');
				$web_url = $this->input->post('web_url');
				$this->user_model->updateUser($id_user,$username,$email,$no_hp,$industry,$country,$state,$city,$postal_code,$language,$web_url,$gambar);
				redirect('user/setting/' .$id_user);
			} else {
					redirect('user/setting/' .$id_user);
			}
		} else {
				$id_user = $this->input->post('id_user');
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$no_hp = $this->input->post('no_hp');
				$industry = $this->input->post('industry');
				$country = $this->input->post('country');
				$state = $this->input->post('state');
				$city = $this->input->post('city');
				$postal_code = $this->input->post('postal_code');
				$time_zone = $this->input->post('time_zone');
				$language = $this->input->post('language');
				$web_url = $this->input->post('web_url');
				$this->user_model->updateUser($id_user,$username,$email,$no_hp,$industry,$country,$state,$city,$postal_code,$language,$web_url,$img_profile);
				redirect('user/setting/'.$id_user);
		}
	}

	public function detail($id_candidates)
	{
		$data['job'] = $this->user_model->getPublishJobs();
		$data['countNotifications'] = $this->user_model->countNotif();
		$data['candidates'] = $this->user_model->getIdCandidates($id_candidates);
		$data['edu'] = $this->user_model->eduCandidates($id_candidates);
		$data['employe'] = $this->user_model->employeCandidates($id_candidates);
		$this->load->view('partials/sidebar');
		$this->load->view('detail_candidate', $data);
	}

	public function applied($id_job)
	{
		$data['countNotifications'] = $this->user_model->countNotif();
		$data['apply'] = $this->user_model->getCandidatesByJob($id_job);
		$data['applied'] = $this->user_model->getCandidatesByIdJob($id_job);
		$data['job'] = $this->user_model->getJobsById($id_job);
		$this->load->view('partials/sidebar');
		$this->load->view('apply', $data);
	}

	public function notif()
	{
		$data['job'] = $this->user_model->getPublishJobs();
		$data['countNotifications'] = $this->user_model->countNotif();
		$data['notif'] = $this->user_model->getNotif();
		$this->load->view('partials/sidebar');
		$this->load->view('notification',$data);
	}

	public function form_job()
	{
		$data['job'] = $this->user_model->getPublishJobs();
		$data['countNotifications'] = $this->user_model->countNotif();
		$this->load->view('partials/sidebar');
		$this->load->view('form_job', $data);
	}

	public function save_formJob()
	{
		$config['upload_path'] = './assets/img/job/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $gbr = $this->upload->data();
        $nama_job = $this->input->post('nama_job');
        $filename = $nama_job.$gbr['file_ext'];
        $config['file_name'] = $filename;

        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']))
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $nama_job = $this->input->post('nama_job');
				$filename = $nama_job.$gbr['file_ext'];
                $config['image_library']='gd2';
                $config['source_image']='./assets/img/job/'.$filename;
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 1030;
                $config['height']= 520;
                $config['new_image']= './assets/img/job/'.$filename;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
                $nama_job = $this->input->post('nama_job');
				$job_details = $this->input->post('job_details');
				$category = $this->input->post('category');
				$country = $this->input->post('country');
				$city = $this->input->post('city');
				$vacancies = $this->input->post('vacancies');
				$state = $this->input->post('state');
				$exp_date = $this->input->post('exp_date');
				$skill = $this->input->post('skill');
				$employment_type = $this->input->post('employment_type');
				$salary_type = $this->input->post('salary_type');
				$office_time = $this->input->post('office_time');
				$experience = $this->input->post('experience');
				$salary = $this->input->post('salary');
                $this->user_model->savePublishJobs($nama_job,$job_details,$category,$country,$city,$vacancies,$state,$exp_date,$skill,$employment_type,$salary_type,$office_time,$experience,$salary,$gambar);
				$this->user_model->notifAddJob($nama_job);
                redirect('user/jobs');
            } else {
                $this->session->set_flashdata('pesan', 'Failed Add Jobs');
                redirect('user/jobs');
            }
     
        } else {
            $this->session->set_flashdata('pesan', 'Failed Add Jobs');
            redirect('user/jobs');
        }

	}

	public function editJob($id_job)
	{
		$data['countNotifications'] = $this->user_model->countNotif();
		$data['job'] = $this->user_model->getJob($id_job);
		$this->load->view('partials/sidebar');
		$this->load->view('editJobs', $data);
	}

	public function prosesEditJob()
	{
		$config['upload_path'] = './assets/img/job/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $gbr = $this->upload->data();
        $nama_job = $this->input->post('nama_job');
        $filename = $nama_job.$gbr['file_ext'];
        $config['file_name'] = $filename;

        $this->upload->initialize($config);
        if(!empty($_FILES['filefoto']))
        {
            if ($this->upload->do_upload('filefoto'))
            {
                $gbr = $this->upload->data();
                $nama_job = $this->input->post('nama_job');
				$filename = $nama_job.$gbr['file_ext'];
                $config['image_library']='gd2';
                $config['source_image']='./assets/img/job/'.$filename;
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '100%';
                $config['width']= 1030;
                $config['height']= 520;
                $config['new_image']= './assets/img/job/'.$filename;
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $gambar = $gbr['file_name'];
				$id_job = $this->input->post('id_job');
                $nama_job = $this->input->post('nama_job');
				$job_details = $this->input->post('job_details');
				$category = $this->input->post('category');
				$country = $this->input->post('country');
				$city = $this->input->post('city');
				$vacancies = $this->input->post('vacancies');
				$state = $this->input->post('state');
				$exp_date = $this->input->post('exp_date');
				$skill = $this->input->post('skill');
				$employment_type = $this->input->post('employment_type');
				$salary_type = $this->input->post('salary_type');
				$office_time = $this->input->post('office_time');
				$experience = $this->input->post('experience');
				$salary = $this->input->post('salary');
                $this->user_model->updateJobs($id_job,$nama_job,$job_details,$category,$country,$city,$vacancies,$state,$exp_date,$skill,$employment_type,$salary_type,$office_time,$experience,$salary,$gambar);
				$this->user_model->notifEditJob($nama_job);
                redirect('user/editJob/'.$id_job);
            } else {
                $this->session->set_flashdata('pesan', 'Failed Add Jobs');
                redirect('user/editJob/'.$id_job);
            }
     
        } else {
			$id_job = $this->input->post('id_job');
			$nama_job = $this->input->post('nama_job');
			$job_details = $this->input->post('job_details');
			$category = $this->input->post('category');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
			$vacancies = $this->input->post('vacancies');
			$state = $this->input->post('state');
			$exp_date = $this->input->post('exp_date');
			$skill = $this->input->post('skill');
			$employment_type = $this->input->post('employment_type');
			$salary_type = $this->input->post('salary_type');
			$office_time = $this->input->post('office_time');
			$experience = $this->input->post('experience');
			$salary = $this->input->post('salary');
			$this->user_model->updateJobs($id_job,$nama_job,$job_details,$category,$country,$city,$vacancies,$state,$exp_date,$skill,$employment_type,$salary_type,$office_time,$experience,$salary,$gambar);
			$this->user_model->notifEditjob($nama_job);
			redirect('user/editJob/'.$id_job);
        }
	}


}