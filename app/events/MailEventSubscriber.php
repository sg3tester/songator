<?php

namespace App\Events;
/**
 * Description of MailEventSubscriber
 *
 * @author JDC
 */
class MailEventSubscriber implements \Kdyby\Events\Subscriber {
	
	private $mailer;
	private $url;
	
	public function __construct(\UrlGenerator $url, \App\Model\SgMailer $mailer) {
		$this->mailer = $mailer;
		$this->url = $url;
	}
	
	public function getSubscribedEvents() {
		return ['\App\UserManager::onUserAdd'];
	}
	
	public function onUserAdd(\App\UserManager $usrmgr, $user, $service) {
		$this->mailer->send($user->email, 'newuser', ['user' => $user]);
	}
	
}
