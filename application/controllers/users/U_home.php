<?php defined('BASEPATH') OR exit('No direct script access allowed');

class U_home extends CI_Controller {

	public function register(){
		$this->form_validation->set_rules('uname','Username','required|min_length[6]|max_length[16]');
		$this->form_validation->set_rules('email','E-Mail ID','required|valid_email');
		$this->form_validation->set_rules('pass','Password','required|min_length[10]|max_length[15]');
		$this->form_validation->set_rules('passConf','Confirm Password','required|min_length[10]|max_length[15]|matches[pass]');
		if( $this->form_validation->run() === false){
			$data['pageTitle'] = 'User\'s Corner Home - Kannada Remix World';
			$this->load->vars($data);
			$this->load->view('header');
			$this->load->view('users/navigation');
			$this->load->view('users/register');
			$this->load->view('footer');
		}
		else
		{
			echo 'ssssssssssssssssssssssssssssssssssssssss';
		}
	}
	
	public function login(){
		$this->form_validation->set_rules('uname','Username','required|min_length[6]|max_length[16]');
		$this->form_validation->set_rules('pass','Password','required|min_length[10]|max_length[15]');
		if( $this->form_validation->run() === false){
			$data['pageTitle'] = 'User\'s Corner Home - Kannada Remix World';
			$this->load->vars($data);
			$this->load->view('header');
			$this->load->view('users/navigation');
			$this->load->view('users/register');
			$this->load->view('footer');
		}
		else
		{
			echo 'ssssssssssssssssssssssssssssssssssssssss';
		}
	}
}
