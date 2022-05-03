<?php

class CategoryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $category = new Application_Model_CategoryMapper();
        $this->view->entries = $category->fetchAll();
    }

    public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Category();               
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {                    
                $comment = new Application_Model_Category($form->getValues());
                $mapper  = new Application_Model_CategoryMapper();
                $mapper->save($comment);
                return $this->_helper->redirector('index');                               
            }
        }
        
        $this->view->form = $form;
    }

    public function showAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');               
                       
        // Lade Model
        $comment = new Application_Model_Category();
        $mapper = new Application_Model_CategoryMapper();                        
        // Lade Datensatz der selektierten ID in das Application_Model_Category()
        $mapper->find($id,$comment);
        
        // Übergebe Daten an View
        // $this->view->entry = $dataEntry;
        $this->view->entry = array('catID'=>$comment->getCatID(),'catName'=>$comment->getCatName(),'catDescription'=>$comment->getCatDescription());
        
        // DEBUGGING-Ausgabe
        // echo $comment->getCatName();  
        // $this->view->entries = $comment;
        // echo 'Kategorie: '; echo $comment->getCatName();
        
    }

    public function deleteinfoAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');                                                          
        
        // Lade Model
        $comment = new Application_Model_Category();
        $mapper = new Application_Model_CategoryMapper();
        
        // Lade Datensatz der selektierten ID in das Application_Model_Category()
        $mapper->find($id,$comment);               
        
        // Übergebe Daten an View        
        $this->view->entry = array('catID'=>$comment->getCatID(),'catName'=>$comment->getCatName(),'catDescription'=>$comment->getCatDescription());
    }

    public function deleteAction()
    {
        // Hole Id
        $id = $this->getRequest()->getParam('id');        
        $recordDelInfo = '';
        
        // Ausgewaehlten Datensatz loeschen        
        $table = new Application_Model_DbTable_Category();
        $where = $table->getAdapter()->quoteInto('catID = ?', $id);
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
        $comment = new Application_Model_Category();
        $mapper = new Application_Model_CategoryMapper();
        
        // Lade Datensatz der selektierten ID in das Application_Model_Category()
        $mapper->find($id,$comment);
                              
        $dataEntry = array('catID'=>$comment->getCatID(),'catName'=>$comment->getCatName(),'catDescription'=>$comment->getCatDescription());
        
        $request = $this->getRequest();
        $form = new Application_Form_CategoryEdit();
                               
        if ($this->getRequest()->isPost()) {   
            if ($form->isValid($request->getPost())) { 
                // var_dump($form->getValues());
                
                $table = new Application_Model_DbTable_Category();
                $data = $form->getValues();
                $where = $table->getAdapter()->quoteInto('catID = ?', $id);
                $table->update($data, $where);                

                return $this->_helper->redirector('index');       
            }
        }else{
            // übergebe Daten an Formular
            $form->populate($dataEntry);
        }
                        
        // Übergebe Daten an View        
        $this->view->entry = $dataEntry;
        $this->view->form = $form;        
    }

    public function updateAction()
    {
        // Hole ID
        $catID = $this->getRequest()->getParam('id');               
        
        // var_dump($this->getRequest());
        
        /*
        $name = $this->getRequest()->getParam('catName');
        $description = $this->getRequest()->getParam('catDescription');
        
        $table = new Application_Model_DbTable_Category();
        $data = array(
            'catName' => $name,
            'catDescription' => $description
        );
        $where = $table->getAdapter()->quoteInto('catID = ?', $id);
        $table->update($data, $where);
        */
               
        /*
        $comment = new Application_Model_Category(array('catName' => 'Paul', 'catDescription' => 'Paula'));
        $mapper  = new Application_Model_CategoryMapper();
        $mapper->save($comment);
        */
        
        // aktualisiert die aufrufenden Seite
        // return $this->_helper->redirector('index');        
    }


}













