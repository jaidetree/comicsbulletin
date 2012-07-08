<?php
class ArticlesController extends Controller
{
    function show($article_type, $article_id, $article_slug)
    {
        $articles = new Articles(0, 1, array( 'where' => array( 'n.nid', '=', $article_id )));
        $article = new Article($articles->first());
        APP::$db->build_run_query(array(
            'update' => 'dr_node_counter',
            'fields' => array(
                'totalcount' => '`totalcount` + 1',
                'daycount' => '`daycount` + 1',
            ),
            'where' => "`nid` = $article->nid"
        ));

        return render('article', array( 'article' => $article ));
    }

    function comics()
    {
        $articles = Articles::comics(); 
        return render('articles', array( 'class' => 'comics', 'articles' => $articles, 'title' => 'Comic Articles' ) );
    }
    function tv()
    {
        $articles = Articles::tv(); 
        return render('articles', array( 'class' => 'tv', 'articles' => $articles, 'title' => 'T.V. Articles' ) );
    }
    function movies()
    {
        $articles = Articles::movies(); 
        return render('articles', array( 'class' => 'movies', 'articles' => $articles, 'title' => 'Film &amp; Movie Articles' ) );
    }    
    function games()
    {
        $articles = Articles::games(); 
        return render('articles', array( 'class' => 'games', 'articles' => $articles, 'title' => 'Gaming &amp; Interactive Articles' ) );
    }    
    function reviews()
    {
        $articles = new Articles(0, 10, array('where' => array( 'n.type', '=', 'review' )));
        return render('reviews', array( 'articles' => $articles ) );
    }
    function columns()
    {
        $columns = Columns::all();
        return render('columns', array( 'columns' => $columns ) );
    }
    function column($column_slug)
    {
        $articles = ColumnSeries::column_articles($column_slug);
        return render('articles', array( 'class' => 'columns', 'title' => $articles->column_title, 'articles' => $articles ) );
    }
    function interviews()
    {
        $articles = new Articles(0, 10, array('where' => array( 'n.type', '=', 'interview' )));
        return render('interviews', array( 'articles' => $articles ) );
    }
    function news()
    {
        $articles = new Articles(0, 20, array('where' => array( 'n.type', '=', 'news' )));
        return render('news', array( 'class' => 'news', 'title' => 'News', 'articles' => $articles ) );
    }
    function search($search_query)
    {
        $query = APP::$db->escape(strtolower(urldecode( $search_query )));
        $articles = new Articles(0, 10, array('where' => 
            "(LCASE(b.`body_value`) LIKE '%" . $query . "%' OR LCASE(n.`title`) LIKE '%" . $query . "%' OR LCASE(n.`type`) LIKE '%" . $query . "%')"
        ));
        return render('articles', array( 'class' => 'search', 'title' => 'Search &ldquo;' . strip_tags($search_query) . '&rdquo;', 'articles' => $articles ) );
    }
    function author($name)
    {
        $name = urldecode($name);
        $articles = Articles::author($name);
        return render('articles', array( 'class' => 'author', 'title' => 'Articles by ' . $name, 'articles' => $articles ) );
    }
}
?>
