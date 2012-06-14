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
                 * Review Fields
                 */
                $reviewers = new Field('reviewer', $row['nid']);
                $row['author'] = $reviewers->all();

                $rating = new Field('review_rating', $row['nid']);
                $row['rating'] = $rating->first();

                $type = new Field('review_type', $row['nid']);
                $row['type'] = $type->first();
            }
            /**
             * Column Data
             */
            elseif( $row['type'] == "column" )
            {
                /**
                 * Columnist 
                 */
                $data = new Field('columnist', $row['nid']);
                $row['columnist'] = $data->all();

                /**
                 * Logo
                 */
                $data = new Field('column_series', $row['nid']);
                $row['column_series'] = $data->first();
            }
            $this->_data[] = $row;
            $this->count++;
        }
    }

}
?>
