<?php
class Archive extends Manager
{
    var $model = "ArchiveModel";
    public function __construct($index=0, $count=20, $args=array())
    {
        $this->query = array(
            'select' => "COUNT(n.`nid`) as total, DATE_FORMAT(FROM_UNIXTIME(n.`created`), '%Y-%m') as archive_date, DATE_FORMAT(FROM_UNIXTIME(n.`created`), '%M') as archive_month, DATE_FORMAT(FROM_UNIXTIME(n.`created`), '%Y') as archive_year", 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'order' => "n.`created` DESC",
            'group' => "DATE_FORMAT(FROM_UNIXTIME(n.`created`), '%Y %M')",
        );

        if( $index > 0 && $count > 0 )
        {
            $this->query['limit'] = "$index,$count";
        }

        $this->get($args);
    } 

    public function get($args=array())
    {
        $this->query = array_merge($this->query, $args);
        $this->paginator = new ArchivePagination($this->query, array( 
            'select' => 'n.`nid`',
        ));
        if( $this->query['limit'] )
        {
            $this->query['limit'] = $this->paginator->limit();
        }
        $result = APP::$db->build_run_query($this->query);

        while($row = APP::$db->fetch($result))
        {
            $this->add_item( $row );
        }
    }
}
class ArchiveModel extends Model
{
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function url()
    {
        echo APP::url('pages.archive_date', array( $this->archive_date ));
    }
}
class ArchivePagination extends Pagination
{

    public function __construct($query, $args=array())
    {
        $rows_per_page = preg_replace( '/^.*,/', '', $query['limit']);
        $this->rows_per_page = $rows_per_page;
        $args['select'] = "COUNT(" . $args['select'] . ") as TOTAL";
        $args['limit'] = "";
        unset( $args['limit'], $query['limit'] );
        $this->query = array_merge( $query, $args );
        $result = APP::$db->build_run_query( $this->query );

        $this->total_rows = $result->num_rows;

        if( $rows_per_page > 0 )
        {
            $this->calculate();
        }
    }
}
?>
