<?php
    class Post_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_posts($slug = FALSE){
            if ($slug === FALSE){
                $query = $this->db->get('posts');
                return $query->result_array();
            }   

            $query = $this->db->get_where('posts', array('slug' => $slug));
            return $query->row_array();
        }

        public function create_post(){
            // get form values -> value of title & turn into slug
            $slug = url_title($this->input->post('title'));
            // create array called data
            $data = array(
                'title' => $this->input->post('title'),
                'slug' => $slug,
                'body' => $this->input->post('body')
            );

            return $this->db->insert('posts', $data);
        }
    }