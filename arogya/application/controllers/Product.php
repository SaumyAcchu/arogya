<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct()
	{
		parent:: __construct();
		
	}


	public function addtocart()
	{
		
		$id=$_POST['item_id'];
		$add_qty=$_POST['add_qty'];
		$price=$_POST['price'];
		$name=$_POST['name'];
		$dp=$_POST['dp'];
		$cv=$_POST['cv'];

		$data= array('id' => $id ,
					 'qty' => $add_qty,
					 'price' => $dp,
    				 'name'    => $name,
    				 'dp'    => $dp,
    				 'mrp'    => $price,
    				 'cv'    => $cv,
    				 'options' => array('Size' => 'L', 'Color' => 'Red')
					 );
		$this->cart->insert($data);
		echo $this->view();
	}

	function view()
	{
	$this->load->view('user/cart_div');
	}

	function remove()
	 {
	  
	  $row_id = $_POST["item_id"];
	  $data = array(
	   'rowid'  => $row_id,
	   'qty'  => 0
	  );
	  $this->cart->update($data);
	  echo $this->view();
	 }

	
}