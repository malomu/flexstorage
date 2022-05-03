<?php

class Application_Model_DbTable_Item extends Zend_Db_Table_Abstract
{

    protected $_name = 'Item';
    protected $_primary = 'iteID';
    
    // @ML-220119 Verknuepfung von der Tabelle "Item" zu den Tabellen "Category" und "Box"
    protected $_referenceMap = array(
        'Box'         => array(
            'columns'       => 'boxID',
            'refTableClass' => 'Application_Model_DbTable_Box',
            'refColumns'    => 'boxID',
        ),
        'Category'  => array(
            'columns'       => 'catID',
            'refTableClass' => 'Application_Model_DbTable_Category',
            'refColumns'    => 'catID',
        ),
    );
    
}

