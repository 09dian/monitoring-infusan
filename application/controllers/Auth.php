<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		$this->load->model('My_model'); //memanggil model

	}
	public function index()
	{

		$data['date_loadcel'] = $this->db->get('date_imfusan')->result_array();

		$this->load->view('body/kepala');
		$this->load->view('auth/index.php', $data);
		$this->load->view('body/kaki');
	}
	function suhu()
	{
		$data['suhu'] = $this->db->order_by('id_suhu', "desc")->limit(1)->get('date_suhu')->row();
		$this->load->view('auth/suhu.php', $data);
	}


	function loadcell()
	{
		date_default_timezone_set('Asia/Jakarta');
		$jh = date('H:i:s');
		$data['suhu'] = $this->db->order_by('id_suhu', "desc")->limit(1)->get('date_suhu')->row();
		$data['berat'] = $this->db->order_by('id_loadcell', "desc")->limit(1)->get('date_loadcell')->row();
		$this->load->view('auth/loadcel.php', $data);
		$db = $data['berat']->date_loadcell;

		$data['id'] = $this->db->order_by('id', "desc")->limit(1)->get('date_imfusan')->row();
		$data['date_loadcel'] = $this->db->get('date_imfusan')->result_array();
		if (count($data['date_loadcel']) == 0) {
			$id = 1;
		} else {
			$id = $data['id']->id;
		}
		if ($db == 10) {
			$this->db->query(
				"UPDATE `date_imfusan` 
				SET `m_lodacel` = 'Habis' 
				WHERE `date_imfusan`.
				`id` = $id;"
			);
			$this->db->query(
				"UPDATE 
				`date_imfusan` 
				SET `jh` = '$jh' 
				WHERE `date_imfusan`.
				`id` = $id"
			);
		} else {
		}
	}
	function tj()
	{
		$jenis = $this->uri->segment(3, 0); // segmen kirim data suhu
		$data_j = array("
		jenis" => $jenis);
		$this->db->insert('jenis_infusan', $data_j);
		redirect('Auth');
	}

	function posdata()
	{
		$suhu = $this->uri->segment(3, 0); // segmen kirim data suhu
		$loadcel = $this->uri->segment(4, 0); //segmen kirim data loadcell
		$jenis = $this->uri->segment(5, 0); //segmen kirim data loadcell
		$data_s = array(
			"suhu" => $suhu
		);
		$data_l = array(
			"date_loadcell" => $loadcel
		);
		$data_j = array("
		jenis" => $jenis);
		$this->db->insert('date_suhu', $data_s);
		$this->db->insert('date_loadcell', $data_l);
		$this->db->insert('jenis_infusan', $data_j);
		redirect('Auth');
	}
	function pasang($data)
	{
		$jenis['jenis'] = $this->db->order_by('id_jenis', "desc")->limit(1)->get('jenis_infusan')->row();
		$suhu['suhu'] = $this->db->order_by('id_suhu', "desc")->limit(1)->get('date_suhu')->row();
		$suhu['suhu'] = $this->db->order_by('id_suhu', "desc")->limit(1)->get('date_suhu')->row();
		$ds = $suhu['suhu']->suhu;
		$jsn = $jenis['jenis']->jenis;
		date_default_timezone_set('Asia/Jakarta');
		$jam = date('H:i:s');
		if ($data == 10) {
			$m_data = array(
				"day" => time(),
				"date" => time(),
				"jp" => $jam,
				"jh" => '00-00-00',
				'sr' => $ds,
				'm_lodacel' => "Pasang",
				'jenis' => $jsn
			);
			$l_data = array(
				"date_loadcell" => 0
			);
			$this->db->insert('date_imfusan', $m_data);
			$this->db->insert('date_loadcell', $l_data);
		} else {
		}
		redirect('auth');
	}




	function tombol()
	{
		$data['berat'] = $this->db->order_by('id_loadcell', "desc")->limit(1)->get('date_loadcell')->row();
		$this->load->view('auth/tombol.php', $data);
	}
	function ml()
	{
		$data['date_loadcel'] = $this->db->get('date_imfusan')->result_array();
		$this->load->view('auth/ml.php', $data);
	}
	function data_pasien()
	{
		$data['pasien'] = $this->db->get('data_pasien')->result_array();
		$this->load->view('body/kepala');
		$this->load->view('auth/data_pasien', $data);
		$this->load->view('body/kaki');
	}


	function tambah_pasien()
	{
		$this->load->view('body/kepala');
		$this->load->view('auth/tambah_pasien');
		$this->load->view('body/kaki');
	}
	function jenis()
	{
		$data['jenis'] = $this->db->order_by('id_jenis', "desc")->limit(1)->get('jenis_infusan')->row();
		$this->load->view('auth/jenis', $data);
	}

	function hapus($data)
	{
		$this->db->query("DELETE FROM `data_pasien` WHERE `data_pasien`.`id_pasien` = '$data'");
		redirect('auth');
	}

	function lihat($data)

	{
		$query = $this->db->query("SELECT * FROM data_pasien WHERE id_pasien = '$data'");
		$date['lihat'] = $query->row();
		// echo $date['lihat']->n_pasien;
		$this->load->view('body/kepala');
		$this->load->view('auth/lihat', $date);
		$this->load->view('body/kaki');
	}
}
