<?php 
class ImageFields extends Manager
{
    var $field_name = "";

    public function __construct($field_name, $nid)
    {
        $this->query = array(
            'select' => '*',
            'from' => DB_PRE . 'field_data_field_' . $field_name,
            'where' => array( 'entity_id', '=', $nid )
        );
        $this->field_name = $field_name;
        $this->get();
    }

    public function get()
    {
        $result = APP::$db->build_run_query( $this->query );
        while( $row = APP::$db->fetch($result) )
        {
            $image = new Image($row[ 'field_' . $this->field_name . '_fid' ]);
            $this->add_item( $image->first() );
        }
    }
}
?>
