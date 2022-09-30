<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Model {

    public function getUser($id_user)
    {
        return $this->db->get_where('user', ['id_user' => $id_user])->row_array();
    }

    public function getJob($id_job)
    {
        return $this->db->get_where('job', ['id_job' => $id_job])->row_array();
    }

    public function getAllJob()
    {
        return $this->db->get('job')->result_array();
    }

    public function getPublishJobs()
    {
        return $this->db->get_where('job', ['status' => 1])->result_array();
    }

    public function getDraftJobs()
    {
        return $this->db->get_where('job', ['status' => 0])->result_array();
    }

    public function getIdCandidates($id_candidates)
    {
        return $this->db->get_where('candidates', ['id_candidates' => $id_candidates])->row_array();
    }

    public function countPublishJob()
    {
        return $this->db->where(['status' => 1])->from('job')->count_all_results();
    }

    public function countDraftJob()
    {
        return $this->db->where(['status' => 0])->from('job')->count_all_results();
    }

    public function countCandidates()
    {
        return $this->db->where(['status' => 1])->from('candidates')->count_all_results();
    }

    public function getCandidates($name, $jobs, $rate,$limit,$offset)
    {
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('status','1');
        if ($name != "")
        { 
            $this->db->like('full_name',$name);
        }
        elseif ($rate != "") {
            $this->db->where('rate', $rate);
        }
        elseif ($jobs != "") {
            $this->db->like('category', $jobs);
        }
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function recentApply()
    {
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('status','1');
        $this->db->order_by('id_candidates','desc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteJobs($id_job)
    {
        $query = $this->db->query("delete from job where id_job = '$id_job' ");
        return $query;
    }

    public function saveDraftJobs()
    {

    }

    public function savePublishJobs($nama_job,$job_details,$category,$country,$city,$vacancies,$state,$exp_date,$skill,$employment_type,$salary_type,$office_time,$experience,$salary,$gambar)
    {
        $datestring = '%Y-%m-%d';
        $date = mdate($datestring);
        $query = $this->db->query("insert into job(id_job, nama_job, job_details, category, country, city, vacancies, state, exp_date, post_date, skill, employment_type, salary_type, office_time, level_pengalaman, salary, img_jobs, status, jmlh_apply) values ('','$nama_job','$job_details','$category','$country','$city','$vacancies','$state','$exp_date','$date','$skill','$employment_type','$salary_type','$office_time','$experience','$salary','$gambar','1','')");
        return $query;
    }

    public function updateUser($id_user,$username,$email,$no_hp,$industry,$country,$state,$city,$postal_code,$language,$web_url,$gambar)
    {
        $query = $this->db->query("update user set username='$username',email='$email',no_hp='$no_hp',industry='$industry',country='$country',state='$state',city='$city',postal_code='$postal_code',language='$language',web_url='$web_url',img_profile='$gambar' where id_user = '$id_user'");
        return $query;
    }

    public function getCandidatesByJob($id_job)
    {
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('status','1');
        $this->db->where('id_job',$id_job);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCandidatesByIdJob($id_job)
    {
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('status','1');
        $this->db->where('id_job',$id_job);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getJobsById($id_job){
        return $this->db->get_where('job', ['id_job' => $id_job])->row_array();
    }

    public function getNotif()
    {

        $this->db->select('*');
        $this->db->from('notification');
        $this->db->order_by('date','asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function deleteNotif()
    {
        $query = $this->db->query('delete from notification');
        return $query;
    }

    public function countNotif()
    {
        return $this->db->where(['status' => 0])->from('notification')->count_all_results();
    }

    public function notifAddJob($nama_job)
    {
        $datestring = '%Y-%m-%d';
        $date = mdate($datestring);
        $query = $this->db->query("insert into notification (id_notif,category,date,name,content) values ('','$nama_job','$date','You','Congratulations! Success create a new job $nama_job')");
        return $query;
    }

    public function updateJobs($id_job,$nama_job,$job_details,$category,$country,$city,$vacancies,$state,$exp_date,$skill,$employment_type,$salary_type,$office_time,$experience,$salary,$gambar)
    {
        $query = $this->db->query("update job set nama_job='$nama_job', job_details='$job_details', category='$category', country='$country', city='$city', vacancies='$vacancies', state='$state', exp_date='$exp_date', skill='$skill', employment_type='$employment_type', salary_type='$salary_type', office_time='$office_time', level_pengalaman='$experience', salary='$salary', img_jobs='$gambar' where id_job = '$id_job'");
        return $query;
    }

    public function notifEditJob($nama_job)
    {
        $datestring = '%Y-%m-%d';
        $date = mdate($datestring);
        $query = $this->db->query("insert into notification (id_notif,category,date,name,content) values ('','$nama_job','$date','You','Congratulations! Success update job $nama_job')");
        return $query;
    }


    public function insertNotes($id_candidates, $notes)
    {
        $query = $this->db->query("update candidates set notes='$notes' where id_candidates = '$id_candidates'");
        return $query;
    }

    public function recentJobs()
    {
        $this->db->select('*');
        $this->db->from('job');
        $this->db->order_by('id_job','desc');
        $this->db->limit(5);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function eduCandidates($id_candidates)
    {
        
        return $this->db->get_where('edu', ['id_candidates' => $id_candidates])->result_array();
    }

    public function employeCandidates($id_candidates)
    {
        
        return $this->db->get_where('employe', ['id_candidates' => $id_candidates])->result_array();
    }

    public function filter($name, $jobs, $rate)
    {
        $this->db->select('*');
        $this->db->from('candidates');
        $this->db->where('status','1');
        if ($name != "")
        { 
            $this->db->like('full_name',$name);
        }
        elseif ($rate != "") {
            $this->db->where('rate', $rate);
        }
        elseif ($jobs != "") {
            $this->db->like('category', $jobs);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchJob($jobs, $urutan, $exp)
    {
        $this->db->select('*');
        $this->db->from('job');
        if ($jobs != "") 
        {
            $this->db->where('nama_job', $jobs);
        }

        else if ($urutan != "") 
        {
            $this->db->order_by('id_job', $urutan);
        }

        else if ($exp != "")
        {
            $this->db->where('status', $exp);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getYears()
    {
        $query = $this->db->query('SELECT year_apply, COUNT(*) AS candidates FROM candidates WHERE status = 1 GROUP BY year_apply');
        return $query->result_array();
    }





}