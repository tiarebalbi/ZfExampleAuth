<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initApplication()
	{
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->registerNamespace(array('Biblioteca_'));
	}
	
	
	protected function _initPlaceHorder()
	{
		$this->bootstrap("view");
		$view = $this->getResource("view");
		$view->headLink()->appendStylesheet($view->baseUrl("css/default.css"));
	}
	
	
	protected function _initConnection()
	{
		$config = new Zend_Config_Xml(APPLICATION_PATH. "/configs/database.xml", "production");
		
		try{
		
			$db = Zend_Db::factory($config->database);
			$db->getConnection();
		
			Zend_Db_Table_Abstract::setDefaultAdapter($db);
		
			$registry = Zend_Registry::getInstance();
			$registry->set('db', $db);
		
			return true;
		
		}catch( Exception $e){
		
			$this->setErro($e->getMessage());
		
			return false;
		}
	}
}

