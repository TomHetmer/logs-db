<div class="page-header">
  <h1><i class="fa fa-list"></i> Logs <a class="btn btn-default" href='/new'><i class="fa fa-plus"></i> Add a new log</a>
  </h1>
</div>
<?php

$paginator = new Nette\Utils\Paginator;
$paginator->setItemCount(11); // the total number of records (e.g., a number of products)
$paginator->setItemsPerPage(5); // the number of records on page
$paginator->setPage(2); // the number of the current page (numbered from one)

//$result = dibi::select('*')->from('logs_new')->orderBy('time DESC')->limit($paginator->getLength(),',', $paginator->getOffset());
//echo count($result);
$logs = dibi::select('*')->from('logs_new')->orderBy('time DESC')->limit(10);
//echo count($logs);
if(!isset($_GET['station'])){
	// ..
} else {
	$limit = array('station = %s', $_GET['station']);
	$logs->where($limit[0], $limit[1]);
	echo 'Showing only ' . htmlspecialchars($_GET['station']);
}
$logs = $logs->fetchAll();

echo '<table class="table table-hover table-condensed">';

echo '<thead><tr><th>Time</th><th>Station</th><th>Frequency</th><th>Call #</th><th>Call Id</th><th>Group Count</th><th>Reporter</th></tr></thead><tbody>';

foreach($logs as $row) {

	echo '<tr>';
  //if($row->time == null) {echo 'null time';}
  //if(strtotime($row->time)=='0000-00-00 00:00:00'){echo 'null date';}
  //echo strtotime($row->time) .'<br/>';
	echo '<td><time class="timeago" datetime="'
      //. $row->time
			. $row->time->format(DateTime::ISO8601)
			. '"></time>'
			. '</td><td><b>'
			. $row->station
			. '</b></td><td>'
			. $row->qrh
			. '</td><td>'
			. $row->call_number
			. '</td><td>'
			. $row->call_id
			. '</td><td>'
			. $row->gc
			. '</td><td>'
			. $row->reporter
			. '</td>';
	echo '<td>';
	if($row->gc > 0 && $row->body != '') {
				echo '<a class="btn btn-default btn-sm" href="javascript:alert(\''.$row->body.'\')">groups</a>';
			}
	echo '</td>';

	echo '</tr>';

}

echo '</tbody></table>';
?>