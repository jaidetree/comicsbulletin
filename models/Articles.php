<?php
class Articles extends Model
{
    public function __construct($index=0, $count=10, $args = array())
    {
        $this->query = array(
            'select' => 'n.*', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value'
                ),
            ),
            'limit' => "$index,$count",
        );

        $this->get($args);
    }

    public function get($args=array())
    {
        $query = array_merge($this->query, $args);
        $result = APP::$db->build_run_query($query);

        while( $row = APP::$db->fetch($result) )
        {
            if( $row['type'] == "review" )
            {

            }
            $this->_data[] = $row;
            $this->count++;
        }
    }

}
?>
