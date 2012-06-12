<?php
class Pages extends Controller
{
    function home()
    {
        echo "<pre>";
        $articles = new Articles(0, 10);

        echo "<pre>";
        foreach( $articles->all() as $article )
        {
            print_r( $article );
        }
    }
}
?>
