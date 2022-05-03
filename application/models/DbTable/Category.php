<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'Category';
    protected $_primary = 'catID';
    protected $_dependentTables = array('Application_Model_DbTable_Item');

}

