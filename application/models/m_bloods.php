<?php defined('BASEPATH') OR exit('No direct script access allowed');

class m_bloods extends CI_Model{
    private $_table = "posting";

    public $id_post;
    public $nama;
    public $wilayah;
    // public $image = "default.jpg";
    public $caption;

    public function rules(){
        return [
            ['field' => 'nama',
            'label' => 'Nama',
            'rules' => 'required'],

            ['field' => 'wilayah',
            'label' => 'Wilayah',
            'rules' => 'required'],
            
            ['field' => 'caption',
            'label' => 'Caption',
            'rules' => 'required']
        ];
    }

    public function getAll(){
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id_post){
        return $this->db->get_where($this->_table, ["id_post" => $id_post])->row();
    }

    public function save(){
        $post = $this->input->post();
        // $this->id_post = uniqid();
        $this->nama = $post["nama"];
        $this->wilayah = $post["wilayah"];
        $this->caption = $post["caption"];
        $this->db->insert($this->_table, $this);
    }

    public function update(){
        $post = $this->input->post();
        $this->id_post = $post["id_post"];
        $this->nama = $post["nama"];
        $this->wilayah = $post["wilayah"];
        $this->caption = $post["caption"];
        $this->db->update($this->_table, $this, array('id_post' => $post['id_post']));
    }

    public function delete($id_post){
        return $this->db->delete($this->_table, array("id_post" => $id_post));
    }
}