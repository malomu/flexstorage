<?php

class Application_Form_CategoryEdit extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        // catName Element
        $this->addElement('text', 'catName', array(
            'label'      => 'Name: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        // catDescription Element
        $this->addElement('textarea', 'catDescription', array(
            'label'      => 'Beschreibung: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Änderungen speichern',
        ));
    }


}

