<?php
class Model
{
    private $_data = array();

    public function __construct($data=array())
    {
        $this->build_data( $data );
    }

    private function build_data($data_array)
    {
        foreach( (array)$data_array as $key => $value )
        {
            $this->$key = $value;
        }
    }

    public function __get($key)
    {
        return $this->_data[$key];
    }

    public function __set($key, $value)
    {
        $this->_data[ $key ] = $value;
    }


    public function the($key)
    {
        echo $this->_data[$key];
    }

    public function is_first()
    {
        if( $this->index == 0 )
        {
            return true;
        }
        return false;
    }
}
?>
