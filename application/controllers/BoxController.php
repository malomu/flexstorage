<?php

class BoxController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $box = new Application_Model_BoxMapper();
        $this->view->entries = $box->fetchAll();
    }

    public function showAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');
        
        // Lade Model
        $comment = new Application_Model_Box();
        $mapper = new Application_Model_BoxMapper();        
        // Lade Datensatz der selektierten ID in das Application_Model_Box()
        $mapper->find($id,$comment);

        // Box-Parent-Anzeige
        $commentBoxPar = new Application_Model_Box();
        $mapperBoxPar = new Application_Model_BoxMapper();
        // Lade Datensatz der selektierten ID in das Application_Model_Box()
        $mapperBoxPar->find($comment->getBoxParentBoxID(),$commentBoxPar);
        
        // Übergebe Daten an View
        // $this->view->entry = $dataEntry;
        $this->view->entry = array('boxID'=>$comment->getBoxID(),'boxNo'=>$comment->getBoxNo(),'boxWidth'=>$comment->getBoxWidth(),'boxHeight'=>$comment->getBoxHeight(),'boxDepth'=>$comment->getBoxDepth(),'boxPlace'=>$comment->getBoxPlace(),'boxCreateDate'=>$comment->getBoxCreateDate(),'boxParentBoxNo'=>$commentBoxPar->getBoxNo());
    }

    public function deleteinfoAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');
        
        // Lade Model
        $comment = new Application_Model_Box();
        $mapper = new Application_Model_BoxMapper();
        
        // Lade Datensatz der selektierten ID in das Application_Model_Box()
        $mapper->find($id,$comment);
        
        // Übergebe Daten an View
        // $this->view->entry = $dataEntry;
        $this->view->entry = array('boxID'=>$comment->getBoxID(),'boxNo'=>$comment->getBoxNo(),'boxWidth'=>$comment->getBoxWidth(),'boxHeight'=>$comment->getBoxHeight(),'boxDepth'=>$comment->getBoxDepth(),'boxPlace'=>$comment->getBoxPlace(),'boxCreateDate'=>$comment->getBoxCreateDate(),'boxParentBoxID'=>$comment->getBoxParentBoxID());
    }

    public function deleteAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');        
        $recordDelInfo = '';
        
        // Ausgewaehlten Datensatz loeschen
        $table = new Application_Model_DbTable_Box();
        $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
        $table->delete($where);
        
        $recordDelInfo = 'Der Datensatz wurde erfolgreich gel&ouml;scht!';
        
        // Übergebe Daten an View
        $this->view->entry = array('recordDelInfo'=>$recordDelInfo);
    }

    public function editAction()
    {
        // Hole ID
        $id = $this->getRequest()->getParam('id');
        
        // Lade Model
        $comment = new Application_Model_Box();
        $mapper = new Application_Model_BoxMapper();
        
        // Lade Datensatz der selektierten ID in das Application_Model_Box()
        $mapper->find($id,$comment);
        // ,'boxCreateDate'=>$comment->getBoxCreateDate()
        $dataEntry = array( 'boxID'=>$comment->getBoxID(),
                            'boxNo'=>$comment->getBoxNo(),
                            'boxWidth'=>$comment->getBoxWidth(),
                            'boxHeight'=>$comment->getBoxHeight(),
                            'boxDepth'=>$comment->getBoxDepth(),
                            'boxPlace'=>$comment->getBoxPlace(),
                            'boxParentBoxID'=>$comment->getBoxParentBoxID());
        
        $request = $this->getRequest();
        $form = new Application_Form_BoxEdit();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                              
                $table = new Application_Model_DbTable_Box();

                // Box-No
                $dataUpd = array('boxNo' => $form->getValue('boxNo'));
                $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                $table->update($dataUpd, $where);

                // Uebergeordnete Box
                $dataUpd = array('boxParentBoxID' => $form->getValue('boxParentBoxID'));
                $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                $table->update($dataUpd, $where);
                
                // Box-Breite
                if($form->getValue('boxWidth') > 0){
                    $dataUpd = array('boxWidth' => $form->getValue('boxWidth'));
                    $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                    $table->update($dataUpd, $where);
                }else{                    
                    $dataUpd = array('boxWidth' => 0);
                    $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                    $table->update($dataUpd, $where);                    
                }
                             
                // Box-Hoehe
                if($form->getValue('boxHeight') > 0){
                    $dataUpd = array('boxHeight' => $form->getValue('boxHeight'));
                    $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                    $table->update($dataUpd, $where);
                }else{
                    $dataUpd = array('boxHeight' => 0);
                    $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                    $table->update($dataUpd, $where);
                }

                // Box-Tiefe
                if($form->getValue('boxDepth') > 0){
                    $dataUpd = array('boxDepth' => $form->getValue('boxDepth'));
                    $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                    $table->update($dataUpd, $where);
                }else{
                    $dataUpd = array('boxDepth' => 0);
                    $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                    $table->update($dataUpd, $where);
                }
                
                /*
                $table = new Application_Model_DbTable_Box();
                $data = $form->getValues();
                $where = $table->getAdapter()->quoteInto('boxID = ?', $id);
                $table->update($data, $where);
                */
                
                return $this->_helper->redirector('index');                              
            }
        }else{
            // Uebergebe Daten an Formular
            $form->populate($dataEntry);
        }
        
        // Uebergebe Daten an View
        $this->view->entry = $dataEntry;
        $this->view->form = $form;   
    }

    public function createAction()
    {                
        $request = $this->getRequest();
        $form    = new Application_Form_BoxCreate();                
        
        if ($this->getRequest()->isPost()) {                                   
            
            if ($form->isValid($request->getPost())) {
                
                // @ML-ToDo Box-Nr muss eindeutig sein!
                var_dump($form->getValue('boxNo'));
                
                /*
                // $id = $this->getRequest()->getParam('id');
                $id = $form->getValue('boxNo');
                
                // Lade Model
                $comment = new Application_Model_Box();
                $mapper = new Application_Model_BoxMapper();
                
                // Lade Datensatz der selektierten ID in das Application_Model_Box()
                $mapper->find($id,$comment);
                // ,'boxCreateDate'=>$comment->getBoxCreateDate()
                $dataEntry = array( 'boxID'=>$comment->getBoxID(),
                    'boxNo'=>$comment->getBoxNo(),
                    'boxWidth'=>$comment->getBoxWidth(),
                    'boxHeight'=>$comment->getBoxHeight(),
                    'boxDepth'=>$comment->getBoxDepth(),
                    'boxPlace'=>$comment->getBoxPlace(),
                    'boxParentBoxID'=>$comment->getBoxParentBoxID());
                
                var_dump($dataEntry);
                */
                
                
                /*
                $box = new Application_Model_BoxMapper();
                $this->view->entries = $box->find();
                
                $comment = new Application_Model_Box($form->getValues());
                $mapper  = new Application_Model_BoxMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
                */
            }
        }
        
        $this->view->form = $form;     
    }


}











