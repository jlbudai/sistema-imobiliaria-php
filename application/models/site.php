<?php if (!defined('BASEPATH'))exit('No direct script access allowed');

class Site extends CI_Model {
	
	
	public function pag_imoveis($limite_por_pag, $offset)
	{
		$this -> db -> limit($limite_por_pag, $offset);
		$this->db->order_by('idImovel', 'asc');
		return $this->db->get('imoveis');
	}
	
	public function get_destaques() {
		$this -> db -> order_by('idImovel', 'random');
		$this -> db -> where('destaque', 'Sim');
		return $this -> db -> get('imoveis');
	}
	
	public function get_imoveis() {
		$this -> db -> where('destaque', 'Não');
		$this -> db -> order_by('idImovel', 'random');
		$this -> db -> limit(6);
		return $this -> db -> get('imoveis');
	}
	
	public function get_imoveis2() {
		$this -> db -> where('destaque', 'Não');
		$this -> db -> order_by('idImovel', 'random');
		$this -> db -> limit(3);
		return $this -> db -> get('imoveis');
	}
	
	public function detalhe_imovel($codUnico) {
		$this -> db -> where('CodUnico', $codUnico);
		return $this -> db -> get('imoveis');
	}
	
	public function fotos_imovel($codImovel) {
		$this -> db -> where('codImovel', $codImovel);
		$this -> db -> order_by('ordem', 'asc');
		return $this -> db -> get('fotos');
	}

	public function resultado($negocio, $tipo, $cidade, $bairro, $faixapreco, $valorMin, $valorMax) {
		$this -> db -> select('*');

		if ($faixapreco == '') :
			// $this -> db -> limit($limite_por_pag, $offset);
			$this -> db -> like('negocio', $negocio);
			$this -> db -> like('tipo', $tipo);
			$this -> db -> like('cidade', $cidade);
			$this -> db -> like('bairro', $bairro);
		else :
			// $this -> db -> limit($limite_por_pag, $offset);
			$this -> db -> like('negocio', $negocio);
			$this -> db -> like('tipo', $tipo);
			$this -> db -> like('cidade', $cidade);
			$this -> db -> like('bairro', $bairro);
			$this -> db -> where('valor >=', $valorMin);
			$this -> db -> where('valor <=', $valorMax);
		endif;

		return $this -> db -> get('imoveis');
	}

	public function codigo($codunico) {
		$this -> db -> select('*');
		$this -> db -> like('codunico', $codunico);
		return $this -> db -> get('imoveis');
	}
	

	public function get_pagina($id)
	{
		if ($id!=null) {
			$this->db->where('id',$id);
			return $this->db->get('paginas'); 
		} else {
			return FALSE;
		}
	}

	

}