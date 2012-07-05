<?php
class ColumnLogos extends Manager
{
    public function __construct($nid)
    {
        $this->query = array(
            'select' => 'field_column_logo_image as field_value',
            'from' => DB_PRE . 'field_data_field_logo_image',
            'where' => "entity_id = '" . $nid . "'" 
        );
        $this->get();
    }
}
?>
