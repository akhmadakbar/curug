<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Edoc_model extends CI_Model
{
	protected $primary_key = null;
	protected $table_name = null;
	protected $relation = array();
	protected $relation_n_n = array();
	protected $primary_keys = array();
	private $DB = null;

	function __construct()
	{
		parent::__construct();

	}

  function getAllDoc(){
				
        $query = $this->db->query("select * from doc order by doc_no desc");
        if ($query->num_rows() > 0) {
            $res = $query->result_array();
        }
        
        // $this->fb->log($res);
        else $res = array();
        
        return $res;
	}

  function getSelectedDoc($doc_no){
				
        $query = $this->db->query("select * from doc where doc_no = '$doc_no' order by doc_no desc");
        if ($query->num_rows() > 0) {
            $res = $query->result_array();
        }
        
        // $this->fb->log($res);
        else $res = array();
        
        return $res;
	}

	function getCoaName($coa_id){
        //ambil nama direktorat
        
        $query = $this->db->query("select coa from coa where coa_id='$coa_id'");
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $coa = $row['coa'];
        }
        else $coa = "";
        
        return $coa;
    }
 	
	function getDocType($doc_type_id,$coa_id){
        //ambil nama direktorat
        
        $query = $this->db->query("select doc_type from doc_type where doc_type_id='$doc_type_id' and coa_id='$coa_id'");
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            $doc_type = $row['doc_type'];
        }
        else $doc_type = "";
        
        return $doc_type;
    }		
}

/* End of file home_model.php */ 
/* Location: ./sma/modules/home/models/home_model.php */
