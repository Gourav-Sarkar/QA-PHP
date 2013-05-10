    <!DOCTYPE html>
    <html>
    <head>
    <title>Gallery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/Bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <header class="row-fluid">
            <ul class="nav nav-pills">
                <li class="active""><A href='#'>Home</a></li>
                <li><A href='#'>Home</a></li>  
                <li><A href='#'>Home</a></li>  
            </ul>
        </header>
        <div class="row-fluid">
            <div class="span8 ">
                <!-- Image gallery slide -->
                <div id="myCarousel" class="carousel slide">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
    
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        
                        <div class="active item">
                                <img src="/image/gallery/dark-goth-hd.jpg" />
                                <div class="carousel-caption">
                                    <h3>Thumbnail label</h3>
                                    <p>Thumbnail caption...</p>
                                </div>
                        </div>
                    
                        <div class="item">
                            <img src="/image/gallery/beach-hd.jpg" />
                            <div class="carousel-caption">
                                <h3>Thumbnail label 2</h3>
                                <p>Thumbnail caption...</p>
                            </div>
                        </div>
                    
                        <div class="item">
                            <img src="/image/gallery/waterfall-hd.jpg" />
                            <div class="carousel-caption">
                                    <h3>Thumbnail labe 3l</h3>
                                    <p>Thumbnail caption...</p>
                            </div>
                        </div>
                    </div>
            
                    <!-- Carousel nav -->
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                </div>
                
            </div>
        </div>
        
    <script src="/jquery/jquery-min.js"></script>
    <script src="/Bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>