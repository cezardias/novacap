<?php
class Sobre extends Controller {
	function __construct() {
		parent::Controller();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('session');
	}
	function index(){
		$this->load->view('view_sobre_index');
	}
}