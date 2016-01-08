<?php
use Aura\SqlQuery\QueryFactory;

class Data extends \Phalcon\Mvc\Model
{

	public $id;
	
	public function onConstruct()
	{
	}
	
	public function initialize()
	{
	}
	
	public function get_table_data_json($_post, $_table_config)
	{
		$query_factory = new QueryFactory('mysql');
		
		#total records
		$select = $query_factory->newSelect();
		$select
			->cols(array('COUNT('.$_table_config['primary_column'].') AS total'))
			->from($_table_config['db_tablename']);
		$result_set = $this->getReadConnection()->query($select->getStatement());
		$result_set->setFetchMode(Phalcon\Db::FETCH_ASSOC);
		$total_records = $result_set->fetchArray($result_set)['total'];
		
		#filtered records
		if (strlen($_post['search']['value']) > 0) {
			$search_string = strtoupper($_post['search']['value']);
			foreach ($_table_config['columns'] as $c) $select->orWhere("UCASE(".$c['db_field'].") LIKE '%".$search_string."%'");
			$result_set = $this->getReadConnection()->query($select->getStatement());
			$result_set->setFetchMode(Phalcon\Db::FETCH_ASSOC);
			$total_filtered_records = $result_set->fetchArray($result_set)['total'];
		}
		else $total_filtered_records = $total_records;
		
		#return data
		$ret = array(
			'draw' => $_post['draw'],
			'recordsTotal' => $total_records,
			'recordsFiltered' => $total_filtered_records,
			'data' => array()
		);
		
		#page records
		$cols = [];
		foreach ($_table_config['columns'] as $c) $cols[] = $c['db_field'].' AS f'.$c['i'];
		$select = $query_factory->newSelect();
		$select
			->cols($cols)
			->from($_table_config['db_tablename'])
			->orderBy(array($_table_config['columns'][$_post['order'][0]['column']]['db_field']." ".$_post['order'][0]['dir']))
			->limit($_post['length'])
			->offset($_post['start']);
		if (strlen($_post['search']['value']) > 0) {
			foreach ($_table_config['columns'] as $c) $select->orWhere("UCASE(".$c['db_field'].") LIKE '%".$search_string."%'");
		}
		$result_set = $this->getReadConnection()->query($select->getStatement());
		$result_set->setFetchMode(Phalcon\Db::FETCH_ASSOC);
		$data = $result_set->fetchAll();
		foreach ($data as $row) {
			$data_row = [];
			foreach ($_table_config['columns'] as $c) $data_row[]=$row['f'.	$c['i']];
			$ret['data'][] = $data_row;
		}
		
		return json_encode($ret);
	}
	
	public static function get_table_data_json2($_post, $_table_config)
	{
		
		#filtered records
		/*
		if (strlen($_post['sSearch']) > 1) {
			$search_string = strtoupper($_post['sSearch']);
			$builder->orWhere("Orders.id = :param:", array('param' => $search_string));
			$builder->orWhere("UCASE(Customers.name) LIKE '%".$search_string."%'");
			$builder->orWhere("UCASE(Models.name) LIKE '%".$search_string."%'");
			$builder->orWhere("UCASE(Orders.dimenzija_vrata) LIKE '%".$search_string."%'");
			$builder->orWhere("UCASE(Orders.datum_isporuke) LIKE '%".$search_string."%'");
			$builder->orWhere("UCASE(Orders.broj_ponude) LIKE '%".$search_string."%'");
			$builder->orWhere("UCASE(Orders.broj_projekta) LIKE '%".$search_string."%'");
			$builder->orWhere("UCASE(Orders.napomena) LIKE '%".$search_string."%'");
			$total_filtered_records = $builder->getQuery()->execute()->count();
		}
		else $total_filtered_records = $total_records;
		*/

	}
	
}