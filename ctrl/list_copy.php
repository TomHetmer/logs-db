<div class="page-header">
  <h1><i class="fa fa-list"></i> Logs <a class="btn btn-default" href='/new'><i class="fa fa-plus"></i> Add a new log</a>
  </h1>
</div>
<?php
$logs = dibi::select('*')->from('logs')->orderBy('time DESC')->limit(10);

if(!isset($_GET['station'])){
	// ..
} else {
	$limit = array('station = %s', $_GET['station']);
	$logs->where($limit[0], $limit[1]);
	echo 'Showing only ' . htmlspecialchars($_GET['station']);
}
$logs = $logs->fetchAll();

echo '<table class="table table-hover table-condensed">';

echo '<thead><tr><th>Time</th><th>Station</th><th>Frequency</th><th>Call #1</th><th>Call #2</th><th>Groups</th><th>Reporter</th></tr></thead><tbody>';

foreach($logs as $row) {

	echo '<tr>';

	echo '<td><time class="timeago" datetime="'
			. $row->time->format(DateTime::ISO8601)
			. '"></time>'
			. '</td><td><b>'
			. $row->station
			. '</b></td><td>'
			. $row->qrh
			. '</td><td>'
			. $row->callup
			. '</td><td>'
			. $row->callup2
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