<?php
class Kuesioner_model extends CI_Model {

	function getKuesioner() {
		$this->load->database();
		$query = $this->db->query("select t.id_title, t.title, q.id_question, q.question from title t, question q where t.id_title = q.id_title order by t.id_title, q.id_question");
		$result = $query->result();
		return $result;
	}

	function getUser($email) {
		$this->load->database();
		$this->db->select('id_user');
		$this->db->where('email',$email);
		$query = $this->db->get('user');
		$result = $query->result();
		return $result;
	}

	function getAnswerByIdUser($idUser) {
		$this->load->database();
		$this->db->select('id_user');
		$this->db->where('id_user',$idUser);
		$query = $this->db->get('answer');
		$result = $query->result();
		return $result;
	}

	function addUser($name, $email) {
		$this->load->database();
		$this->db->set('name',$name);
		$this->db->set('email',$email);
		$this->db->insert('user');
	}

	function addAnswer($idUser, $idTitle, $idQuestion, $value) {
		$this->load->database();
		$this->db->set('id_user',$idUser);
		$this->db->set('id_title',$idTitle);
		$this->db->set('id_question',$idQuestion);
		$this->db->set('value',$value);
		$this->db->insert('answer');
	}
	
}
?>