<?php

class Application_Model_CategoryMapper
{

    protected $_dbTable;
    
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
    
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Category');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Category $category)
    {
        $data = array(
            'catName' => $category->getCatName(),
            'catDescription' => $category->getCatDescription(),            
        );
        
        if (null === ($id = $category->getCatID())) {
            unset($data['catID']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('catID = ?' => $id));
        }
    }
    
    public function find($id, Application_Model_Category $category)
    {                     
        $result = $this->getDbTable()->find($id);        
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();        
        
        $category->setCatID($row->catID)
        ->setCatName($row->catName)
        ->setCatDescription($row->catDescription);    
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Category();
            $entry->setCatID($row->catID)
            ->setCatName($row->catName)
            ->setCatDescription($row->catDescription);            
            $entries[] = $entry;
        }
        return $entries;
    }

}

