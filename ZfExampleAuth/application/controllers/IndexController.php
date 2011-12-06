<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->headTitle()->append("Página Inicial");
    }

    public function loginSiteAction()
    {
    	$this->view->headTitle()->append("Login do Site");
    	$form = new Application_Form_Login();
    	$this->view->form = $form;
    	
    	$this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    	
    	
    	if($this->getRequest()->isPost()){
    		
    		$data = $this->getRequest()->getPost();
    		
    		if($form->isValid($data)){
    			
    			$auth = new Biblioteca_Auth_Application();
    			$auth->setCampoSenha("senha");
    			$auth->setCampoUsuario("usuario");
    			$auth->setInstancia("site");
    			$auth->setTabela("tb_usuarios");
    			$auth->setTratamento("md5(?) AND grupo = 'site'");
    			
    			$validacao = $auth->autenticar($form->getValue("usuario"), $form->getValue("senha"));
    			
    			if($validacao){
    				$dados = Zend_Auth::getInstance()->getIdentity();
    				$this->_helper->flashMessenger->addMessage("Bem Vindo " . $dados->nome);
    				$this->_helper->redirector("index","site");
    			}else{
    				$this->_helper->flashMessenger->addMessage("Usuário ou Senha incorretos");
    				$this->_helper->redirector("login-site","index");
    			}
    			
    		}else{
    			$form->populate($data);
    		}
    		
    		
    	}
    	
    	
    }
    
    public function loginAdminAction()
    {
    	$this->view->headTitle()->append("Login do Administrador");
    	$form = new Application_Form_Login();
    	$this->view->form = $form;
    	
    	$this->view->notificacao = $this->_helper->flashMessenger->getMessages();
    	
    	
    	if($this->getRequest()->isPost()){
    	
    		$data = $this->getRequest()->getPost();
    	
    		if($form->isValid($data)){
    	
    			$auth = new Biblioteca_Auth_Application();
    			$auth->setCampoSenha("senha");
    			$auth->setCampoUsuario("usuario");
    			$auth->setInstancia("admin");
    			$auth->setTabela("tb_usuarios");
    			$auth->setTratamento("md5(?) AND grupo = 'admin'");
    	
    			$validacao = $auth->autenticar($form->getValue("usuario"), $form->getValue("senha"));
    	
    			if($validacao){
    				$dados = Zend_Auth::getInstance()->getIdentity();
    				$this->_helper->flashMessenger->addMessage("Bem Vindo " . $dados->nome);
    				$this->_helper->redirector("index","administrador");
    			}else{
    				$this->_helper->flashMessenger->addMessage("Usuário ou Senha incorretos");
    				$this->_helper->redirector("login-admin","index");
    			}
    	
    		}else{
    			$form->populate($data);
    		}
    	
    	
    	}
    }


}



