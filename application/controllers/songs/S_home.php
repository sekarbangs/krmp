<?php error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class S_home extends CI_Controller {

	public function index($category=NULL, $album=NULL){

/*********************************************/
//
//			for albums
//
/*********************************************/


		if(isset($category) && empty($album)){
			
			$data['albumsList'] = $this->songs->getAllAlbumsList($category);

			$data['listTitle'] = $this->songs->getCategoryName($category);
			
			$data['type'] = 'A';

			$data['pageTitle'] = 'All Albums - Download Kannada Remix Songs';
			
			$data['siteDesc'] = 'Listen Kannada DJ Songs on Kannada Remix Music Portal online and many more Kannada DJs. Purely dedicated to kannada remix songs and kannada djs';
			
			$data['keywords'] = '';
			
			if($data['albumsList']){
				foreach($data['albumsList']['albumInfo'][0] as $album){
					$data['keywords'] .= $album['author'].', ';
				}
			}
			
			$data['keywords'] .= 'kannada, remix, kannada remix, kannada dj, dj, karnataka, kannada songs, kannada remix songs, kannada song, remix song,all dj remix song,dj song dj song,dj dj dj remix,dj remix songs,remix songs,dj remix dj remix,kannada djs';

			$data['listToDisplay_Left'] = $this->songs->getAllAlbumsList($category);
			
			$data['allCategories'] = $this->songs->getAllCategories();
			$this->loadViews($data);

		}
/*********************************************/
//
//			for songs 
//
/*********************************************/
		elseif(isset($category) && isset($album)){

			$data['type'] = 'S';

			$albumName = $this->songs->getAlbumName($album);

			$data['pageTitle'] = $albumName.' - Download Kannada Remix Songs';
			
			$data['siteDesc'] = 'Listen '.$albumName.' songs on Kannada Remix Music Portal online and many more Kannada DJs. Purely dedicated to kannada remix songs and kannada dj';

			$data['listTitle'] = $albumName;

			$data['listToDisplay_Left'] = $this->songs->getAllSongsList($category,$album);
			
			$data['albumsList'] = $this->songs->getAllAlbumsList($category);

			$data['allCategories'] = $this->songs->getAllCategories();
			
			$data['keywords'] = '';
			
			if($data['albumsList']){
				foreach($data['albumsList']['albumInfo'][0] as $album){
					$data['keywords'] .= $album['author'].', ';
				}
			}
			
			$data['keywords'] .= 'kannada, remix, kannada remix, kannada dj, dj, karnataka, kannada songs, kannada remix songs, kannada song, remix song,all dj remix song,dj song dj song,dj dj dj remix,dj remix songs,remix songs,dj remix dj remix,kannada djs';

			$this->loadViews($data);

	
		}	
		else
		{
/*********************************************/
//
//			for categories 
//
/*********************************************/
			$data['albumsList'] = $this->songs->getAllAlbumsList($category);
			$data['pageTitle'] = 'All Categories - Download Kannada Remix Songs';
			$data['siteDesc'] = 'Listen Kannada DJ Songs on Kannada Remix Music Portal online and many more Kannada DJs. Purely dedicated to kannada remix songs and kannada djs';
			
			$data['keywords'] = '';
			
			if($data['albumsList']){
				foreach($data['albumsList']['albumInfo'][0] as $album){
					$data['keywords'] .= $album['author'].', ';
				}
			}
			
			$data['keywords'] .= 'kannada, remix, kannada remix, kannada dj, dj, karnataka, kannada songs, kannada remix songs, kannada song, remix song,all dj remix song,dj song dj song,dj dj dj remix,dj remix songs,remix songs,dj remix dj remix,kannada djs';

			$data['type'] = 'C';

			$data['listToDisplay_Left'] = $this->songs->getAllCategories();
			
			$data['listTitle'] = 'All Categories';
			
			$this->loadViews($data);

		}

	}

	

	public function play($id=NULL,$secKey=NULL){
		if($this->input->is_ajax_request()===true){
			if($id=='song'&&isset($secKey) && strlen($secKey)>0 && $this->input->post('secKey')==$secKey ){
				if( file_exists($_SERVER['DOCUMENT_ROOT'].'/temp_path/'.$secKey) ){
					echo json_encode(array('status'=>true));
				}
				else
				{
					echo json_encode(array('status'=>false));
				}
			}
			elseif($id){
				$_SESSION['referredBy'] = $_SERVER['HTTP_REFERER'];
				
				$_SESSION['tempName'] = '/temp_path/'.md5(session_id().'-'.$id).'.mp3';						
				if( ! is_dir($_SERVER['DOCUMENT_ROOT'].'/temp_path/'.md5(session_id().'-'.$id)) ){
				//if( ! file_exists($_SERVER['DOCUMENT_ROOT'].$_SESSION['tempName']) ){
					$qBuilt = http_build_query(array('export'=>'download','id'=>$this->songs->getSongUrl($id,true)));
					$songUrl = 'http://drive.google.com/uc?'. $qBuilt;
					//$songUrl = '1.mp3';
					$song = file_get_contents($songUrl);
					$result = file_put_contents($_SERVER['DOCUMENT_ROOT'].$_SESSION['tempName'],$song);
					if(file_exists($_SERVER['DOCUMENT_ROOT'].$_SESSION['tempName'])){

						if($this->handleFileSplit($id)===true){
							$_SESSION['referredBy'] = $_SERVER['HTTP_REFERER'];
							$rand = md5(rand());
							file_put_contents($_SERVER['DOCUMENT_ROOT'].'/temp_path/'.$rand, '1');

							$a=array(
									'a'=>base64_encode(base_url().index_page().'/songs/s_home/tempSong/'.md5(session_id().'-'.$id)),
									'b'=>$rand,
									'c'=>base64_encode($this->songs->getSongTitle($id).' by '.$this->songs->getSongAuthor($id)),
									'd'=>$this->songs->getAlbumId($id)
							);
							echo json_encode($a);	
						}

					}
				}

				else

				{

					$_SESSION['referredBy'] = $_SERVER['HTTP_REFERER'];
					$rand = md5(rand());
					file_put_contents($_SERVER['DOCUMENT_ROOT'].'/temp_path/'.$rand, '1');

					$a=array(
							'a'=>base64_encode(base_url().index_page().'/songs/s_home/tempSong/'.md5(session_id().'-'.$id)),
							'b'=>$rand,
							'c'=>base64_encode($this->songs->getSongTitle($id).' by '.$this->songs->getSongAuthor($id)),
							'd'=>$this->songs->getAlbumId($id)
					);
					echo json_encode($a);
				}
			}
		}
		else
		{
			header('Error: Unknown Source',true,401);
			echo '<br /><br /><br /><CENTER>UNKNOWN SOURCE. <br />PLEASE VISIT <a href="http://www.kannadaremix.com"><strong>KANNADA REMIX WEBSITE (http://www.kannadaremix.com)</strong></a> AND TRY DOWNLOADING or PLAYING THE SONG.</CENTER>';
		}

	}

	private function handleFileSplit($id){
		$filename = $_SERVER['DOCUMENT_ROOT'].$_SESSION['tempName']; 
		$base_filename = basename($filename);
		$targetfolder = $_SERVER['DOCUMENT_ROOT'].'/temp_path/'.md5(session_id().'-'.$id);
		$piecesize = 0.256; // splitted file size in MB
		$buffer = 1024;
		$piece = 1048576*$piecesize;
		$current = 0;
		$splitnum = 1;
		$piece_name = $targetfolder.'/'.$base_filename.'.'.str_pad($splitnum, 3, "0", STR_PAD_LEFT);

		if(!file_exists($targetfolder)) {
			mkdir($targetfolder);
		}
		else
		{
			rmdir($targetfolder);
			mkdir($targetfolder);
		}

		if(!$handle = fopen($filename, "rb")) {
			die("Unable to open $filename for read! Make sure you edited filesplit.php correctly!");
			return false;
		}

		
		if(!$fw = fopen($piece_name,"w")) {
			die("Unable to open $piece_name for write. Make sure target folder is writeable.");
			return false;
		}
		
		while (!feof($handle) and $splitnum < 999) {
			if($current < $piece) {
				if($content = fread($handle, $buffer)) {
					if(fwrite($fw, $content)) {
						$current += $buffer;
					} else {
						die("filesplit.php is unable to write to target folder. Target folder may not have write permission! Try chmod +w target_folder");
						return false;
					}
				}
			} else {
				fclose($fw);
				$current = 0;
				$splitnum++;
				$piece_name = $targetfolder.'/'.$base_filename.'.'.str_pad($splitnum, 3, "0", STR_PAD_LEFT);
				$fw = fopen($piece_name,"w");
			}
		}
		fclose($fw);
		fclose($handle);
		unlink($_SERVER['DOCUMENT_ROOT'].$_SESSION['tempName']);
		return true;
	}

	public function tempSong($fileName,$songPart=1){
		ini_set('max_execution_time', 1800);
		$refA = explode('/',$_SERVER['HTTP_REFERER']);
		$path = './temp_path/'.$fileName.'/'.$fileName.'.mp3.'.str_pad($songPart, 3, "0", STR_PAD_LEFT);
		if(strlen($fileName)==32 && ( in_array('127.0.0.1',$refA) || in_array('kannadaremix.com',$refA) || in_array('www.kannadaremix.com',$refA) )){ 
			$mime_type = "audio/mpeg, audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3";
			if(file_exists($path)){
			    header('Content-type: {$mime_type}');
			    header('Content-length: ' . filesize($path));
			    header('Content-Range: bytes 200-1000/' . filesize($path));
			    header('Content-Disposition: filename="' . $fileName . '"');
			    header('X-Pad: avoid browser bug');
			    header('Cache-Control: no-cache');
			    readfile($path);
			    exit;
			}
			else
			{
				header('Error: Unknown Source',true,401);
				echo '<br /><br /><br /><CENTER> [UNKNOWN SOURCE]. <br />PLEASE VISIT <a href="http://www.kannadaremix.com"><strong>KANNADA REMIX WEBSITE (http://www.kannadaremix.com)</strong></a> AND TRY DOWNLOADING or PLAYING THE SONG.</CENTER>';
			}
		}
		else
		{
			header('Error: Unknown Source',true,401);
			echo '<br /><br /><br /><CENTER>UNKNOWN SOURCE. <br />PLEASE VISIT <a href="http://www.kannadaremix.com"><strong>KANNADA REMIX WEBSITE (http://www.kannadaremix.com)</strong></a> AND TRY DOWNLOADING or PLAYING THE SONG.</CENTER>';
		}
	
		
	}	

	private function loadViews($data){
		if($this->botDetected()){
			$this->load->vars($data);
			$this->load->view('header');
			$this->load->view('music/display');
			$this->load->view('footer');
		}
		else
		{
			$this->load->vars($data);
			$view['pageTitle'] 	=  $data['pageTitle'];
			$view['resHtml'] 	=  $this->load->view('music/display','',true);
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
}

?>