<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactModel extends CI_Model {


	public function getContact(){
		/*$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $offset = ($page-1)*$rows;
        $result = array();*/
        //$this->db->from('contact_info');

        //$query = $this->db->get();
        //$query->num_rows()
       

        //$rs = $query->num_rows();
        

   /* if ( $rs->num_rows() > 0 )
    {
       $row = $rs->row_array();
       return $row;
    }*/
        //$row =$rs; 
        //$rs = mysql_query("select count(*) from contact_info");
//$row = mysql_fetch_row($rs);
//$row = $rs -> fetch_row();
/*$rs = $this->db->query("select * from contact_info");*/
//$row = mysql_fetch_row($rs);
/*$row =$rs->row_array();*/
//print_r($row); exit();
/*$result["total"] = $row[0];*/

//$result["total"] = $row[0];
        //$result["total"] = $row[0];
		$this->db->from('contact_info');
		$query=$this->db->get()->result();
		/*$rs=$query;
		$items = array();
			while($row = mysql_fetch_object($rs)){
			    array_push($items, $row);
			}
			$result["rows"] = $items;*/
		return $query;

	}

	public function searchNameContact($pName){
        $this->db->from('contact_info');
         $this->db->like('name',$pName);
		$query=$this->db->get()->result();
		return $query;

	}

	public function searchPhoneContact($pPhone){
        $this->db->from('contact_info');
        	$this->db->like('phone',$pPhone);
		$query=$this->db->get()->result();
		return $query;

	}

	public function searchContact($pName,$pPhone){
        $this->db->from('contact_info');
         $this->db->like('name',$pName);
        	$this->db->like('phone',$pPhone);
		$query=$this->db->get()->result();
		return $query;

	}

	/*public function searchDateContact(){
		$vFrom=$this->input->post('vFrom');
		$vTo=$this->input->post('vTo');
        $this->db->from('contact_info');
         $this->db->where('created_on BETWEEN "'. date('Y-m-d', strtotime($vFrom)). '" and "'. date('Y-m-d', strtotime($vTo)).'"');
		$query=$this->db->get()->result();
		return $query;

	}*/

	public function saveContact(){
		$vName=$this->input->post('name');
		$vPhone=$this->input->post('phone');
		$vCompany=$this->input->post('company');
		$vAddress=$this->input->post('address');
		$vCreatedOn =date("Y-m-d H:i:s");

		$data=array(
			'name'=>$vName,
			'phone'=>$vPhone,
			'company'=>$vCompany,
			'address'=>$vAddress,
			'created_on'=>$vCreatedOn
		);
		$query=$this->db->insert('contact_info',$data);
		return $query;
	}

	public function updateContact($id){
		$vName=$this->input->post('name');
		$vPhone=$this->input->post('phone');
		$vCompany=$this->input->post('company');
		$vAddress=$this->input->post('address');
		$vUpdatedOn =date("Y-m-d H:i:s");

		$data=array(
			'name'=>$vName,
			'phone'=>$vPhone,
			'company'=>$vCompany,
			'address'=>$vAddress,
			'updated_on'=>$vUpdatedOn
		);
		$this->db->where('contact_info_id',$id);
		$query=$this->db->update('contact_info',$data);
		return $query;
	}

	public function destroyContact(){
		$vId=$this->input->post('id');
		$this->db->where('contact_info_id',$vId);
		$query=$this->db->delete('contact_info');
		return $query;
	}

}

/* End of file ContactModel.php */
/* Location: ./application/models/ContactModel.php */