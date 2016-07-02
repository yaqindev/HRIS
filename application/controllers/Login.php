<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function index()
    {
            $this->load->view('page/login');
    }

    function auth_login()
    {
    	$username	= $this->input->post('username');
    	$password	= $this->input->post('password');

    	$cek 		= $this->user->auth($username,$password);
    	if (count($cek) > 0)
    	{
    		$user = $this->user->get_id($cek[0]->ID_USER);
			$session_data = array(
				'id_user' 	=> $user[0]->ID_USER,
				'nama_user' => $user[0]->NAME,
				'level' 	=> $user[0]->HAK_AKSES
			);
    		$this->session->set_userdata($session_data);
			redirect('dashboard');
    	}else{
			$this->session->set_flashdata('notif','Login gagal !');
			redirect('login');
    	}

    }

    function logout()
    {
    	$this->session->sess_destroy();
    	redirect('login');
    }


}