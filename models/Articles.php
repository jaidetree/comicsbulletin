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
            /** 
             * REVIEWS
             *
             * Get all the data associated with reviews.
             * Really nice db structure there drupal...
             */
            if( $row['type'] == "review" )
            {
                /**
                 * Reviewer Field
                 */
                $reviewer = APP::$db->build_fetch_query(array(
                    'select' => 'field_reviewer_value',
                    'from' => DB_PRE . 'field_data_field_reviewer',
                    'where' => array( 'entity_id', '=', $row['nid'] )
                ));

                print_r( APP::$db->sql );
                $row['author'] = $reviewer['field_reviewer_value'];
            }
            $this->_data[] = $row;
            $this->count++;
        }
    }

}
?>
