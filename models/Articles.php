<?php
class Articles extends Manager
{
    var $model = 'Article';
    var $paginator = null;
    public function __construct($index=0, $count=10, $args = array())
    {
        $this->query = array(
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
                    'select' => 'c.totalcount, c.daycount, c.timestamp as count_timestamp',
                    'type' => 'left'
                )
            ),
            'order' => "n.`created` DESC",
            'limit' => "$index,$count",
        );

        $this->get($args);
    }

    public static function comics($index=0, $count=10)
    {
        $query = array(
            'select' => 'n.*, n.`type` as node_type', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value, b.body_summary',
                    'type' => 'left'
                ), 
                array(
                    'from' => array(DB_PRE . 'node_counter' => 'c'),
                    'on' => 'c.`nid` = n.`nid`',
                    'select' => 'c.totalcount, c.daycount, c.timestamp as count_timestamp',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_column_type' => 'cn'),
                    'on' => 'cn.`entity_id` = n.`nid`',
                    'select' => 'cn.field_column_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_interview_type' => 'it'),
                    'on' => 'it.`entity_id` = n.`nid`',
                    'select' => 'it.field_interview_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_news_type' => 'nt'),
                    'on' => 'nt.`entity_id` = n.`nid`',
                    'select' => 'nt.field_news_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_review_type' => 'rt'),
                    'on' => 'rt.`entity_id` = n.`nid`',
                    'select' => 'rt.field_review_type_value',
                    'type' => 'left'
                ),
            ),
            'order' => 'n.`created` DESC',
            'limit' => "$index,$count",
            'where' => "cn.`field_column_type_value` = 'Comic Column'" .
                " OR it.field_interview_type_value = 'Comics Interview'" .
                " OR nt.field_news_type_value = 'Comics News'" .
                " OR rt.field_review_type_value = 'Comic Review'"
        );

        return new Articles($index, $count, $query);
    }       
    
    public static function tv($index=0, $count=10)
    {
        $query = array(
            'select' => 'n.*, n.`type` as node_type', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value, b.body_summary',
                    'type' => 'left'
                ), 
                array(
                    'from' => array(DB_PRE . 'node_counter' => 'c'),
                    'on' => 'c.`nid` = n.`nid`',
                    'select' => 'c.totalcount, c.daycount, c.timestamp as count_timestamp',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_column_type' => 'cn'),
                    'on' => 'cn.`entity_id` = n.`nid`',
                    'select' => 'cn.field_column_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_interview_type' => 'it'),
                    'on' => 'it.`entity_id` = n.`nid`',
                    'select' => 'it.field_interview_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_news_type' => 'nt'),
                    'on' => 'nt.`entity_id` = n.`nid`',
                    'select' => 'nt.field_news_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_review_type' => 'rt'),
                    'on' => 'rt.`entity_id` = n.`nid`',
                    'select' => 'rt.field_review_type_value',
                    'type' => 'left'
                ),
            ),
            'order' => 'n.`created` DESC',
            'limit' => "$index,$count",
            'where' => "cn.`field_column_type_value` = 'TV Column'" .
                " OR it.field_interview_type_value = 'TV Interview'" .
                " OR nt.field_news_type_value = 'TV News'" .
                " OR rt.field_review_type_value = 'TV Review'"
        );

        return new Articles($index, $count, $query);
    }                                      
    public static function movies($index=0, $count=10)
    {
        $query = array(
            'select' => 'n.*, n.`type` as node_type', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value, b.body_summary',
                    'type' => 'left'
                ), 
                array(
                    'from' => array(DB_PRE . 'node_counter' => 'c'),
                    'on' => 'c.`nid` = n.`nid`',
                    'select' => 'c.totalcount, c.daycount, c.timestamp as count_timestamp',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_column_type' => 'cn'),
                    'on' => 'cn.`entity_id` = n.`nid`',
                    'select' => 'cn.field_column_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_interview_type' => 'it'),
                    'on' => 'it.`entity_id` = n.`nid`',
                    'select' => 'it.field_interview_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_news_type' => 'nt'),
                    'on' => 'nt.`entity_id` = n.`nid`',
                    'select' => 'nt.field_news_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_review_type' => 'rt'),
                    'on' => 'rt.`entity_id` = n.`nid`',
                    'select' => 'rt.field_review_type_value',
                    'type' => 'left'
                ),
            ),
            'order' => 'n.`created` DESC',
            'limit' => "$index,$count",
            'where' => "cn.`field_column_type_value` = 'Movie Column'" .
                " OR it.field_interview_type_value = 'Movie Interview'" .
                " OR nt.field_news_type_value = 'Movie News'" .
                " OR rt.field_review_type_value = 'Movie Review'"
        );

        return new Articles($index, $count, $query);
    }                                      

    public static function games($index=0, $count=10)
    {
        $query = array(
            'select' => 'n.*, n.`type` as node_type', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value, b.body_summary',
                    'type' => 'left'
                ), 
                array(
                    'from' => array(DB_PRE . 'node_counter' => 'c'),
                    'on' => 'c.`nid` = n.`nid`',
                    'select' => 'c.totalcount, c.daycount, c.timestamp as count_timestamp',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_column_type' => 'cn'),
                    'on' => 'cn.`entity_id` = n.`nid`',
                    'select' => 'cn.field_column_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_interview_type' => 'it'),
                    'on' => 'it.`entity_id` = n.`nid`',
                    'select' => 'it.field_interview_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_news_type' => 'nt'),
                    'on' => 'nt.`entity_id` = n.`nid`',
                    'select' => 'nt.field_news_type_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_review_type' => 'rt'),
                    'on' => 'rt.`entity_id` = n.`nid`',
                    'select' => 'rt.field_review_type_value',
                    'type' => 'left'
                ),
            ),
            'order' => 'n.`created` DESC',
            'limit' => "$index,$count",
            'where' => "cn.`field_column_type_value` = 'Game Column'" .
                " OR it.field_interview_type_value = 'Game Interview'" .
                " OR nt.field_news_type_value = 'Game News'" .
                " OR rt.field_review_type_value = 'Game Review'"
        );

        return new Articles($index, $count, $query);
    }                                      
    public static function author($name, $index=0, $count=10)
    {
        $name = APP::$db->escape( strtolower( $name ) );
        $query = array(
            'select' => 'n.*, n.`type` as node_type', 
            'from' => array( DB_PRE . 'node' => 'n' ),
            'joins' => array(
                array(
                    'from' => array(DB_PRE . 'field_data_body' => 'b'),
                    'on' => 'b.`entity_id` = n.`nid`',
                    'select' => 'b.body_value, b.body_summary',
                    'type' => 'left'
                ), 
                array(
                    'from' => array(DB_PRE . 'field_data_field_columnist' => 'ac'),
                    'on' => 'ac.`entity_id` = n.`nid`',
                    'select' => 'ac.field_columnist_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_interviewer' => 'ai'),
                    'on' => 'ai.`entity_id` = n.`nid`',
                    'select' => 'ai.field_interviewer_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_reviewer' => 'ar'),
                    'on' => 'ar.`entity_id` = n.`nid`',
                    'select' => 'ar.field_reviewer_value',
                    'type' => 'left'
                ),
                array(
                    'from' => array(DB_PRE . 'field_data_field_guest_columnist' => 'ag'),
                    'on' => 'ag.`entity_id` = n.`nid`',
                    'select' => 'ag.field_guest_columnist_value',
                    'type' => 'left'
                ),
            ),
            'order' => 'n.`created` DESC',
            'limit' => "$index,$count",
            'where' => "LCASE(ac.`field_columnist_value`) = '$name'" .
                " OR LCASE(ai.`field_interviewer_value`) = '$name'" .
                " OR LCASE(ar.`field_reviewer_value`) = '$name'" .
                " OR LCASE(ag.`field_guest_columnist_value`) = '$name'"
        );

        return new Articles($index, $count, $query);
    }                                      

    public function get($args=array())
    {
        $this->query = array_merge($this->query, $args);
        $this->paginator = new Pagination($this->query, array( 
            'select' => 'n.`nid`',
        ));
        $this->query['limit'] = $this->paginator->limit();

        if( $this->query['where'] && is_array( $this->query['where'] ) )
        {
            array_push( $this->query['where'], 'AND', 'n.status', '=', '1' );
        }
        elseif ( $this->query['where'] && is_string( $this->query['where'] ) )
        {
            $this->query['where'] .= " AND n.`status` = 1";
        }
        elseif( ! $this->query['where'] )
        {
            $this->query['where'] = "n.`status` = 1";
        }

        $result = APP::$db->build_run_query($this->query);

        while( $row = APP::$db->fetch($result) )
        {
            if( ! $row['pub_date'] )
            {
                $row['pub_date'] = date( "F j, Y", $row['created'] );
            }
            /** 
             * REVIEWS
             *
             * Get all the data associated with reviews.
             * Really nice db structure there drupal...
             */
            if( $row['node_type'] == "review" )
            {
                /**
                 * Review Fields
                 */
                $reviewers = new Fields('reviewer', $row['nid']);
                $row['author'] = $reviewers->all();

                $rating = new Fields('review_rating', $row['nid']);
                $row['rating'] = $rating->first();

                $type = new Fields('review_type', $row['nid']);
                $row['type'] = $type->first();
            }
            /**
             * Column Data
             */
            elseif( $row['node_type'] == "column" )
            {
                /**
                 * Columnist 
                 */
                $data = new Fields('columnist', $row['nid']);
                $row['author'] = $data->all();

                /**
                 * Logo
                 */
                $data = new Fields('column_series', $row['nid']);
                $row['column_series'] = $data->first();

                $data = APP::$db->build_fetch_query(array( 
                    'select' => 'l.field_logo_image_fid', 
                    'from' => array( DB_PRE . 'field_data_field_logo_image' => 'l' ),
                    'joins' => array(
                        array(
                            'from' => array(DB_PRE . 'file_managed' => 'f'),
                            'on' => 'f.`fid` = l.`field_logo_image_fid`',
                            'select' => 'f.filename',
                            'type' => 'left'
                        )
                    ),
                    'where' => "LCASE(l.`field_logo_image_title`) LIKE LCASE('%" . $row['column_series'] . "%')",
                    'limit' => "1",
                ));

                if( $data )
                {
                    $row['logo_image'] = APP::drupal_url( APP::cfg('dr', 'file_path') .  'columns/' .preg_replace('#[a-z]+://#', '', $data['filename']) );
                }

            }
            /**
             * Interview Data
             */
            elseif( $row['node_type'] == "interview" )
            {

                $data = new Fields("interviewer", $row['nid']);
                $row['author'] = $data->all();

                $data = new Fields("interviewee", $row['nid']);
                $row['interviewee'] = $data->all();
                
                $data = new Fields("interview_type", $row['nid']);
                $row['type'] = $data->first();

            }
            /**
             * News
             */
            elseif( $row['node_type'] == "news" )
            {
                $data = new Fields("news_type", $row['nid']);
                $row['type'] = $data->first();
                $row['author'] = '';
            }


            $data = new ImageFields('image', $row['nid']);
            $row['image'] = $data->first();
            $data = new ImageFields('cover_image', $row['nid']);
            $row['cover_image'] = str_replace( ' ', '%20', $data->first() );

            if( ! $row['cover_image'] && $row['column_logo'] )
            {
                $row['cover_image'] = $row['column_logo'];
            }
            if( ! $row['cover_image'] && $row['image'] )
            {
                $row['cover_image'] = $row['image'];
            }

            $row['details'] = array();

            $this->get_field($row, 'colorist', 'first');
            $this->get_field($row, 'comic_editor', 'first');
            $this->get_field($row, 'comic_event', 'first');
            $this->get_field($row, 'comic_writer', 'first');
            $this->get_field($row, 'director', 'first');
            $this->get_field($row, 'game_platform', 'first');
            $this->get_field($row, 'game_studio', 'first');
            $this->get_field($row, 'game_title', 'first');
            $this->get_field($row, 'guest_columnist', 'first');
            $this->get_field($row, 'inker', 'first');
            $this->get_field($row, 'letterer', 'first');
            $this->get_field($row, 'movie_media', 'first');
            $this->get_field($row, 'movie_title', 'first');
            $this->get_field($row, 'penciller', 'first');
            $this->get_field($row, 'publisher', 'first');
            $this->get_field($row, 'studio', 'first');
            $this->get_field($row, 'tv_boxed_set', 'first');
            $this->get_field($row, 'tv_episode_number', 'first');
            $this->get_field($row, 'tv_episode_title', 'first');
            $this->get_field($row, 'tv_season_episode', 'first');
            $this->get_field($row, 'tv_season_number', 'first');
            $this->get_field($row, 'tv_series_title', 'first');

            $row['body_value'] = str_replace('"/main/', '"http://' . APP::cfg('dr', 'url_base'), $row['body_value']);

            if( ! $row['cover_image'] )
            {
                $src = preg_match("/\<img.*src=\"(.*)\".*/iU", $row['body_value'], $data);
                $row['cover_image'] = $data[1];
            }
            $this->_data[] = $row;
            $this->count++;
        }
    }

    function get_field(&$row, $field_name, $get_method)
    {
        $data = new Fields($field_name, $row['nid']);
        if( $get_method == "all" )
        {
            $value = $data->all();
        }
        else
        {
            $value = $data->first();
        }

        if( $value )
        {
            $row['details'][ $field_name ] = $value;
        }

    }

}
class Article extends Model
{
    var $controller = "articles.show";
    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function author($function=false)
    {
        $authors = (array)$this->author;
        foreach( $authors as $i => $author )
        {
            $url = APP::url('articles.author', array( urlencode(strtolower($author)) ));
            $authors[$i] = "<a href=\"$url\">" . $author . "</a>";
        }
        echo join(', ', $authors);
    }

    public function the_summary($length)
    {
        if( $this->body_summary )
        {
            echo preg_replace('/\s\s+/', '', $this->body_summary);
            return;
        }

        $this->body_value = preg_replace( "|<[^>]+>|U", " ", $this->body_value);

        $this->body_value = str_replace( "&nsbp;", " ", $this->body_value);

        $pos = strpos( $this->body_value, '.');
        $sentence = substr($this->body_value, 0, $pos + 1);

        while( preg_match('/( |\.)[a-zA-Z]\.$/U', $sentence ) )
        {
            $pos = strpos($this->body_value, '.', $pos + 2);
            $sentence = substr($this->body_value, 0, $pos + 1);
        } 

        $sentence = str_replace('&nbsp;', '', $sentence);
        $sentence = preg_replace('/\s\s+/', ' ', $sentence);

        echo $sentence;


    }

    public function the_interviewee()
    {
        echo join(", ", $this->interviewee);
    }

    public function url()
    {
        echo APP::url($this->controller, array( $this->node_type . (( $this->node_type != "news" ) ? 's' : '' ), $this->nid, slugify($this->title) ));
    }

    public function drupal_url()
    {
        echo APP::drupal_url( slugify($this->node_type) . (( $this->node_type != "news" ) ? 's/' : '/' ) . slugify( $this->title ) );
    }

    public function disqus_url()
    {
        echo APP::disqus_url( slugify($this->node_type) . (( $this->node_type != "news" ) ? 's/' : '/' ) . slugify( $this->title ) );
    }

    public function the_type($str_function=false)
    {
        $type = ucwords($this->type) . ' Article';

        if( $this->column_series )
        {
            $type .= ', ' . $this->column_series;
        }

        if( $str_function )
        {
            $type = $str_function( $type );
        }
        echo $type;
    }

    public function details()
    {
        $data = array();

        foreach( $this->details as $name => $value )
        {
            if( ! $value )
            {
                continue;
            }

            $name = str_replace('_', ' ', $name);
            $name = ucwords($name);
                

            $data[ $name ] = $value;
        }

        return $data;
    }

    public function rating_image()
    {
        $rating = $this->rating;
        $rating = str_replace('.', '-', $rating);
        $rating = '/static/images/ratings/stars' . $rating . '.png';

        echo $rating;
    }
}
?>
