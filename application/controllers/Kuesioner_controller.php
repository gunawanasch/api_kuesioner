<?php
class Kuesioner_controller extends CI_Controller {

	function getKuesioner() {
		//http://localhost/api_kuesioner/index.php/Kuesioner_controller/getKuesioner
		$this->load->model('Kuesioner_model');
		$data = $this->Kuesioner_model->getKuesioner();
		echo json_encode($data);
	}

	function addUser() {
		//http://localhost/api_kuesioner/index.php/Kuesioner_controller/addUser
		$name = $this->input->post("name");
		$email = $this->input->post("email");
		$this->load->model('Kuesioner_model');
		$dataUser = $this->Kuesioner_model->getUser($email);

		if(sizeof($dataUser) > 0) {
			$result = array('status' => 0, 
							'message' => "Email sudah dipakai.");
		}
		else {
			$this->Kuesioner_model->addUser($name, $email);
			$result = array('status' => 1, 
							'message' => "Data user sudah masuk.");
		}
		echo json_encode($result);
	}

	function addAnswer() {
		//http://localhost/api_kuesioner/index.php/Kuesioner_controller/addAnswer
		$idTitle = $this->input->post("idTitle");
		$idQuestion = $this->input->post("idQuestion");
		$value = $this->input->post("value");
		$email = $this->input->post("email");
		$this->load->model('Kuesioner_model');
		$dataUser = $this->Kuesioner_model->getUser($email);
		if(sizeof($dataUser) > 0) {
			$checkAnswer = $this->Kuesioner_model->getAnswerByIdUser($dataUser[0]->id_user);
			if(sizeof($checkAnswer) > 0) {
				$result = array('status' => 0, 
								'message' => "Anda sudah mengisi kuesioner.");
			} 
			else {
				for($i=0;$i<sizeof($idTitle);$i++) {
					$this->Kuesioner_model->addAnswer($dataUser[0]->id_user, $idTitle[$i], 
													  $idQuestion[$i], $value[$i]);
			 	}
				$result = array('status' => 1, 
								'message' => "Kuesioner berhasil diisi.");
			}
			
		}
		else {
			$result = array('status' => 0, 
							'message' => "Email belum terdaftar.");
		}
		echo json_encode($result);
	}

}
?>