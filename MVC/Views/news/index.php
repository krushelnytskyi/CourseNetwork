
<!-- Start Content -->


<?php foreach ($newsList as $newsItem):   ?>

<article class="post">
  <div class="row">
    <div class="col-md-4 col-sm-4"> <a href="single-event.html">
            <img src="http://placehold.it/600x400&amp;text=IMAGE+PLACEHOLDER" alt="" class="img-thumbnail"></a> </div>
         <div class="col-md-8 col-sm-8">
             <h3><a href="#">  <?php echo $newsItem ['title'];   ?></a></h3>
                    <span class="post-meta meta-data"> <span><i class="fa fa-calendar">
                            </i> <?php echo $newsItem ['date']; ?></span>
          <span>
              <i class="fa fa-archive"></i> <a href="#">Uncategorized</a></span> <span><a href="#">
                 <i class="fa fa-comment"></i> 12</a></span>
         </span>
      <p> <?php echo $newsItem ['short_content'];   ?></p>
      <p><a href="/news/<?php echo $newsItem ['id'];?>" class="btn btn-primary">Continue reading
              <i class="fa fa-long-arrow-right"></i></a></p>
    </div>
  </div>
</article>

<?php endforeach; ?>


<ul class="pagination">
  <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
  <li class="active"><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
</ul>
</div>