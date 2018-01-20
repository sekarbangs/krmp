<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Model {

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function recordVisit(){
		if( ! isset($_SESSION['visitRecorded'])){
			$sql = "insert into visits (ip_address,session_id) values ('".$_SERVER['REMOTE_ADDR']."','".session_id()."')";
			$res = $this->db->query($sql);			
			if($res)$_SESSION['visitRecorded'] =  true;else unset($_SESSION['visitRecorded']);
		}
		return true;
	}
	
	public function getOnlineUsers(){
		$sql = "SELECT count(id) cnt FROM ci_sessions";
		$res = $this->db->query($sql);
		echo $res->row()->cnt;
	}
	
	public function getDjDetails(){
		$sql = "select * from kannadadjs order by id desc";
		$res = $this->db->query($sql);
		return $res->result_array();
	}
	
	public function adflyLink($url){
		$sql = "select adflylink from adfly where mainlink = '".$url."'";
		$res = $this->db->query($sql);
		return $res->row()->adflylink;
	}
	public function saveContactUs()
	{
		if($this->input->post()){
			extract($this->input->post());
			$sql ="insert into contactus values ('".mysql_real_escape_string($inputEmail1)."','".mysql_real_escape_string($contactmessage)."')";
			$res = $this->db->query($sql);
			if($res)return true;else return false;
		}
	}
	public function saveSubscribe()
	{
		if($this->input->post()){
			extract($this->input->post());

			$sql ="insert into subscription values ('".mysql_real_escape_string($inputEmail3)."')";
			$res = $this->db->query($sql);
			if($res)return true;else return false;
		}
	}
}