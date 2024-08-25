<?php
class Cancelation_model extends CI_Model
{
	public function flat_cancelled($data='')
	{	
		$condition1= ['id'=>$data['id'],'registration'=>$data['registration']];
		$flat_cont = $this->db_model->rowCount('flat_registration',$condition1);
		
		if ($flat_cont>0) {
			$result = $this->db_model->getwhere('flat_registration',$condition1);

			$result['registered_flat_id']	= $result['id'];
			$result['is_cancelled'] = 1;
			$result['cancelled_date'] = date('Y-m-d');
			$result['cancelled_time'] = date('h:i:s A');
			$result['cancelled_total_amount'] = $data['cancelled_total_amount'];
			$result['cancelled_return_amount'] = $data['cancelled_return_amount'];
			unset($result['id']);

			$cansalationId = $this->db_model->globalInsert('cancelled_flat',$result);
			if (!empty($cansalationId)) {
				$this->db_model->globalDelete('flat_registration',$condition1);
				$this->db_model->globalUpdate('flat',['id'=>$result['flat_id']],['booking_status'=>0,'status'=>0]);
				
				$condition2 = ['flat_user_id'=>$data['id'],'is_cancelled'=>0];				
				
				$allInstallment = $this->db_model->globalSelect_condition('installment',$condition2);
				$installmentUpdateData = ['is_cancelled'=>1,'cancelled_date'=>date('Y-m-d'),'cancelled_time'=>date('h:i:s A'),'cancelled_flat_id'=>$cansalationId];
					foreach ($allInstallment as $key => $installment) {
						$this->db_model->globalUpdate('installment',['id'=>$installment['id']],$installmentUpdateData);
					}
			
				$allPayment = $this->db_model->globalSelect_condition('payment',$condition2);
					foreach ($allPayment as $key => $payment) {
						$this->db_model->globalUpdate('payment',['id'=>$payment['id']],$installmentUpdateData);
					}
			}

			$this->session->set_flashdata('msg','Flat Cancelation has been Successfully Done');
			$this->session->set_flashdata('msg_class','alert-success');

			return true;

		}
		else {
			$this->session->set_flashdata('msg','Flat Cancelation has been Failed...');
			$this->session->set_flashdata('msg_class','alert-danger');
		 return false; 
		}
	}




	public function auto_plotcancellation($value='')
	{	
		$this->load->model('db_model');
		$today = date('Y-m-d');
		$time_slot = ['next_due_date<='=>$today,'status'=>1,'booking_status'=>1];
		$cancellationdata = $this->db_model->globalSelect('flat_registration',$time_slot);
		if (isset($cancellationdata)) 
		{
			foreach ($cancellationdata as $key => $canceldata) 
			{
				$data['id'] = $canceldata['id'];
				$data['registration'] = $canceldata['registration'];
				$data['cancelled_total_amount'] = 0;
				$data['cancelled_return_amount'] = 0;

				$this->flat_cancelled($data);
			}
		}
		 // die();
	}
}