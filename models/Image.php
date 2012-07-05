<?php 
class Image extends Manager
{
    public function __construct($image_id)
    {
        $this->query = array(
            'select' => '*',
            'from' => DB_PRE . 'file_managed',
            'where' => array( 'fid', '=', $image_id )
        );
        $this->get();
    }

    public function get()
    {
        $result = APP::$db->build_run_query( $this->query );
        //print_r( APP::$db->sql );
        while( $row = APP::$db->fetch($result) )
        {
            $this->add_item( $this->process($row['uri']) );
        }
    }

    public function process($uri)
    {
        return APP::drupal_url( APP::cfg('dr', 'file_path') . preg_replace('#[a-z]+://#', '', $uri) );
    }
}
?>
