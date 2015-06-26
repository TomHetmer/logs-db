<?php
// Hetmer 2014
// Piece of Shit Coding Ltd.

date_default_timezone_set('UTC');

if(isset($_GET['path'])){
	$pg = $_GET['path'];
} else {
	$pg = 'index';
}

function isActiveHelper($path) {
	// kinda shitty logic to avoid a PHP notice (Undefined index: path)
	if(!isset($_GET['path']) && $path == '') return ' class="active"';
	if(!isset($_GET['path']) && $path != '') return false;

	if($_GET['path'] == $path){
		return ' class="active"';
	}
	

	return false;
}


require './lib/nette.min.php';
require './lib/Kdyby/BootstrapFormRenderer/BootstrapRenderer.php';

$configurator = new Nette\Config\Configurator;
$configurator->setTempDirectory(__DIR__ . '/tmp');

$configurator->setDebugMode();
$configurator->enableDebugger(__DIR__ . "/tmp");

require './db.php';
require './func.php';

// nette things
// how to set up sessions the most complicated way
$container 	= $configurator->createContainer();
$session	= $container->session;
$user   	= $container->user;
$s      	= $session->getSection('logs-db');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo str_replace('-', ' ', ucfirst($pg)) ?> • INSMA Logs</title>

    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<link href='/client/css/main.css' rel='stylesheet'>

	<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.1.0/jquery.timeago.min.js"></script>

  </head>

  <body>
  <div class="wrap">
  <div class="container">
    <div class="navbar-wrapper">

	  	<a href='/'><img src="/client/img/logo.png" alt="INSMA"></a>
        <div class="navbar navbar-inverse " role="navigation">
        <!--  <div class="container">-->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li<?=isActiveHelper('')?>><a href="/"><i class="fa fa-home"></i> Main</a></li>
                <li<?=isActiveHelper('list')?>><a href="/list"><i class="fa fa-list"></i> View</a></li>
                <li<?=isActiveHelper('search')?>><a href="/search"><i class="fa fa-search"></i> Search</a></li>
                <li<?=isActiveHelper('stats')?>><a href="/stats"><i class="fa fa-bar-chart-o"></i> Analysis</a></li>
				<!--<li<?=isActiveHelper('app')?>><a href="/app"><i class="fa fa-windows"></i> Ali's Logs App</a></li>-->
              </ul>
               <ul class="nav navbar-nav pull-right"><li<?=isActiveHelper('new')?>><a href="new"><i class="fa fa-plus"></i> Add</a></li></ul>
            </div>
          <!--</div>-->
        </div>

    </div>

    <div class="marketing">

<?php
// Fuck it why not. Who has the time for MVC.

if($pg == 'index' || $pg == 'search' || $pg == 'new' || $pg == 'list' || $pg == 'stats') {
	$f = './ctrl/' . $pg . '.php';
	require $f;
}
?>

	


    <div id="footer">

        <p class="text-muted"><i class="fa fa-heart"></i> th 2014 for <a href='//www.insma.org'>www.insma.org</a></p>
    </div>
    </div>

</div>
</div>
<script>
	$(document).ready(function() {
	  	$("time.timeago").timeago();
	});
</script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src='/client/js/live-form-validation.js'></script>
  </body>
</html>
