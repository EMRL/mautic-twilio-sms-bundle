<?php

use MauticPlugin\TwilioSmsBundle\EventListener\Subscriber;
use MauticPlugin\TwilioSmsBundle\Integration\Twilio\Configuration;

return [
	'name' => 'Twilio SMS',
	'description' => 'Adds functionality to the Twilio integration.',
	'author' => 'EMRL',
	'version' => '1.0.0.',
	'services' => [
		'events' => [
			'plugin.twiliosmsbundle.subscriber' => [
				'class' => Subscriber::class,
				'arguments' => [
					'plugin.twiliosmsbundle.twilio.configuration',
					'mautic.lead.model.dnc',
				],
			],
		],
		'other' => [
			'plugin.twiliosmsbundle.twilio.configuration' => [
				'class' => Configuration::class,
				'arguments' => [
					'mautic.helper.integration',
				],
			],
		],
	],
];

