<?php

namespace App\Model;

/**
 * Description of SgMailer
 *
 * @author JDC
 */
class SgMailer extends \Nette\Object {

	/** @var \Nette\Mail\IMailer */
	protected $mailer;
	protected $config = [
		'from' => 'noreply@songator.loc',
		'display' => 'Songator mailer',
		'templateDir' => 'email'
	];

	public function __construct(\Nette\Mail\IMailer $mailer, $config = []) {
		$this->mailer = $mailer;
		$this->config = \Nette\Utils\Arrays::mergeTree($this->config, $config);
	}

	public function send($to, $message, $args = []) {
		$mail = new \Nette\Mail\Message();
		$mail->setFrom($this->config['from'], $this->config['display']);
		$mail->addTo($to);

		$dir = $this->config['templateDir'];
		$template = new \Nette\Templating\FileTemplate();
		$template->registerFilter(new \Nette\Latte\Engine);
		$template->registerHelperLoader('\Nette\Templating\Helpers::loader');
		$template->setFile($dir . '/' . $message . '.latte');
		$template->setParameters($args);
		$template->recipient = $to;

		$mail->setHtmlBody($template);
		$this->mailer->send($mail);
	}

}
