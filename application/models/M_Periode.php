<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "periode"
*/
class M_Periode extends CI_Model {

	public function get_all()
	{
		return $this->db->get('periode')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('periode',array('ID_PERIODE' => $id),1)->result();
	}



}