<?php

class SiteController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->view->headTitle()->append("Acesso Restrito Site");
        $this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    }

    public function indexAction()
    {
    	//Mostra as informações do usuário logado!!!!!!!
    	$dados = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('site'));
    	$this->view->usuario = $dados->getIdentity();
    	
    	if(!$dados->hasIdentity()){
    		$this->_helper->redirector("login-site","index");
    	}
    	
    }
    
    public function logoutAction()
    {
    	$dados = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('site'));
    	$dados->clearIdentity();
    	
    	$this->_helper->redirector("login-site","index");
    }


}

