<?php

class Application_Form_ItemCreate extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        // 
        $this->addElement('text', 'iteTitle', array(
            'label'      => 'Title: ',
            'required'   => true,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 100)))
        ));
        
        // 
        $this->addElement('textarea', 'iteDescription', array(
            'label'      => 'Beschreibung: ',
            'required'   => true,
            'rows'       => 3,
            'validators' => array(array('validator' => 'StringLength', 'options' => array(0, 500)))
        ));

        // Kategorie Drop-Down | @ML-ToDo 211207 - Auswahl dynamisch anlegen
        $itemCat = new Application_Model_CategoryMapper();
        
        $Kategorie_type = $this->createElement('select', 'catID')->setLabel('Kategorie')->setRequired(true);
        $Kategorie_type ->addMultiOption('', 'Bitte wählen');
        foreach ($itemCat->fetchAll() as $x){
            $Kategorie_type ->addMultiOption($x->getCatID(), $x->getCatName());
        }
        $this->addElement($Kategorie_type);
     
        // Box Drop-Down | @ML-ToDo 211207 - Auswahl dynamisch anlegen
        $itemBox = new Application_Model_BoxMapper();
        
        $box_type = $this->createElement('select', 'boxID')->setLabel('Box')->setRequired(true);
        $box_type   ->addMultiOption('', 'Bitte wählen');
        foreach ($itemBox->fetchAll() as $x){
            $box_type ->addMultiOption($x->getBoxID(), $x->getBoxNo());
        }
        $this->addElement($box_type);
        
        // Submit-Button 
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Neues Item anlegen',
        ));
    }


}

