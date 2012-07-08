<?php
class Pagination
{
    var $query;
    var $current_page = 0;
    var $total_pages = 0;
    var $total_rows = 0;
    var $rows_per_page = 20;
    var $index = 0;

    public function __construct($query, $args=array())
    {
        $rows_per_page = preg_replace( '/^.*,/', '', $query['limit']);
        $this->rows_per_page = $rows_per_page;
        $args['select'] = "COUNT(" . $args['select'] . ") as TOTAL";
        unset( $args['limit'], $query['args'] );
        $this->query = array_merge( $query, $args );
        $data = APP::$db->build_fetch_query( $this->query );

        $this->total_rows = $data['TOTAL'];
        if( $rows_per_page > 0 )
        {
            $this->calculate();
        }
    }

    protected function calculate()
    {
        $this->total_pages = ceil($this->total_rows / $this->rows_per_page);
        $this->current_page = (int)$_GET['page'];
        if( ! is_numeric( $this->current_page ) || $this->current_page > $this->total_pages || ! $this->current_page )
        {
            $this->current_page = 1;
        }
        $this->index = ($this->current_page - 1 ) * $this->rows_per_page;
    }

    public function limit()
    {
        return $this->index . ", {$this->rows_per_page}";
    }

    public function __toString()
    {
        return render( 'ui/_pagination', array( 
            'current_page' => $this->current_page, 
            'total_pages' => $this->total_pages  
        ));
    }
}
?>
