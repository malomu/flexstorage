<?php

class Application_Form_BoxEdit extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
          
        /*
        var_dump($this->);
        
        $this->addElement('text', 'boxID', array(            
            // 'hidden' => 'true'
        ));
        */
        
        $this->addElement('text', 'boxNo', array(
            'label'      => 'Nr: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        $this->addElement('text', 'boxWidth', array(
            'label'      => 'Breite: ',            
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        $this->addElement('text', 'boxHeight', array(
            'label'      => 'Höhe: ',            
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        $this->addElement('text', 'boxDepth', array(
            'label'      => 'Tiefe: ',            
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        // Ablageort der Box
        $this->addElement('text', 'boxPlace', array(
            'label'      => 'Ort: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        // Anlage-Datum | @ML-ToDo Anlage-Datum pruefen
        $this->addElement('text', 'boxCreateDate', array(
            'label'      => 'Anlage-Datum: ',            
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));        
        
        // Box Drop-Down | @ML-ToDo Auswahlpruefen, es darf keine Endlosschleife entstehen             
        
        /*
        $dataUpd = array('boxWidth' => 0);
        $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
        $table->update($dataUpd, $where);  
        */
        /*
        $table = new Application_Model_DbTable_Box();
        $select = $table->select();
        $select->where('boxID = ?', 1);
        $rows = $table->fetchAll($select);
        
        $id = $this->getRequest()->getParam('id');
        var_dump($id);        
        */
                       
        $itemBox = new Application_Model_BoxMapper(); 
        $box_type = $this->createElement('select', 'boxParentBoxID')->setLabel('Übergeordnete Box:');
        $box_type ->addMultiOption(0, 'Bitte wählen');
        foreach ($itemBox->fetchAll() as $x){
            // if($x->getBoxID() <> 1){
                $box_type ->addMultiOption($x->getBoxID(), $x->getBoxNo());
            // }            
        }
        $this->addElement($box_type);
        
        // Submit Button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Änderungen speichern',
        ));
    }


}

