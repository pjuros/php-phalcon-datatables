<?php

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
		#total count
		$sql = 'SELECT COUNT('.$_table_config['primary_column'].') AS total FROM '.$_table_config['db_tablename'];
		$result_set = $this->getReadConnection()->query($sql);
		$result_set->setFetchMode(Phalcon\Db::FETCH_ASSOC);
		$total_records = $result_set->fetchArray($result_set)['total'];
		
		#return data
		$ret = array(
			'draw' => $_post['draw'],
			'recordsTotal' => $total_records,
			'recordsFiltered' => $total_records,
			'data' => array()
		);
		
		#page data
		$sql = 'SELECT ';
		foreach ($_table_config['columns'] as $c) $sql .= $c['db_field'].' AS f'.$c['id'].',';
		$sql = rtrim($sql, ",");
		$sql .= ' FROM '.$_table_config['db_tablename'].' ORDER BY '.$_table_config['columns'][$_post['order'][0]['column']]['db_field']." ".$_post['order'][0]['dir'].' LIMIT '.$_post['length'].' OFFSET '.$_post['start'];
		$result_set = $this->getReadConnection()->query($sql);
		$result_set->setFetchMode(Phalcon\Db::FETCH_ASSOC);
		$data = $result_set->fetchAll();
		foreach ($data as $row) {
			$data_row = [];
			foreach ($_table_config['columns'] as $c) $data_row[]=$row['f'.	$c['id']];
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