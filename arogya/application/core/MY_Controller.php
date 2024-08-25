
<?php
class MY_Controller extends CI_Controller
{
	public $logged;
	public $siteInfo;
	function __construct()
	{
		parent:: __construct();
		$comp=$this->db->get_where('company',['id'=>1])->row_array();
		$this->siteInfo=$comp;
		$this->load->model('commission_model');
		if($logged=$this->session->userdata('loggedUser'))
		{
			$user=$this->db->get_where('users',['id'=>$logged['id']])->row_array();
			$this->logged=$user;
		}
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('dbm');
		$this->load->model('comm');
		$date=date('Y-m-d');
		if(date('d')=="Mon"){
		$valid=$this->dbm->rowCount('withdraw',['date'=>$date]);
		if ($valid<1) {
// 		 $this->comm->closeNow();
		 }
		}
		 
	     $valid=$this->dbm->rowCount('pairmaching',['date'=>$date]);
		if ($valid<1) {
  	 //   $this->comm->binaryClosing();
  	    }
  	    
  	    $validClup=$this->dbm->rowCount('club_users',['date'=>$date]);
		if ($validClup<1) {
  	 //   $this->commission_model->getAllClub();
  	    }
  	    
	}
}