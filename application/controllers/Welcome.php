<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Welcome extends CI_Controller {

	public function __construct() {
        parent::__construct();
       
	    if(($_SESSION['logged_in'] != 1)){
			redirect(LOGIN_PAGE);
		}
	   
    }

	public function index()
	{
		$data['pro_list'] = $this->db->select("*")
			->get('products_table')->result_array();
		
		$data['cat_list'] = $this->db->select("*")
			->where('up_cat_id', '0')
			->where('account_id', $_SESSION['account_id'])
			->get('categories_table')->result_array();
		
		$this->load->view('welcome_view', $data);
	}

	public function main_board()
	{
		$this->load->view('main_view');
	}

	

	public function replaceStr($s) {
		$tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','%','₺');
		$eng = array('s','S','i','I','g','G','u','U','o','O','C','c','', '');
		$s = str_replace($tr,$eng,$s);
	 
		return $s;
	}
	
	public function print_order($order_id){
		$this->load->helper('printer_helper'); 
		
		$order = $this->db->select('*')
			->where('order_id', $order_id)
			->join('products_table', 'order_details_table.pro_id = products_table.pro_id', 'left')
			->get('order_details_table')->result_array();
		
		//debug($order);
		
		$printer_name = $this->db->select('*')->where('id', '1')->get('printers_table')->row_array()['printer_name'];
		
			print_rows($order,$order_id, $printer_name);
		
	}
	
	public function order_save_post(){
		$post = $this->input->post();
		//debug($post);
		if(!empty($post)){
			
			$ins['account_id'] = $_SESSION['account_id'];
			$this->db->insert('orders_table', $ins);
			
			$order_id = $this->db->insert_id();
			
			foreach($post['pro_id'] as $key => $val){
				$ins2[$key]['order_id'] = $order_id;
				$ins2[$key]['pro_id'] = $val;
				$ins2[$key]['qty'] = $post['qty'][$key];
				$ins2[$key]['price'] = $post['proPrice'][$key];
					$this->db->insert('order_details_table',$ins2[$key]);
				
			}
			
			
			if($this->db->affected_rows() > 0){
				//$this->print_order($order_id);
				echo 'success'; die();
			}else{
				echo 'error';
			}
			
		}
		
		
	}
	
	
	public function get_cat_products(){
		$post = $this->input->post();
		//debug($post);
		$data['products'] = $this->db->select('*')
			->where('cat_id', $post['cat_id'])
			->get('products_table')->result_array();
		
		$this->load->view("cat_products_view", $data);
		
		
	}
	
	
}
