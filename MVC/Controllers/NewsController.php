<?php

include_once ROOT. 'mvc/models/News.php';

class NewsController
{
    public function actionIndex() // список новостей
    {
        $newsList = array();
        $newsList = News::getNewsLis();

        require_once (ROOT. '/vievs/news/index.php');
        return true;

    }

    public function actionViev() // одна новость
    {

       if ($id) {

           $newsItem = News::getNewsItemById($id);

           echo '<pre>';
           print_r($newsItem);
           echo '<pre>';

           echo 'actionView';
       }

    }


}