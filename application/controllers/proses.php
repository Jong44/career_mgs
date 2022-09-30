<?php

 class proses extends CI_Controller{

    public function __construct()
    {
        parent:: __construct();
        $this->load->model('user_model');
        $this->load->library('upload');
		$this->load->helper('date');
    }
    
    public function insertNotes()
    {
        $id_candidates = $this->input->post('id_candidates');
        $notes = $this->input->post('notes');
        $this->user_model->insertNotes($id_candidates,$notes);
        $url = 'user/detail/' .$id_candidates;
        redirect('user/detail/'.$id_candidates,);
    }

    public function deleteJobs($id_job)
    {
        $this->user_model->deleteJobs($id_job);
        redirect('user/jobs');
    }

    public function deleteNotif()
	{
		$this->user_model->deleteNotif();
        redirect('user/notif');
	}

    



 }


?>