<?php include ROOT . '/views/layouts/header.php';?>

<section>



            <div id="myCarousel" class="carousel  slide">
                <!-- Dot Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                </ol>
                <!-- Items -->
                <div class="carousel-inner">
<?php $i = 0; foreach ($events as $event): ?>
                    <div class="<?php echo ($i == 0)?' active':''?> item">
                        <a href="/event/<?=$event['event_id'];?>"><img  class="img-responsive img-carousel" src="../..<?=$event['event_bg_img'];?>" alt="<?=$event['event_name'];?>"></a>
                    </div>
    <?php $i++; endforeach;?>
                </div>
                <!-- Navigation -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
    <div class="container">
        <div class="movie-top-stripe">
            <h1 class="movie-list-title">Сейчас в кино: </h1>

        </div>
        <div class="row events">
            <!-- BEGIN PRODUCTS -->
<?php foreach ($events as $event): ?>
            <div class="col-md-3 col-sm-6 ">
    		<span class="thumbnail">
                <a href="/event/<?=$event['event_id'];?>"><img src="../..<?=$event['event_sm_img'];?>" alt="<?=$event['event_name'];?>"></a>
      			<h4><?=$event['event_name'];?></h4>
      			<hr class="line">
      			<div class="row row-flex">
      				<div class="col-md-offset-3  ">
      					<button class="btn btn-success right" onClick='location.href="/event/<?=$event['event_id'];?>"' >Купить билеты</button>
      				</div>
      			</div>
    		</span>
            </div>
    <?php endforeach;?>
            <!-- END PRODUCTS -->
        </div>
        <?php echo $pagination->get_links();?>
    </div>


</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>