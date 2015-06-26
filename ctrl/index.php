<?php
$count = dibi::select('count(*)')->from('logs_new')->fetchSingle();
?>


      <div class="jumbotron">
        <h1><i class="fa fa-info"></i> INSMA Logs</h1>
        <p class="lead">Welcome to our numbers stations logs database.</p>
        <p><a class="btn btn-lg btn-primary" href="/list" role="button"><i class="fa fa-list"></i> View <strong><?php echo $count ?></strong> logs</a>
		<a class="btn btn-default" href="/search" role="button"><i class="fa fa-search"></i> Search</a>
		<a class="btn btn-default" href="/stats" role="button"><i class="fa fa-bar-chart-o"></i> Analyze</a></p>


	  </div>