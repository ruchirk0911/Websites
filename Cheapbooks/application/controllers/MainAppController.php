<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainAppController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('Page1_view');
	}

    public function login() {
	    $username = $this->input->post('username');
	    $this->load->model('LoginModel');
	    $id = $this->LoginModel->login();
	    if($id!=null) {
	      $data = array('username' => $username,'basketId' => $id);
            $this->session->set_userdata('user_session', $data);
            echo true;
	      }
        else{
            echo false;
        }
       
    }

    public function Page2() {
    	$this->load->view('Page2_view');
    }

    public function shoppingCount(){
    	$this->load->model('LoginModel');
	    $count = $this->LoginModel->shoppingCount();
	    echo $count;
    }

    public function Search(){
    	$this->load->model('LoginModel');
    	$data = $this->LoginModel->Search();
    	echo $data;
    }

    public function addToCart(){
    	$this->load->model('LoginModel');
    	$count = $this->LoginModel->addToCart();
    	echo $count;
    }

    public function Page3() {
    	$this->load->view('Page3_view');
    }

    public function viewCart(){
    	$this->load->model('LoginModel');
    	$data = $this->LoginModel->viewCart();
    	echo $data;
    }

    public function logout(){
    	$this->session->unset_userdata('user_session');
        $this->session->sess_destroy();
        return true;
    }

    public function Page4() {
    	$this->load->view('Page4_view');
    }

   public function register(){
    	$this->load->model('LoginModel');
    	$data = $this->LoginModel->register();
    	echo $data;
    } 

    public function Transaction(){
    	$this->load->view('Buy_view');
    }

    public function buy(){
    	$this->load->model('LoginModel');
    	$data = $this->LoginModel->buy();
    	echo $data;
    }
}
?>