<?php

class DataController extends ControllerBase
{

    public function indexAction()
    {
    	
    }
    
    public function table1Action()
    {
    	$this->view->disable();
    	if ($this->request->isAjax() == true) {
    		$response = new \Phalcon\Http\Response();
    		$response->setContentType('application/json', 'UTF-8');
    		$db_data = new Data();
    		$response->setContent($db_data->get_table_data_json($this->request->getPost(), $this->config->table_1->toArray()));
    		return $response;
    	}
    }

}