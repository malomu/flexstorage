<?php

class Application_Model_ItemMapper
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
            $this->setDbTable('Application_Model_DbTable_Item');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Item $item)
    {
        $data = array(
            'iteTitle' => $item->getIteTitle(),
            'iteDescription' => $item->getIteDescription(),
            'catID' => $item->getCatID(),
            'boxID' => $item->getBoxID(),            
        );
        
        if (null === ($id = $item->getIteID())) {
            unset($data['iteID']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('iteID = ?' => $id));
        }
    }
    
    public function find($iteID, Application_Model_Item $item)
    {
        $result = $this->getDbTable()->find($iteID);
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();
        
        // @ML-220119 Verknuepfung von der Tabelle "Item" zu den Tabellen "Category" und "Box"
        $boxRow = $row->findParentRow('Application_Model_DbTable_Box');
        $catRow = $row->findParentRow('Application_Model_DbTable_Category');
        
        $item->setIteID($row->iteID)
        ->setIteTitle($row->iteTitle)
        ->setIteDescription($row->iteDescription)
        ->setCatID($row->catID)
        ->setBoxID($row->boxID)
        
        // @ML-220119 Verknuepfung von der Tabelle "Item" zu den Tabellen "Category" und "Box"
        ->setCatName($catRow->catName)
        ->setBoxNo($boxRow->boxNo)
        ->setBoxPlace($boxRow->boxPlace);                        
    }
    
    public function fetchAll()
    {                                
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Item();
            $entry->setIteID($row->iteID)
            ->setIteTitle($row->iteTitle)
            ->setIteDescription($row->iteDescription)
            ->setCatID($row->catID)
            ->setBoxID($row->boxID);     
            
            /* 
             * @ML-ToDo Verknuepfung zu den Tabellen "Category" und "Box"
             */
            $catRow = $row->findParentRow('Application_Model_DbTable_Category');
            $entry->catName = $catRow->catName;

            $boxRow = $row->findParentRow('Application_Model_DbTable_Box');
            $entry->boxNo = $boxRow->boxNo;
            $entry->boxPlace = $boxRow->boxPlace;            
            
            $entries[] = $entry;
        }                              
        
        return $entries;
    }
    
}

