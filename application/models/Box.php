<?php

class Application_Model_Box
{

    protected $_boxID;
    protected $_boxNo;
    protected $_boxWidth;
    protected $_boxHeight;
    protected $_boxDepth;
    protected $_boxPlace;
    protected $_boxCreateDate;
    protected $_boxParentBoxID;
    
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
            throw new Exception('Invalid box111 property');
        }
        $this->$method($value);
    }
    
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid box222 property');
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
     * Box-Uebergeordnete BoxID
     **/
    public function setBoxParentBoxID($boxParentBoxID)
    {
        $this->_boxParentBoxID = (int) $boxParentBoxID;
        return $this;
    }
    
    public function getBoxParentBoxID()
    {
        return $this->_boxParentBoxID;
    }
    
    
    /*
     * Box-Anlage-Datum
     **/
    public function setBoxCreateDate($ts)
    {
        $this->_boxCreateDate = $ts;
        return $this;
    }
    
    public function getBoxCreateDate()
    {
        return $this->_boxCreateDate;
    }
    
    
    /*
     * Box-Ort / Platz
     **/
    public function setBoxPlace($boxPlace)
    {
        $this->_boxPlace = (string) $boxPlace;
        return $this;
    }
    
    public function getBoxPlace()
    {
        return $this->_boxPlace;
    }
    
    
    /*
     * Box-Tiefe
     **/
    public function setBoxDepth($boxDepth)
    {
        $this->_boxDepth = (float) $boxDepth;
        return $this;
    }
    
    public function getBoxDepth()
    {
        return $this->_boxDepth;
    }
    
    
    /*
     * Box-Hoehe
     **/
    public function setBoxHeight($boxHeight)
    {
        $this->_boxHeight = (float) $boxHeight;
        return $this;
    }
    
    public function getBoxHeight()
    {
        return $this->_boxHeight;
    }
    
        
    /* 
     * Box-Breite
     **/
    public function setBoxWidth($boxWidth)
    {
        $this->_boxWidth = (float) $boxWidth;
        return $this;
    }
    
    public function getBoxWidth()
    {
        return $this->_boxWidth;
    }
    
    
    /*
     * Box-Nr
     * */
    public function setBoxNo($boxNo)
    {
        $this->_boxNo = (string) $boxNo;
        return $this;
    }
    
    public function getBoxNo()
    {
        return $this->_boxNo;
    }
    
    
    /*
     * Box-ID Primary-Key
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
    
}

