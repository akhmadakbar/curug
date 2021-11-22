<?php 

//===============STANDARDIZE MODEL FUNCTIONS===============//
	//TO IMPLEMENT BETTER PROGRAMMING APPROACH IN BCS//
//=========================================================//

class Edoc_model extends CI_Model  {
	protected $primary_key = null;
	protected $table_name = null;
	protected $relation = array();
	protected $relation_n_n = array();
	protected $primary_keys = array();
	private $DB = null;

	function __construct()
    {
        parent::__construct();
		$this->DB = $this->load->database('default', TRUE); //hris
    }
    
	
	//=============================== GET DATA ======================================//
	
    function getAllDoc(){
        $query = $this->DB->query("select * from doc order by doc_no desc");
        if ($query->num_rows() > 0) {
            $res = $query->result_array();
        }
        
        $this->fb->log($res);
        else $res = array();
        
        return $res;
	}
}


