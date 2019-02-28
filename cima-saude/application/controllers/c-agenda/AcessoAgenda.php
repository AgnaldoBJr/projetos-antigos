<?php
	defined('BASEPATH') OR die ('No direct script access allowed');

	class AcessoAgenda extends CI_Controller {

		function __construct(){
			parent::__construct();

			$this->load->model('Acesso_model');
			$this->load->model('Generic_model');
			$this->load->library('form_validation');
			$this->load->helper('form');
		}

		public function index(){
			$this->load->view('commons/agenda/head-agenda');
			$this->load->view('commons/agenda/header-agenda');
			$this->load->view('agenda/agenda');			
		}

}