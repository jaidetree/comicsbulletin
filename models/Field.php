<?php 
class Field extends Manager
{
    var $field_name = "";

    public function __construct($field_name, $nid)
    {
        $this->query = array(
            'select' => 'field_' . $field_name . '_value as field_value',
            'from' => DB_PRE . 'field_data_field_' . $field_name,
            'where' => array( 'entity_id', '=', $nid )
        );
        $this->get();
        $this->field_name = $field_name;
    }

    public function get()
    {
        $result = APP::$db->build_run_query( $this->query );
        while( $row = APP::$db->fetch($result) )
        {
            $this->add_item( $row[ 'field_value' ] );
        }
    }
}
?>
