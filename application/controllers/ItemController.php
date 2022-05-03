<?php

class ItemController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $item = new Application_Model_ItemMapper();
        $this->view->entries = $item->fetchAll();                 
    }

    public function showAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');
        
        // Lade Model
        $comment = new Application_Model_Item();
        $mapper = new Application_Model_ItemMapper();        
        // Lade Datensatz der selektierten ID in das Application_Model_Item()
        $mapper->find($id,$comment);                 
        
        /*
        $item = new Application_Model_DbTable_Item();
        $select = $item->select()->where('iteID = ?',$id);
        $itemRow = $item->fetchRow($select);
        
        // Verknuepfung zwischen Tabelle Item / Box | $boxRow->boxNo, $boxRow->boxPlace
        $boxRow = $itemRow->findParentRow('Application_Model_DbTable_Box');           
        
        // Verknuepfung zwischen Tabelle Item / Category | $catRow->catName
        $catRow = $itemRow->findParentRow('Application_Model_DbTable_Category');        
        */     
        
        /*
        // Lade Model Kategorie        
        $commentCat = new Application_Model_Category();
        $mapperCat = new Application_Model_CategoryMapper();
        // Lade Datensatz der selektierten ID in das Application_Model_Item()
        $mapperCat->find($comment->getCatID(),$commentCat);
        
        // Lade Model Box
        $commentBox = new Application_Model_Box();
        $mapperBox = new Application_Model_BoxMapper();
        // Lade Datensatz der selektierten ID in das Application_Model_Box()
        $mapperBox->find($comment->getBoxID(),$commentBox);      
        */
        
        // Übergebe Daten an View
        // $this->view->entry = $dataEntry;
        $this->view->entry = array('iteID'=>$comment->getIteID(),'iteTitle'=>$comment->getIteTitle(),'iteDescription'=>$comment->getIteDescription(),'catName'=>$comment->catName,'boxNo'=>$comment->boxNo,'boxPlace'=>$comment->boxPlace);
    }

    public function deleteinfoAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');
        
        // Lade Model
        $comment = new Application_Model_Item();
        $mapper = new Application_Model_ItemMapper();
        
        // Lade Datensatz der selektierten ID in das Application_Model_Item()
        $mapper->find($id,$comment);
        
        // Übergebe Daten an View
        // $this->view->entry = $dataEntry;
        $this->view->entry = array('iteID'=>$comment->getIteID(),'iteTitle'=>$comment->getIteTitle(),'iteDescription'=>$comment->getIteDescription(),'catID'=>$comment->getCatID(),'boxID'=>$comment->getBoxID());
    }

    public function deleteAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');        
        $recordDelInfo = '';
        
        // Ausgewaehlten Datensatz loeschen
        $table = new Application_Model_DbTable_Item();
        $where = $table->getAdapter()->quoteInto('iteID = ?', $id);
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
        $comment = new Application_Model_Item();
        $mapper = new Application_Model_ItemMapper();
        
        // Lade Datensatz der selektierten ID in das Application_Model_Flexstorage()
        $mapper->find($id,$comment);
        
        $dataEntry = array('iteID'=>$comment->getIteID(),'iteTitle'=>$comment->getIteTitle(),'iteDescription'=>$comment->getIteDescription(),'catID'=>$comment->getCatID(),'boxID'=>$comment->getBoxID());               
        
        $request = $this->getRequest();
        $form = new Application_Form_ItemEdit();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                // var_dump($form->getValues());
                
                $table = new Application_Model_DbTable_Item();
                $data = $form->getValues();
                $where = $table->getAdapter()->quoteInto('iteID = ?', $id);
                $table->update($data, $where);
                
                return $this->_helper->redirector('index');
            }
        }else{
            // uebergebe Daten an Formular
            $form->populate($dataEntry);
        }
        
        // Übergebe Daten an View
        $this->view->entry = $dataEntry;
        $this->view->form = $form;   
    }

    public function createAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_ItemCreate();
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Item($form->getValues());
                $mapper  = new Application_Model_ItemMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');
            }
        }
        
        $this->view->form = $form;
    }


}











