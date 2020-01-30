<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index(){
		
		if(($_SESSION['logged_in'] == 1)){
			redirect(MAIN_BOARD);
		}else{
			
			$this->load->view("login_view");
			
		}	
	}
	
	public function login_post(){
		$post = $this->input->post();
		
		$check = $this->db->select("*")
			->where('email', $post['email'])
			->where('password', $post['pass'])
			->get('accounts_table')->row_array();
			
		if(!empty($check)){
			
			$_SESSION['logged_in'] = 1;
			$_SESSION['account_id'] = $check['id'];
			$_SESSION['email'] = $check['email'];
			
			redirect( MAIN_BOARD );
			
		}else{
			
			redirect( LOGIN_PAGE );
			
		}
		
	}
	
	public function logout(){
		
		unset($_SESSION['logged_in']);
		unset($_SESSION['account_id']);
		unset($_SESSION['email']);
		
		session_destroy();
		
		redirect(LOGIN_PAGE);
		
	}
	
}
