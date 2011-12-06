<?php

final class Biblioteca_Auth_Application {

	protected $_tabela;
	protected $_campoUsuario;
	protected $_campoSenha;
	protected $_tratamento;
	protected $_instancia;
	
	public function getInstancia() {
		return $this->_instancia;
	}

	public function setInstancia($_instancia) {
		$this->_instancia = $_instancia;
	}

	public function getTabela() {
		return $this->_tabela;
	}

	public function setTabela($_tabela) {
		$this->_tabela = $_tabela;
	}

	public function getCampoUsuario() {
		return $this->_campoUsuario;
	}

	public function setCampoUsuario($_campoUsuario) {
		$this->_campoUsuario = $_campoUsuario;
	}

	public function getCampoSenha() {
		return $this->_campoSenha;
	}

	public function setCampoSenha($_campoSenha) {
		$this->_campoSenha = $_campoSenha;
	}

	public function getTratamento() {
		return $this->_tratamento;
	}

	public function setTratamento($_tratamento) {
		$this->_tratamento = $_tratamento;
	}

	private function _isValid()
	{
		if(empty($this->_campoSenha)){
			return false;
		}
		
		if(empty($this->_campoUsuario)){
			return false;
		}
		
		if(empty($this->_tabela)){
			return false;
		}
		
		if(empty($this->_tratamento)){
			return false;
		}
		
		return true;
	}
	
	public function autenticar($usuario, $senha)
	{
		
		if($this->_isValid()){
			return $this->_processar($usuario, $senha);
		}
		
		return false;
	}
	
	
	private function _processar($usuario, $senha)
	{
		$adapter = $this->_getAuthAdapter();

		$adapter->setIdentity($usuario);
		$adapter->setCredential($senha);
		
		$auth = Zend_Auth::getInstance();
		
		
		if(!empty($this->_instancia)){
			$auth->setStorage(new Zend_Auth_Storage_Session($this->getInstancia()));
		}
		
		$result = $auth->authenticate($adapter);
		
		if ($result->isValid()) {

			$user = $adapter->getResultRowObject();
			$auth->getStorage()->write($user);
		
			return true;
		
		}
		
		return false;
	}
	
	private function _getAuthAdapter() {
	
		$dbAdapter = Zend_Db_Table::getDefaultAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
	
		$authAdapter->setTableName($this->getTabela())
				    ->setIdentityColumn($this->getCampoUsuario())
					->setCredentialColumn($this->getCampoSenha())
					->setCredentialTreatment($this->getTratamento());
	
		return $authAdapter;
	}
	
}

?>