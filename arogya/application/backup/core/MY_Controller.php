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
		if($logged=$this->session->userdata('loggedUser'))
		{
			$user=$this->db->get_where('users',['id'=>$logged['id']])->row_array();
			$this->logged=$user;
		}
		if ($logged=$this->session->userdata('loggedCustomer')) {
			$customer=$this->db->get_where('flat_registration',['id'=>$logged['id']])->row_array();
			$this->loggedCust=$customer;
		}
		if ($loggedEmployee=$this->session->userdata('loggedEmployee')) {
			$employee=$this->db->get_where('employee',['id'=>$loggedEmployee['id']])->row_array();
			$this->loggedEmp=$employee;
		}

		if ($loggedLandOwner=$this->session->userdata('loggedLandOwner')) {
			$landOwner=$this->db->get_where('land',['id'=>$loggedLandOwner['id']])->row_array();
			$this->loggedLand=$landOwner;
		}




		 if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60000))
	     {
	       // last request was more than 30 minutes ago
	       session_unset();     // unset $_SESSION variable for the run-time 
	       session_destroy();   // destroy session data in storage
	     }
	    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
		date_default_timezone_set('Asia/Kolkata');
		$this->load->model('db_model');
		$this->load->model('commission_model');
		$this->commission_model->getCommission();
	}

}