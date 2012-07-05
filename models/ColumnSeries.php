<?php
class ColumnSeries extends Manager
{
    var $model = 'ColumnModel';
    var $column_title = "";
    public function __construct($args=array())
    {
        $this->query = array(
            'select' => 's.field_column_series_value as title',
            'from' => array( DB_PRE . 'field_data_field_column_series' => 's' ),
            'joins' => array(
                array(
                    'type' => 'inner',
                    'select' => 'field_logo_image_fid',
                    'from' => array( DB_PRE . 'field_data_field_logo_image' => 'l' ),
                    'on' => 'l.`entity_id` = s.`entity_id`'
                ),
                array(
                    'type' => 'left',
                    'select' => 'f.uri',
                    'from' => array( DB_PRE . 'file_managed' => 'f' ),
                    'on' => 'f.`fid` = l.`field_logo_image_fid`'
                ),
            ),
            'group' => 's.field_column_series_value'
        );
        $this->get($args);
    }

    public static function column_articles($column_slug, $index=0, $count=10)
    {
        $column_title = ColumnSeries::get_column_title_by_slug($column_slug);
        $args = array(
            'select' => 'n.*, n.`type` as node_type', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value, b.body_summary'
                ), 
                array(
                    'from' => array(DB_PRE . 'node_counter' => 'c'),
                    'on' => 'c.`nid` = n.`nid`',
                    'select' => 'c.totalcount, c.daycount, c.timestamp as count_timestamp'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_column_series' => 's'),
                    'on' => 's.`entity_id` = n.`nid`',
                    'select' => 's.field_column_series_value',
                    'type' => 'inner'
                )
            ),
            'order' => 'n.`nid` DESC',
            'limit' => "$index,$count",
            'where' => "n.`type` = 'column' AND s.`field_column_series_value` = '$column_title'",
        );
                        
        $articles = new Articles(0, 10, $args);
        $articles->column_title = $column_title;

        return $articles;
    }

    public static function get_column_title_by_slug($column_slug)
    {
        foreach( Columns::all()->all() as $column )
        {
            if( $column['slug'] == $column_slug )
            {
                return $column['title'];
            }
        }
    }

    public static function get_column_by_slug($column_slug)
    {
        foreach( Columns::all()->all() as $column )
        {
            if( $column['slug'] == $column_slug )
            {
                return new ColumnModel($column);
            }
        }
    }

    public static function get_column_by_type($type)
    {
        $columns = array();
        $args = array(
            'select' => 's.field_column_series_value as title',
            'from' => array( DB_PRE . 'field_data_field_column_series' => 's' ),
            'joins' => array(
                array(
                    'type' => 'inner',
                    'select' => 't.field_column_type_value as column_type',
                    'from' => array( DB_PRE . 'field_data_field_column_type' => 't' ),
                    'on' => 't.`entity_id` = s.`entity_id`'
                ),
            ),
            'group' => 's.field_column_series_value',
            'where' => array( 't.field_column_type_value', '=', $type ),

        );
        $columns = new ColumnSeries($args);
        return $columns->all();
    }

    public function get($args=array())
    {
        $this->query = array_merge($this->query, $args);
        $result = APP::$db->build_run_query($this->query);

        while( $row = APP::$db->fetch($result) )
        {
            $row['slug'] = slugify( $row['title'] );
            $this->_data[] = $row;
            $this->count++;
        }
    }
}
class ColumnModel extends Model
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function logo()
    {
        echo APP::drupal_url( APP::cfg('dr', 'file_path') . preg_replace('#[a-z]+://#', '', $this->uri) );
    }
}

class Columns
{
    private static $instance;

    var $data = array();

    public static function init()
    {
        if( ! $instance )
        {
            $classname = __CLASS__;
            self::$instance = new $classname();
        }

        return self::$instance;
    }

    public static function all()
    {
        return self::init()->data;
    }

    public function __construct()
    {
        $this->data = new ColumnSeries();
    }
}
Columns::init();
?>
