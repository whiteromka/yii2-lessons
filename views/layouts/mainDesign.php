<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\NiceAdminAsset;
use app\components\widgets\MicroProfileWidget;
use app\widgets\Alert;
use yii\helpers\Url;

NiceAdminAsset::register($this);
// $this->registerCsrfMetaTags();
$this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->head() ?>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
<!--    <meta content="" name="keywords">-->
    <?php $this->registerMetaTag(['name' => 'keywords', 'content' => Yii::$app->params['meta_keywords'] ?? '!!!!']); ?>
    <link href="/NiceAdmin/assets/img/favicon.png" rel="icon">
    <link href="/NiceAdmin/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

</head>

<body>
<?php $this->beginBody() ?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="/NiceAdmin/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">NiceAdmin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <?php
    $goodAction = 'index';
    $goodController = 'site';
    $action = Yii::$app->controller->action->id;
    $controller = Yii::$app->controller->id;

    $value = Yii::$app->request->get('catName', '');
    if ($action == $goodAction && $controller == $goodController) :?>
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="GET" action="/site/index">
            <input type="text" name="catName" placeholder="Имя кота плз!" value="<?= $value?>" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div><!-- End Search Bar -->
    <?php endif; ?>



    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>Lorem Ipsum</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>30 min. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-x-circle text-danger"></i>
                        <div>
                            <h4>Atque rerum nesciunt</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>1 hr. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4>Sit rerum fuga</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>2 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-info-circle text-primary"></i>
                        <div>
                            <h4>Dicta reprehenderit</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a><!-- End Messages Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have 3 new messages
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="/NiceAdmin/assets/img/messages-1.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Maria Hudson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="/NiceAdmin/assets/img/messages-2.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>Anna Nelson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>6 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="/NiceAdmin/assets/img/messages-3.jpg" alt="" class="rounded-circle">
                            <div>
                                <h4>David Muldon</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>8 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="dropdown-footer">
                        <a href="#">Show all messages</a>
                    </li>

                </ul><!-- End Messages Dropdown Items -->

            </li><!-- End Messages Nav -->

            <?= MicroProfileWidget::widget() ?>

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->

<?php
    $menu = Yii::$app->params['menu'];
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="/">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <?php
        $controllerName = Yii::$app->controller->id;
        $cssNavOpen = '';
        $sitePages = $menu['Site Pages'];
        foreach ($sitePages as $url) {
            if (strpos($url, $controllerName) !== false) {
                $cssNavOpen = 'show';
                break;
            }
        }
        $cssCollapsed = $cssNavOpen ? '' : 'collapsed';

        foreach ($menu as $title => $item) :?>
        <?php if (is_array($item)): ?>
                <li class="nav-item">
                    <a class="nav-link <?= $cssCollapsed?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Site pages</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse <?= $cssNavOpen?>" data-bs-parent="#sidebar-nav">

                        <?php foreach ($item as $name => $url):?>
                        <li>
                            <a href="<?= Url::to($url)?>">
                                <i class="bi bi-circle"></i><span><?= $name?></span>
                            </a>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </li>
        <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?=Url::to($item)?>">
                        <i class="bi bi-person"></i>
                        <span><?= $title?></span>
                    </a>
                </li>
        <?php endif;?>
        <?php endforeach;?>
    </ul>

</aside><!-- End Sidebar-->

<main id="main" class="main">
    <?= Alert::widget() ?>
    <?= $content ?>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
<script src="/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
<script src="/NiceAdmin/assets/vendor/quill/quill.js"></script>
<script src="/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="/NiceAdmin/assets/js/main.js"></script>
<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>