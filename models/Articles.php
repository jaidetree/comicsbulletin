<?php
class Articles extends Manager
{
    var $model = 'Article';
    public function __construct($index=0, $count=10, $model = "", $args = array())
    {
        $this->query = array(
            'select' => 'n.*', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value, b.body_summary'
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
                $row['author'] = $data->all();

                /**
                 * Logo
                 */
                $data = new Field('column_series', $row['nid']);
                $row['column_series'] = $data->first();

                /**
                 * Column Logo
                 */
            }
            /**
             * Interview Data
             */
            elseif( $row['type'] == "interview" )
            {

                $data = new Field("interviewer", $row['nid']);
                $row['author'] = $data->all();

                $data = new Field("interviewee", $row['nid']);
                $row['interviewee'] = $data->all();
                
                $data = new Field("interview_type", $row['nid']);
                $row['type'] = $data->first();

            }
            /**
             * News
             */
            elseif( $row['type'] == "news" )
            {
                $data = new Field("news_type", $row['nid']);
                $row['type'] = $data->first();
            }
            $this->_data[] = $row;
            $this->count++;
        }
    }

}
class Article extends Model
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function author()
    {
        echo join(', ', (array)$this->author);
    }

    public function the_summary($length)
    {
        if( $this->body_summary )
        {
            echo $this->body_summary;
            return;
        }

        $words = explode( ". ", $this->body_value );

        echo implode( ". ", array_slice( $words, 0, $length ) ) . ".";

    }
}
?>
