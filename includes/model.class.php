<?php 
class Model
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
            $this->_data[] = $row;
            $this->count++;
        }
    }

    public function all()
    {
        return $this->_data;
    }

    public function have_rows()
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
        $row = $this->_data[ $this->index ];
        $this->index++;

        return $row;
    }
}
?>
