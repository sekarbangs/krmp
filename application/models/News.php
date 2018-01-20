<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function getLatestFiveNews(){
		$sql = "select * from news order by create_on desc limit 5";
		$res = $this->db->query($sql);
		return $res->result_array();
	}
	
}	
?>
