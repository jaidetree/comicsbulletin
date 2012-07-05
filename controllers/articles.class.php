<?php
class ArticlesController extends Controller
{
    function show($article_type, $article_id, $article_slug)
    {
        $article = new Articles(0, 1, array( 'where' => array( 'n.nid', '=', $article_id )));
        return render('article', array( 'article' => new Article($article->first()) ));
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
        $articles = new Articles(0, 10, array('where' => array( 'n.type', '=', 'news' )));
        return render('articles', array( 'class' => 'news', 'title' => 'News', 'articles' => $articles ) );
    }
}
?>
