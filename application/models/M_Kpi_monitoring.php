<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Source table : "kpi_monitoring"
*/
class M_Kpi_monitoring extends CI_Model {

	public function get_all()
	{
		return $this->db->get('kpi_monitoring')->result();
	}

	public function get_id($id)
	{
		return $this->db->get_where('kpi_monitoring',array('ID_KPI_MONITORING'=>$id),1)->result();
	}

	public function actual_bulanan(array $cond)
	{
		$this->db->select('*');
		$this->db->from('kpi_monitoring');
		$this->db->join('kpi','kpi_monitoring.ID_KPI = kpi.ID_KPI');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function sum_actual_bulanan(array $cond = NULL,$periode)
	{
		$this->db->select_sum('ACTUAL_BULANAN','TOTAL_ACTUAL');
		$this->db->from('kpi_monitoring');
		if (count($cond) > 0)
			$this->db->where($cond);
		if ($periode == '1') {
			$this->db->where('BULAN <','7');
		}else{
			$this->db->where('BULAN >','6');
		}
		$total = $this->db->get()->result()[0]->TOTAL_ACTUAL;
		if ($total != null or $total!= 0)
		{
			return $total;
		}else{
			return 0;
		}
	}

	public function join_kpi(array $cond = NULL)
	{
		$this->db->select('*');
		$this->db->from('kpi_monitoring');
		$this->db->join('kpi','kpi_monitoring.ID_KPI = kpi.ID_KPI');
		if (count($cond) > 0)
			$this->db->where($cond);
		return $this->db->get()->result();
	}

	public function add(array $data)
	{
		return $this->db->insert('kpi_monitoring',$data);
	}

	public function Update(array $data,array $where)
	{
		return $this->db->update('kpi_monitoring',$data,$where);
		
	}
}