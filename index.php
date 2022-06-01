<!-- Include Head -->
<?php include "assest/head.php"; ?>
<?php

// Get Latest articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id ORDER BY `article_created_time` DESC  LIMIT 9");
$stmt->execute();
$articles = $stmt->fetchAll();

// Get Categories
$stmt = $conn->prepare("SELECT *,COUNT(*) as article_count FROM `article` INNER JOIN category ON id_categorie=category_id GROUP BY id_categorie");
$stmt->execute();
$categories = $stmt->fetchAll();

// Get Most Read Articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id order by RAND() LIMIT 4");
$stmt->execute();
$most_read_articles = $stmt->fetchAll();

?>



<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">

<!-- Custom CSS -->
<!-- <link href="css/home.css" rel="stylesheet"> -->
<link type="text/css" rel="stylesheet" href="css/style.css" />
<!-- <custom corousell> -->
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
    .bg-div {
    background-position: center center;
    background-repeat: no-repeat;
    margin: -1px 0px 0px -1px;
    padding: 0px;
    width: 100%;
    }
</style>

<title>Home</title>
</head>

<?php
if (!$loggedin) {
    echo("<script>alert('login dlu euy');window.location.href = 'start.php';</script>");
    exit;
}
?>
<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <?php include "assest/header.php" ?>
    <!-- </Header> -->

    <!-- Main -->
    <main class="main">

        <!-- Carousell -->
       <div class="bg-div">  
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="img/slider/Slide1.jpg" alt="Los Angeles" style="width: 100%; height: 100%;">
        <div class="carousel-caption">
       <a href="/blognative/blognative/single_article.php?id=27"> <h1 style="color: #EBE7E7;">HMAS Albatross History</h1></a>
        <h3 style="color: #2A2A2A;">HMAS Albatross is the Royal Australian Navy’s (RAN) Naval Air Station (NAS). Located at Nowra on the South Coast of New South Wales, Albatross was commissioned on 31 August 1948 and over 40,000 Commonwealth servicemen and women have served there over the years. 2018 marked the 70th Anniversary of the RAN Fleet Air Arm (FAA) and its home at Nowra.</h3>
    </div>
      </div>

      <div class="item">
        <img src="img/slider/Slide2.jpg" alt="Chicago" style="width: 100%; height: 100%;">
         <div class="carousel-caption">
       <a href="/blognative/blognative/single_article.php?id=27"> <h1 style="color: #EBE7E7;">HMAS Parramatta departs for a regional presence deployment</h1></a>
        <h3 style="color: #2A2A2A;">HMAS Parramatta has sailed from her home port of Fleet Base East for a two-month Regional Presence Deployment to Southeast and North Asia. The ship will undertake a number of Navy-to-Navy activities with Australia’s regional partners, building on the work of HMAS Arunta which deployed to the Indo-Pacific region previously this year.</h3>
    </div>
      </div>
    
      <div class="item">
        <img src="img/slider/Slide3.jpg" alt="New york" style="width:100%; height: 100%;">
        <div class="carousel-caption">
       <a href="/blognative/blognative/single_article.php?id=27"> <h1 style="color: #EBE7E7;">Aviator shares his heritage</h1></a>
        <h3 style="color: #2A2A2A;">Leading Aircraftman Raymond Solinas, a Ngugi and Kaantju man from Cairns, is proud of his family's history and service to Defence.
Posted to Amberley as a firefighter, he is one of more than 400 Aboriginal and Torres Strait Islander aviators in Air Force today.
“I joined because of my grandfather, and pretty much most of my family fought in the World Wars,”</h3>
    </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<!-- </carousell> -->


        <!-- Jumbotron -->
        <!--
        <div class="jumbotron text-center p-0 mb-0">
            <div class="bg-div px-5 d-flex align-items-center">

                <div class="text-left w-50">
                    <h1 class="display-4 text-white">Welcome to Dev Culture!</h1>
                    <h2 class="display-5 text-white">Discover Dev tutorial and articles that you can read completely for free!</h2>

                </div>


            </div>
        </div> -->
        <!-- /Jumbotron -->

        <!-- Latest Articles -->
        <div class="section section-grey">

            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>Latest Articles</h2>
                        </div>
                    </div>

                    <?php foreach ($articles as $article) : ?>

                        <!-- post -->
                        <div class="col-md-4">
                            <div class="post">
                                <a class="post-img" href="single_article.php?id=<?= $article['article_id'] ?>">
                                    <img src="img/article/<?= $article['article_image'] ?>" alt="">
                                </a>
                                <di class="post-body">

                                    <div class="post-meta">
                                        <a class="post-category cat-1" href="articleOfCategory.php?catID=<?= $article['category_id'] ?>" style="background-color:<?= $article['category_color'] ?>"><?= $article['category_name'] ?></a>
                                        <span class="post-date">
                                            <?= date_format(date_create($article['article_created_time']), "F d, Y ") ?>
                                        </span>
                                    </div>

                                    <h3 class="post-title"><a href="single_article.php?id=<?= $article['article_id'] ?>"><?= $article['article_title'] ?></a></h3>

                                </di>
                            </div>
                        </div>
                        <!-- /post -->

                    <?php endforeach;  ?>

                    <div class="clearfix visible-md visible-lg"></div>
                </div>
                <!-- /row -->

            </div>
            <!-- /container -->
        </div><!-- /Latest Articles -->

        <!-- Most Read -->
        <div class="section section-grey">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="section-title">
                                    <h2>Most Read</h2>
                                </div>
                            </div>

                            <?php foreach ($most_read_articles as $article) : ?>

                                <!-- post -->
                                <div class="col-md-12">
                                    <div class="post post-row">
                                        <a class="post-img" href="single_article.php?id=<?= $article['article_id'] ?>">
                                            <img src="img/article/<?= $article['article_image'] ?>" alt="">
                                        </a>
                                        <div class="post-body">
                                            <div class="post-meta">
                                                <a href="articleOfCategory.php?catID=<?= $article['category_id'] ?>" class="post-category" style="background-color:<?= $article['category_color'] ?>">
                                                    <?= $article['category_name'] ?>
                                                </a>
                                                <span class="post-date">
                                                    <?= date_format(date_create($article['article_created_time']), "F d, Y ") ?>
                                                </span>
                                            </div>

                                            <h3 class="post-title"><a href="single_article.php?id=<?= $article['article_id'] ?>"><?= $article['article_title'] ?></a></h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- /post -->

                            <?php endforeach;  ?>

                            <!-- post -->
                            <!-- <div class="col-md-12">
                                <div class="post post-row">
                                    <a class="post-img" href="blog-post.html"><img src="./img/post-4.jpg" alt=""></a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-2" href="category.html">JavaScript</a>
                                            <span class="post-date">March 27, 2018</span>
                                        </div>
                                        <h3 class="post-title"><a href="blog-post.html">Chrome Extension Protects Against JavaScript-Based CPU Side-Channel Attacks</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
                                    </div>
                                </div>
                            </div> -->
                            <!-- /post -->

                            <!-- post -->
                            <!-- <div class="col-md-12">
                                <div class="post post-row">
                                    <a class="post-img" href="blog-post.html"><img src="./img/post-6.jpg" alt=""></a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-2" href="category.html">JavaScript</a>
                                            <span class="post-date">March 27, 2018</span>
                                        </div>
                                        <h3 class="post-title"><a href="blog-post.html">Why Node.js Is The Coolest Kid On The Backend Development Block!</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
                                    </div>
                                </div>
                            </div> -->
                            <!-- /post -->

                            <!-- post -->
                            <!-- <div class="col-md-12">
                                <div class="post post-row">
                                    <a class="post-img" href="blog-post.html"><img src="./img/post-1.jpg" alt=""></a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-4" href="category.html">Css</a>
                                            <span class="post-date">March 27, 2018</span>
                                        </div>
                                        <h3 class="post-title"><a href="blog-post.html">CSS Float: A Tutorial</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
                                    </div>
                                </div>
                            </div> -->
                            <!-- /post -->

                            <!-- post -->
                            <!-- <div class="col-md-12">
                                <div class="post post-row">
                                    <a class="post-img" href="blog-post.html"><img src="./img/post-2.jpg" alt=""></a>
                                    <div class="post-body">
                                        <div class="post-meta">
                                            <a class="post-category cat-3" href="category.html">Jquery</a>
                                            <span class="post-date">March 27, 2018</span>
                                        </div>
                                        <h3 class="post-title"><a href="blog-post.html">Ask HN: Does Anybody Still Use JQuery?</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
                                    </div>
                                </div>
                            </div> -->
                            <!-- /post -->

                            <!-- <div class="col-md-12">
                                <div class="section-row">
                                    <button class="primary-button center-block">Load More</button>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="col-md-4">

                        <!-- catagories -->
                        <div class="aside-widget">
                            <div class="section-title">
                                <h2>Categories</h2>
                            </div>
                            <div class="category-widget">

                                <ul>
                                    <!-- /category -->
                                    <?php foreach ($categories as $category) : ?>
                                        <li>
                                            <a href="articleOfCategory.php?catID=<?= $category['category_id'] ?>"> <?= $category["category_name"] ?>
                                                <span style="background-color: <?= $category["category_color"] ?>"> <?= $category["article_count"] ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    <!-- /category -->
                                </ul>
                            </div>
                        </div>
                        <!-- <li><a href="#" class="cat-1">Web Design<span>340</span></a></li>
                                    <li><a href="#" class="cat-2">JavaScript<span>74</span></a></li>
                                    <li><a href="#" class="cat-4">JQuery<span>41</span></a></li>
                                    <li><a href="#" class="cat-3">CSS<span>35</span></a></li> -->
                        <!-- /catagories -->

                        <!-- tags -->
                        <!-- <div class="aside-widget">
                            <div class="tags-widget">
                                <ul>
                                    <li><a href="#">Chrome</a></li>
                                    <li><a href="#">CSS</a></li>
                                    <li><a href="#">Tutorial</a></li>
                                    <li><a href="#">Backend</a></li>
                                    <li><a href="#">JQuery</a></li>
                                    <li><a href="#">Design</a></li>
                                    <li><a href="#">Development</a></li>
                                    <li><a href="#">JavaScript</a></li>
                                    <li><a href="#">Website</a></li>
                                </ul>
                            </div>
                        </div> -->
                        <!-- /tags -->
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div><!-- /Most Read -->

    </main><!-- </Main> -->

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>