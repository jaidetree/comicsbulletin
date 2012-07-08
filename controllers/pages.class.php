<?php
class PagesController extends Controller
{
    function home()
    {
        $articles = new Articles(0, 6);
        $columns = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'column' ) ));
        $reviews = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'review' ) ));
        $interviews = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'interview' ) ));
        $news = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'news' ) ));
        $featured = new Rotator(0, 5);
        return render('home', array( 
            'featured' => $featured,
            'articles' => $articles, 
            'reviews' => $reviews,
            'interviews' => $interviews,
            'news' => $news,
            'columns' => $columns ));
    }
    function archive()
    {
        $archives = new Archive(0, 0);
        return render('archives', array( 'archives' => $archives ) );
    }
    function archive_date($date)
    {
        $articles = new Articles(0, 20, array(
            'where' => "DATE_FORMAT(FROM_UNIXTIME(n.`created`), '%Y-%m') = '" . APP::$db->escape( $date ) . "'" 
        ));
        return render('archive', array( 'articles' => $articles , 'archive_date' => $date) );
    }
    function podcasts()
    {
        $articles = new Articles(0, 0, array('where' => array( 
            'b.body_value', 'LIKE', '%.mp3%' )));
        return render('podcasts', array( 'class' => 'columns', 'title' => 'Columns', 'articles' => $articles ) );
    }
}
?>
