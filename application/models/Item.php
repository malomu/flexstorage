<?php

class Application_Model_Item
{

    protected $_iteID;
    protected $_iteTitle;
    protected $_iteDescription;
    protected $_catID;    
    protected $_boxID;

    // @ML-220119 Verknuepfung von der Tabelle "Item" zu den Tabellen "Category" und "Box"
    protected $_boxNo;
    protected $_boxPlace;
    protected $_catName;
    
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Item property');
        }
        $this->$method($value);
    }
    
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid Item property');
        }
        return $this->$method();
    }
    
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }  
    
    
    /*
     * Box-ForeignKey
     **/
    public function setBoxID($boxID)
    {
        $this->_boxID = (int) $boxID;
        return $this;
    }
    
    public function getBoxID()
    {
        return $this->_boxID;
    }
    
    
    /*
     * Kategorie-ForeignKey
     **/
    public function setCatID($catID)
    {
        $this->_catID = (int) $catID;
        return $this;
    }
    
    public function getCatID()
    {
        return $this->_catID;
    }
    
    
    /*
     * Item-Beschreibung
     **/
    public function setIteDescription($iteDescription)
    {
        $this->_iteDescription = (string) $iteDescription;
        return $this;
    }
    
    public function getIteDescription()
    {
        return $this->_iteDescription;
    }
    
    
    /*
     * Item-Titel
     * */
    public function setIteTitle($iteTitle)
    {
        $this->_iteTitle = (string) $iteTitle;
        return $this;
    }
    
    public function getIteTitle()
    {
        return $this->_iteTitle;
    }
    
    
    /*
     * Item-ID Primary-Key
     **/
    public function setIteID($iteID)
    {
        $this->_iteID = (int) $iteID;
        return $this;
    }
    
    public function getIteID()
    {
        return $this->_iteID;
    }

    
    // @ML-220119 Verknuepfung von der Tabelle "Item" zu den Tabellen "Category" und "Box"
    // ANFANG
    public function getBoxNo() {
        return $this->_boxNo;
    }
    
    public function setBoxNo($boxNo) {
        $this->_boxNo = (string) $boxNo;
        return $this;
    }
    
    public function getBoxPlace() {
        return $this->_boxPlace;
    }
    
    public function setBoxPlace($boxPlace) {
        $this->_boxPlace = (string) $boxPlace;
        return $this;
    }
    
    public function getCatName() {
        return $this->_catName;
    }
    
    public function setCatName($catName) {
        $this->_catName = (string) $catName;
        return $this;
    }
    // ENDE    
}

