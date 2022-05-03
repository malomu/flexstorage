<?php

class Application_Model_DbTable_Box extends Zend_Db_Table_Abstract
{

    protected $_name = 'Box';
    protected $_primary = 'boxID';
    protected $_dependentTables = array('Application_Model_DbTable_Item');

}

