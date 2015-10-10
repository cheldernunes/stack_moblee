<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html data-ng-app="app" ng-controller="HomeCtrl">
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $this->fetch('title'); ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->fetch('meta');
    ?>
    <!-- BEGIN PLUGINS -->
    <link href="/assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="/assets/plugins/swiper/css/swiper.css" rel="stylesheet" type="text/css" media="screen" />
    <!-- END PLUGINS -->
    <!-- BEGIN PAGES CSS -->
    <link class="main-stylesheet" href="/pages/css/pages.css" rel="stylesheet" type="text/css" />
    <link class="main-stylesheet" href="/pages/css/pages-icons.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGES CSS -->
    <!-- ANGULAR -->
    <script src="/assets/plugins/angular/angular.js" type="text/javascript"></script>
    <script src="/assets/plugins/angular-ui-router/angular-ui-router.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/angular-ui-util/ui-utils.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/angular-sanitize/angular-sanitize.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/angular-oc-lazyload/ocLazyLoad.min.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="/assets/js/app.js" type="text/javascript"></script>
    <!-- END -->
    <style>
        pre {outline: 1px solid #ccc; padding: 5px; margin: 5px; }
        .string { color: green; }
        .number { color: darkorange; }
        .boolean { color: blue; }
        .null { color: magenta; }
        .key { color: red; }
    </style>

    <?php
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body>

<?php echo $this->Flash->render(); ?>

<?php echo $this->fetch('content'); ?>


<!-- BEGIN VENDOR JS -->
<script type="text/javascript" src="/assets/plugins/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/assets/plugins/swiper/js/swiper.jquery.min.js"></script>
<script type="text/javascript" src="/assets/plugins/velocity/velocity.min.js"></script>
<script type="text/javascript" src="/assets/plugins/velocity/velocity.ui.js"></script>
<script type="text/javascript" src="/assets/plugins/jquery-unveil/jquery.unveil.min.js"></script>
<!-- END VENDOR JS -->
<!-- BEGIN PAGES FRONTEND LIB -->
<script type="text/javascript" src="/pages/js/pages.frontend.js"></script>
<!-- END PAGES LIB -->

<?php echo $this->element('sql_dump'); ?>
</body>
</html>
