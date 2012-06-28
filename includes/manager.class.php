<?php 
class Manager
{
    protected $query = array();
    protected $_data = array();
    protected $index = 0;
    protected $count = 0;

    public function get($args=array())
    {
        $query = array_merge($this->query, $args);
        APP::$db->build_run_query($query);

        while( $row = APP::$db->fetch() )
        {
            $this->add_item( $row );
        }
    }

    public function add_item($item)
    {
        $this->_data[] = $item;
        $this->count++;
    }

    public function all()
    {
        return $this->_data;
    }

    public function has_rows()
    {
        if( $this->count > 0 && $this->index < $this->count )
        {
            return true;
        }
        else
        {
            $this->reset_index();
            return false;
        }
    }

    public function reset_index()
    {
        $this->index = 0;
    }

    public function row()
    {
        $row = new $this->model( $this->_data[ $this->index ] );
        $this->index++;

        return $row;
    }

    public function first()
    {
        return $this->_data[0];
    }
}

?>
