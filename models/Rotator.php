<?php
class Rotator extends Manager
{
    var $model = "Article";
    public function __construct($index=0, $count=5, $args=array())
    {
        $this->query = array(
            'select' => 'n.*, n.`type` as node_type', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_field_headline_boolean' => 'h'),
                    'on' => 'h.`entity_id` = n.`nid`',
                    'select' => 'h.field_headline_boolean_value',
                    'type' => 'inner'
                ), 
            ),
            'order' => "n.`created` DESC",
            'limit' => "$index,$count",
            'where' => array(
                'h.field_headline_boolean_value', '=', 1
            ),
        );

        $this->get($args);
    }

    public function get($args=array())
    {
        $this->query = array_merge($this->query, $args);
        $result = APP::$db->build_run_query( $this->query );

        while( $row = APP::$db->fetch($result) )
        {
            $article = new Articles(0, 1, array( 'where' => array( 'n.nid', '=', $row['nid'] ) ));
            $row = array_merge($row, $article->first());

            $data = new ImageFields('slider_image', $row['nid']);
            $row['slider_image'] = $data->first();
            $data = new Fields('slider_caption', $row['nid']);
            $row['slider_caption'] = $data->first();


            $this->add_item( $row );
        }
    }
}
?>
