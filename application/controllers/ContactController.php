<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactController extends CI_Controller {

	public function __construct()
       {
            parent::__construct();
            $this->load->model('ContactModel');
       }

	public function index()
	{
		$this->load->view('page/home');
	}


        public function getContact(){
                
                $this->output->set_content_type('application/json');
                $contact = $this->ContactModel->getContact();
                echo json_encode($contact);
                
        }

        public function searchNameContact($pName){
                $this->output->set_content_type('application/json');
                $contact = $this->ContactModel->searchNameContact($pName);
                echo json_encode($contact);
        }

        public function searchPhoneContact($pPhone){
                $this->output->set_content_type('application/json');
                $contact = $this->ContactModel->searchPhoneContact($pPhone);
                echo json_encode($contact);
        }

        public function searchContact($pName,$pPhone){
                $this->output->set_content_type('application/json');
                $contact = $this->ContactModel->searchContact($pName,$pPhone);
                echo json_encode($contact);
        }

       /* public function searchDateContact(){
                $this->output->set_content_type('application/json');
                $contact = $this->ContactModel->searchDateContact();
                echo json_encode($contact);
        }*/

	public function saveContact(){
                       $query=$this->ContactModel->saveContact();
                           if ($query) {
                        echo json_encode(array('success' => 'Successfully Save Contact'));
                    } else {
                        echo json_encode(array('error_msg' => 'Failed submission'));
                    }
	}

  
  public function updateContact($id){
         $query=$this->ContactModel->updateContact($id);
                           if ($query) {
                        echo json_encode(array('success' => 'Successfully Updated Contact'));
                    } else {
                        echo json_encode(array('error_msg' => 'Failed Updated'));
                    }

  } 

  public function destroyContact(){
      $query=$this->ContactModel->destroyContact();  
              if ($query) {
                        echo json_encode(array('success' => 'Successfully Deleted Contact'));
                    } else {
                        echo json_encode(array('error_msg' => 'Failed Deleted'));
                    }
  }     

}

/* End of file ContactController.php */
/* Location: ./application/controllers/ContactController.php */