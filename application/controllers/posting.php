<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class posting extends MY_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model("m_bloods");
        $this->load->library('form_validation');
    }

    public function index(){
        // $data["posting"] = $this->m_bloods->getAll();
        // $this->load->view("admin/posting/list", $data);
    }

    public function add(){
        $posting = $this->m_bloods;
        $validation = $this->form_validation;
        $validation->set_rules($posting->rules());

        if ($validation->run()) {
            $posting->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("admin/posting/new_form");
    }

    public function edit($id_post = null){
        if (!isset($id_post)) redirect('posting');
       
        $posting = $this->m_bloods;
        $validation = $this->form_validation;
        $validation->set_rules($posting->rules());

        if ($validation->run()) {
            $posting->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["posting"] = $posting->getById($id_post);
        if (!$data["posting"]) show_404();
        
        $this->load->view("admin/posting/edit_form", $data);
    }

    public function delete($id_post=null){
        if (!isset($id_post)) show_404();
        
        if ($this->m_bloods->delete($id_post)) {
            redirect(site_url('admin/posting/'));
        }
    }
}