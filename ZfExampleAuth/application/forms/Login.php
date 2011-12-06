<?php

class Application_Form_Login extends Zend_Form
{

	private $_decorator = array('ViewHelper','Description','Errors');

    public function init()
    {
        $usuario = new Zend_Form_Element_Text("usuario");
        $usuario->setLabel("Usuário:")
        		->addErrorMessage("Campo usuário é obrigatorio")
        		->addDecorators($this->_decorator)
        		->setRequired();
        
        $senha = new Zend_Form_Element_Password("senha");
        $senha->setLabel("Senha:")
        	  ->addErrorMessage("Campo senha é obrigatorio")
        	  ->addDecorators($this->_decorator)
        	  ->setRequired();
        
        $submit = new Zend_Form_Element_Submit("submit");
        $submit->setLabel("Entrar");
        
        $this->setDecorators(array(
        		'FormElements',
        		array('HtmlTag',array('tag'=>'div')),
        		array('Form',array('class'=>'style'))
        ));
        
        $this->addElements(array($usuario, $senha, $submit));
    }


}

