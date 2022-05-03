<?php

class Application_Form_BoxCreate extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        $this->addElement('text', 'boxNo', array(
            'label'      => 'Nr: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));

        $this->addElement('text', 'boxWidth', array(
            'label'      => 'Breite: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));

        $this->addElement('text', 'boxHeight', array(
            'label'      => 'Höhe: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        $this->addElement('text', 'boxDepth', array(
            'label'      => 'Tiefe: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));

        $this->addElement('text', 'boxPlace', array(
            'label'      => 'Ort: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));

        $this->addElement('text', 'boxCreateDate', array(
            'label'      => 'Anlage-Datum: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        $this->addElement('text', 'boxParentBoxID', array(
            'label'      => 'Übergeordnete Box: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
                
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Neue Box anlegen',
        ));
    }


}

