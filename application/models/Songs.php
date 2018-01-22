<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Songs extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->db->cache_on();
        
        
        
    }    
    public function getRecentAlbumsList()
    {
        $q   = "SELECT a.id,a.name as albumname, a.author,b.name as categoryname FROM albums a, categories b
				where b.id = a.category 
				order by created_on desc 
				limit 10";
        $res = $this->db->query($q);
        if ($res->num_rows() > 0) {
            return $res->result_array();
        } else {
            return false;
        }
    }
    public function getAllAlbumsList($category=NULL)
    {
        if ($category) {
            $sql = " select id, name, author, category, image, type, created_on from albums where category = " . $category . " order by name asc";
        }
        
        else 
        {
            $sql = " select id, name, author, category, image, type, created_on from albums  order by name asc";
            
        }
        
        
        
        $res = $this->db->query($sql);
        
        
        
        $data['albumInfo'][] = $res->result_array();
        
        
        
        if ($res->num_rows() > 0) {
            $i = 0;
            
            
            
            foreach ($res->result_array() as $r) {
                $sql = "select count(id) totalSongs from songs where album = " . $r['id'];
                
                
                
                $res = $this->db->query($sql);
                
                
                
                if ($res->num_rows() > 0) {
                    $result = $res->result_array();
                    
                    
                    
                    $data['albumInfo'][0][$i]['totalSongs'] = $result[0]['totalSongs'];
                    
                    
                    
                }
                
                
                
                $i++;
                
                
                
            }
            
            
            
            return $data;
            
            
            
        }
        
        
        
        else {
            return false;
            
            
            
        }
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    public function getAlbumName($album)
    {
        $sql = " select name from albums where id = " . $album;
        
        
        
        $res = $this->db->query($sql);
        
        
        
        if ($res->num_rows() > 0) {
            return $res->row()->name;
            
            
            
        }
        
        
        
    }
    
    public function getCategoryName($cat)
    {
        $sql = " select name from categories where id = " . $cat;
        
        
        
        $res = $this->db->query($sql);
        
        
        
        if ($res->num_rows() > 0) {
            return $res->row()->name;
            
            
            
        }
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    public function getAuthorName($author)
    {
        $sql = " select userid from users where id = " . $author;
        
        
        
        $res = $this->db->query($sql);
        
        
        
        if ($res->num_rows() > 0) {
            return $res->row()->userid;
            
            
            
        }
        
        
        
    }
    
    public function getAlbumId($songid)
    {
        $sql = " select album from songs where id = " . $songid;
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            return $res->row()->album;
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    public function getAllSongsList($category, $album)
    {
        $sql = " 	select a.*,b.*



					from songs a, albums b



					where a.album = b.id



					and b.category = " . $category . "



					and a.album = " . $album;
        
        
        
        
        
        
        
        $res = $this->db->query($sql);
        
        
        
        $data['songsInfo'][] = $res->result_array();
        
        
        
        
        
        
        
        if ($res->num_rows() > 0) {
            $i = 0;
            
            
            
            foreach ($res->result_array() as $r) {
                $data['songsInfo'][0][$i]['album'] = $this->getAlbumName($r['album']);
                
                
                
                $i++;
                
                
                
            }
            
            
            
            return $data;
            
            
            
        }
        
        
        
        else {
            return false;
            
            
            
        }
        
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    public function getSongUrl($id, $mobileRequest = false)
    {
        $this->db->select(array(
            'slink'
        ));
        
        
        
        $this->db->where(array(
            'id' => $id
        ));
        
        
        
        $res = $this->db->get('songs');
        
        
        
        if ($mobileRequest === false) {
            $this->updatePlayed($id);
            
        }
        
        else {
            $this->updateDownloaded($id);
            
        }
        
        
        
        return $res->row()->slink;
        
        
        
    }
    
    public function getSongTitle($id)
    {
        $this->db->select(array(
            'name'
        ));
        $this->db->where(array(
            'id' => $id
        ));
        $res = $this->db->get('songs');
        return $res->row()->name;
    }
    
    public function getSongAuthor($id)
    {
        $this->db->select(array(
            'author'
        ));
        $this->db->where(array(
            'id' => $id
        ));
        $res = $this->db->get('songs');
        return $res->row()->author;
    }
    
    
    
    
    
    
    
    public function updateDownloaded($id)
    {
        $sql = "update songs



				set downloaded = downloaded+1



				where id = " . $id;
        
        
        
        $res = $this->db->query($sql);
        
        
        
        return true;
        
        
        
    }
    
    
    
    public function updatePlayed($id)
    {
        $sql = "update songs



				set played = played+1



				where id = " . $id;
        
        
        
        $res = $this->db->query($sql);
        
        
        
        return true;
        
        
        
    }
    
    
    
    public function getAllCategories()
    {
        $sql = "SELECT * from categories";
        
        $res = $this->db->query($sql);
        
        return $res->result_array();
        
    }
    
    public function getTopSongs($cat=NULL)
    {
        $sql = "SELECT a.id, a.name, a.author FROM songs a, albums b where b.id = a.album and b.category = $cat order by a.downloaded desc limit 10";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
    public function getTopAlbum()
    {
        $sql = "select a.id, a.name, a.author, count(b.id) songs, sum(b.downloaded) played, c.id category
				from albums a, songs b, categories c
				where b.album = a.id
				and c.id = a.category
				group by a.id, a.name, a.author
				order by 5 desc
				limit 10";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
    public function getTopDj()
    {
        $sql = "select a.author, count(b.id) songs, sum(b.downloaded) played 
				from albums a, songs b
				where b.album = a.id
				group by a.author
				order by 3 desc
				limit 10";
        $res = $this->db->query($sql);
        return $res->result_array();
    }
    
    
}