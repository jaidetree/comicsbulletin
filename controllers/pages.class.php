<?php
class PagesController extends Controller
{
    function home()
    {
        $articles = new Articles(0, 10);
        $columns = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'column' ) ));
        $reviews = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'review' ) ));
        $interviews = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'interview' ) ));
        $news = new Articles(0, 6, array( 'where' => array( 'n.type', '=', 'news' ) ));
        return render('home', array( 
            'articles' => $articles, 
            'reviews' => $reviews,
            'interviews' => $interviews,
            'news' => $news,
            'columns' => $columns ));
    }
    function archive()
    {
        $articles = new Articles(0, 50);
        return render('archive', array( 'articles' => $articles ) );
    }
    function podcasts()
    {
        $articles = new Articles(0, 10, array('where' => array( 'n.type', '=', "'podcast_feed'" )));
        return render('podcasts', array( 'class' => 'columns', 'title' => 'Columns', 'articles' => $articles ) );
    }
}
?>
