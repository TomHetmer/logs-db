<div class="page-header">
<h1><i class="fa fa-search"></i> Search</h1>
</div>

<h2>Station logs</h2>
<?php
// temporary until we get a list of stations

use Nette\Forms\Form;
use Kdyby\BootstrapFormRenderer\BootstrapRenderer;
$form = new Form;
$form->setRenderer(new BootstrapRenderer);
$form->setAction('/list');
$form->setMethod('GET');
//$form->addProtection();


$form->addText('station', 'Station')
		->setAttribute('placeholder', 'E11')
		->setRequired();

$form->addSubmit('search', 'Search for this station');


$form->render();
?>
