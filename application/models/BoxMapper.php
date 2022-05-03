<?php

class Application_Model_BoxMapper
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
            $this->setDbTable('Application_Model_DbTable_Box');
        }
        return $this->_dbTable;
    }
    
    public function save(Application_Model_Box $box)
    {
        $data = array(
            'boxNo' => $box->getBoxNo(),
            'boxWidth' => $box->getBoxWidth(),
            'boxHeight' => $box->getBoxHeight(),
            'boxDepth' => $box->getBoxDepth(),
            'boxPlace' => $box->getBoxPlace(),
            'boxCreateDate' => $box->getBoxCreateDate(),
            'boxParentBoxID' => $box->getBoxParentBoxID(),
        );
        
        if (null === ($id = $box->getBoxID())) {
            unset($data['boxID']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('boxID = ?' => $id));
        }
    }
    
    public function find($boxID, Application_Model_Box $box)
    {
        $result = $this->getDbTable()->find($boxID);
        if (0 == count($result)) {
            return;
        }
        
        $row = $result->current();
        
        $box->setBoxID($row->boxID)
        ->setBoxNo($row->boxNo)
        ->setBoxWidth($row->boxWidth)
        ->setBoxHeight($row->boxHeight)
        ->setBoxDepth($row->boxDepth)
        ->setBoxPlace($row->boxPlace)
        ->setBoxCreateDate($row->boxCreateDate)
        ->setBoxParentBoxID($row->boxParentBoxID);
    }
    
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Box();
            $entry->setBoxID($row->boxID)
            ->setBoxNo($row->boxNo)
            ->setBoxWidth($row->boxWidth)
            ->setBoxHeight($row->boxHeight)
            ->setBoxDepth($row->boxDepth)
            ->setBoxPlace($row->boxPlace)
            ->setBoxCreateDate($row->boxCreateDate)
            ->setBoxParentBoxID($row->boxParentBoxID);
            $entries[] = $entry;
        }
        return $entries;
    }
    
}

