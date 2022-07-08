<?php

namespace MauticPlugin\TwilioSmsBundle\EventListener;

use Mautic\LeadBundle\Entity\DoNotContact;
use Mautic\LeadBundle\Model\DoNotContact as DoNotContactModel;
use Mautic\SmsBundle\Event\ReplyEvent;
use Mautic\SmsBundle\SmsEvents;
use MauticPlugin\TwilioSmsBundle\Integration\Twilio\Configuration;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;

class Subscriber implements EventSubscriberInterface
{
	private Configuration $configuration;

	private DoNotContactModel $doNotContactModel;

	public function __construct(Configuration $configuration, DoNotContactModel $doNotContactModel)
	{
		$this->configuration = $configuration;
		$this->doNotContactModel = $doNotContactModel;
	}

	public static function getSubscribedEvents(): array
	{
		return [
			SmsEvents::ON_REPLY => ['onReply', 999],
		];
	}

	public function onReply(ReplyEvent $event): void
	{
		$msg = trim(strtolower($event->getMessage()));

		// Mautic already handles "stop" keyword. Handle other Twilio keywords.
		if (in_array($msg, ['stop', 'help', 'info'], true)) {
			return;
		}

		// Other stopwords that Twilio supports
		if (in_array($msg, ['stopall', 'unsubscribe', 'cancel', 'end', 'quit'], true)) {
			$this->doNotContactModel->addDncForContact(
				$event->getContact()->getId(),
				'sms',
				DoNotContact::UNSUBSCRIBED,
			);

			return;
		}

		// Handle resubscribe messages
		if (in_array($msg, ['start', 'yes', 'unstop'], true)) {
			$this->doNotContactModel->removeDncForContact(
				$event->getContact()->getId(),
				'sms',
				true,
				DoNotContact::UNSUBSCRIBED,
			);

			return;
		}

		// Reply to all other messages with autoreply if applicable
		if ($autoreply = $this->configuration->getAutoreplyMessage()) {
			$event->setResponse(new Response(
				sprintf('<Response><Message>%s</Message></Response>', strip_tags($autoreply)),
				Response::HTTP_OK,
				['content-type' => 'text/xml'],
			));
		}
	}
}

