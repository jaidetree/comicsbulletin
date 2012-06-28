<?php
class Pages extends Controller
{
    function home()
    {
        $articles = new Articles(0, 10);
        return render('home', array( 'articles' => $articles ));
    }
}
?>
