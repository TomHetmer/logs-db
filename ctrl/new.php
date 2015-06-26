<div class="page-header">
  <h1>
    <i class="fa fa-plus"></i> Add a new station log
  </h1>
</div>
<?php

use Nette\Forms\Form;
use Kdyby\BootstrapFormRenderer\BootstrapRenderer;

$form = new Form;
$form->setRenderer(new BootstrapRenderer);
$form->addProtection();

$form->addText('reporter', 'Nickname')
		->setAttribute('placeholder', 'anonymous')
		->setRequired();

date_default_timezone_set("UTC"); 
$form->addText('datetime', 'When')
		->setAttribute('placeholder', '2014-01-01 14:00')
    ->setDefaultValue(date('Y-m-d H:i:s'))
		->setRequired();

$form->addText('station', 'Station designator')
		->setRequired()
		->setAttribute('placeholder', 'E11');

$form->addText('qrh', 'Frequency')
		->setRequired()
		->setAttribute('placeholder', '4625')
		->addRule(Form::FLOAT);

$form->addText('callnumber', 'Call # (leave empty if not captured)')
		->setAttribute('placeholder', '472 639 5 or 441/30');
    
$form->addText('callid', 'Call ID (leave empty if not captured)')
		->setAttribute('placeholder', '472 639 5 or 441/30');
    
$form->addText('gc', 'Group Count')
		->setAttribute('placeholder', '10');

$form->addTextArea('body', 'Message (leave empty if not captured)')
		->setAttribute('placeholder', '39715 12345');

$form->addSubmit('send', 'Add to our mighty database');



if ($form->isSuccess() && $form->isValid()) {
 //die();
	$f = $form->getValues();
   //dump($f);
		$arr = array(
			//'id'				=> '123',
			'time'			    => $f['datetime'],
			'station'			=> $f['station'],
			'qrh'				=> $f['qrh'],
      'call_number'				=> $f['callnumber'],
      'call_id'				=> $f['callid'],
			'gc'				=> $f['gc'],
			'body'				=> $f['body'],
			'reporter'			=> $f['reporter'],
			);

		dibi::query('insert into logs_new', $arr);
		echo "Log has been added. Thank you.";
	}
$form->render();
?>