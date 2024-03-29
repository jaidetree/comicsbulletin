<?php 
class Fields extends Manager
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
        if( $this->field_name == "column_series" )
        {
            print_r( $row );
            die();
        }
        while( $row = APP::$db->fetch($result) )
        {
            $this->add_item( $row[ 'field_value' ] );
        }
    }
}
?>
