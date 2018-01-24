<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		$this->load->library('browser');
		if($this->browser->isRobot() === false && !in_array($this->browser->getBrowser(), array(Browser::BROWSER_FIREFOX,Browser::BROWSER_CHROME, Browser::BROWSER_IE) ) ){
			show_error('<p>THIS BROWSER NOT SUPPORTED.</p><p>Currently our website supports only Mozilla Firefox, Google Chrome and MS Internet Explorer.</p>',501,'Ops !');
			exit(0);
		}
		
	}

	public function index(){
		$data['pageTitle'] 	= 'Kannada Remix Music Portal - HOME';
		$data['pageDesc']	=	'Sensational website to listen Kannada Remix Songs and Kannada DJ Songs online. Purely dedicated to kannada remix songs and kannada dj.';
		$data['krmpalbums'] = $this->songs->getRecentAlbumsList();
		$data['topsongs1'] 	= $this->songs->getTopSongs(1);
		$data['topsongs2'] 	= $this->songs->getTopSongs(2);

		$this->load->vars($data);
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
	public function home(){
		$data['pageTitle'] 	= 'Kannada Remix Music Portal - HOME';
		$data['pageDesc']	=	'Sensational website to listen Kannada Remix Songs and Kannada DJ Songs online. Purely dedicated to kannada remix songs and kannada dj.';
		$data['krmpalbums'] = $this->songs->getRecentAlbumsList();
		$data['topsongs1'] 	= $this->songs->getTopSongs(1);
		$data['topsongs2'] 	= $this->songs->getTopSongs(2);

		if($this->botDetected()){
			$this->load->vars($data);
			$this->load->view('header');
			$this->load->view('home');
			$this->load->view('footer');
		}
		else
		{
			$this->load->vars($data);
			$view['pageTitle'] 	=  $data['pageTitle'];
			$view['resHtml'] 	=  $this->load->view('home','',true);
			echo json_encode($view);
		}
	}

	private function botDetected() {
	  $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	  $bot_identifiers = array('bot','slurp','crawler','spider','curl','facebook','fetch');
	  foreach ($bot_identifiers as $identifier) {
	    if (strpos($user_agent, $identifier) !== FALSE) {
	      return TRUE;
	    }
	  }
	  return FALSE;
	}

	public function contactus()
	{
		if($this->input->post()){
			extract($this->input->post());
			if($inputEmail1 && $contactmessage){
				if($this->general->saveContactUs()===true){
					$data['contactmessage'] = '<p class="alert alert-success text-center">Message Sent to Admin Successfully</p>';
				}
				else
				{
					$data['contactmessage'] = '<p class="alert alert-danger text-center">Message could not be sent. Try later on.</p>';
				}
				if($this->botDetected()){
					$this->load->vars($data);
					$this->load->view('header');
					$this->load->view('home');
					$this->load->view('footer');
				}
				else
				{
					$this->load->vars($data);
					$view['pageTitle'] 	=  $data['pageTitle'];
					$view['resHtml'] 	=  $this->load->view('home','',true);
					echo json_encode($view);
				}			
			}
		}
	}

	public function subscribe()
	{
		if($this->input->post()){
			extract($this->input->post());
			if($inputEmail3){
				if($this->general->saveSubscribe()===true){
					$data['subscribemessage'] = '<p class="alert alert-success text-center">Subscribed Successfully</p>';
				}
				else
				{
					$data['subscribemessage'] = '<p class="alert alert-danger text-center">Subscription Failed. Try later on.</p>';
				}
				if($this->botDetected()){
					$this->load->vars($data);
					$this->load->view('header');
					$this->load->view('home');
					$this->load->view('footer');
				}
				else
				{
					$this->load->vars($data);
					$view['pageTitle'] 	=  $data['pageTitle'];
					$view['resHtml'] 	=  $this->load->view('home','',true);
					echo json_encode($view);
				}			
			}
		}
	}
}