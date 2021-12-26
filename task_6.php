<?php 

$persons = [
    ['name' => 'Sunny A.',
     'language' => 'UI/UX Expert',
     'img_src' => 'sunny.png',
     'img_alt' => 'Sunny A.',
     'prof' => 'Lead Author',
     'twitter_url' => 'https://twitter.com/@myplaneticket',
     'twitter_title' => '@myplaneticket',
     'bootstrap_url' => 'https://wrapbootstrap.com/user/myorange',
     'bootstrap_title' => 'Contact Sunny',
     'banned' => FALSE,
    ],
    ['name' => ' Jos K.',
     'language' => 'ASP.NET Developer',
     'img_src' => 'josh.png',
     'img_alt' => 'Jos K.',
     'prof' => 'Partner &amp; Contributor',
     'twitter_url' => 'https://twitter.com/@atlantez',
     'twitter_title' => '@atlantez',
     'bootstrap_url' => 'https://wrapbootstrap.com/user/Walapa',
     'bootstrap_title' => 'Contact Jos',
     'banned' => FALSE,
    ],
    ['name' => 'Jovanni L.',
    'language' => 'PHP Developer',
    'img_src' => 'jovanni.png',
    'img_alt' => 'Jovanni Lo',
    'prof' => 'Partner &amp; Contributor',
    'twitter_url' => 'https://twitter.com/@lodev09',
    'twitter_title' => '@lodev09',
    'bootstrap_url' => 'https://wrapbootstrap.com/user/lodev09',
    'bootstrap_title' => 'Contact Jovanni',
    'banned' => TRUE,
   ],
   ['name' => 'Roberto R.',
   'language' => 'Rails Developer',
   'img_src' => 'roberto.png',
   'img_alt' => 'Roberto R.',
   'prof' => 'Partner &amp; Contributor',
   'twitter_url' => 'https://twitter.com/@sildur',
   'twitter_title' => '@sildur',
   'bootstrap_url' => 'https://wrapbootstrap.com/user/sildur',
   'bootstrap_title' => 'Contact Roberto',
   'banned' => TRUE,
  ],
];

?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
        <main id="js-page-content" role="main" class="page-content">
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                           <div class="d-flex flex-wrap demo demo-h-spacing mt-3 mb-3">

                            <?php foreach ($persons as $person) : ?>
                            <?php if ($person['banned']) : ?>
                                <div class="banned rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">
                            <?php else : ?>
                                <div class="rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">
                            <?php endif ?>
                                <img src="img/demo/authors/<?= $person['img_src'] ?>" alt="<?= $person['img_alt'] ?>" class="img-thumbnail img-responsive rounded-circle" style="width:5rem; height: 5rem;">
                                <div class="ml-2 mr-3">
                                <h5 class="m-0">
                                    <?= $person['name'] ?> (<?= $person['language'] ?>)
                                    <small class="m-0 fw-300">
                                        <?= $person['prof'] ?>
                                    </small>
                                </h5>
                                <a href="<?= $person['twitter_url'] ?>" class="text-info fs-sm" target="_blank"><?= $person['twitter_title'] ?></a> -
                                <a href="<?= $person['bootstrap_url'] ?>" class="text-info fs-sm" target="_blank" title="<?= $person['bootstrap_title'] ?>"><i class="fal fa-envelope"></i></a>
                                </div>
                            </div>
                            <?php endforeach ?>
                            
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            // default list filter
            initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
            // custom response message
            initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
        </script>
    </body>
</html>











