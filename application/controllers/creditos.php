<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Comunicacion con el modelo
		$this->load->model("creditos_model");
		$this->load->model("personas_model");
	}


	public function index()
	{
		$listaCreditos=$this->creditos_model->listarCreditos();
		$data['creditos']=$listaCreditos;
		$this->load->view('inic/header');
		$this->load->view('creditos/index',$data);
		$this->load->view('inic/footer');
		
	}

	public function delete($id){
		//buscamos deuda del cliente
		$datosPersona=$this->personas_model->GetPersona($id);
		$saldoCliente=0;
		foreach ($datosPersona->result() as $row) {
			$saldoCliente=$row->saldoDeuda;
		}

		// ingresamos datos al historial
		$data['idPersona']=$id;
		$data['saldoAnterior']=$saldoCliente;
		$data['aCuenta']=$saldoCliente;
		$data['saldoActual']=0;


		$this->creditos_model->deleteCredito($id,$data);
		
		redirect('creditos','refresh');
		
	}

	public function update()
	{

		$id=$_POST['txtIdPersona'];
		$acuenta=$_POST['txtAcuenta'];
		//Buscamos deuda del cliente
		$datosPersona=$this->personas_model->GetPersona($id);
		$saldoCliente=0;
		foreach ($datosPersona->result() as $row) {
			$saldoCliente=$row->saldoDeuda;
		}
		$saldoActual=$saldoCliente-$acuenta;

		$data['saldoDeuda']=$saldoActual;
					
		$this->creditos_model->updateCredito($id,$data);

		// ingresamos datos al historial
		$data1['idPersona']=$id;
		$data1['saldoAnterior']=$saldoCliente;
		$data1['aCuenta']=$acuenta;
		$data1['saldoActual']=$saldoActual;

		$this->creditos_model->insertHistorial($data1);
		
		redirect('creditos','refresh');
		
	}

	public function detalleCreditos($id=NULL){

			$listaPagos=$this->creditos_model->listarPagosCredito($id);
			$data['listaPagos']=$listaPagos;
			$this->load->view('inic/header'); 
			$this->load->view('creditos/lista',$data);
			$this->load->view('inic/footer');
		
	}



	



}

