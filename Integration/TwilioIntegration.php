<?php

namespace MauticPlugin\TwilioSmsBundle\Integration;

use Mautic\SmsBundle\Integration\TwilioIntegration as BaseIntegration;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TwilioIntegration extends BaseIntegration
{
	public function appendToForm(&$builder, array $data, string $formArea): void
	{
		parent::appendToForm($builder, $data, $formArea);

		if ($formArea === 'features') {
			$builder->add(
				'autoreply_message',
				TextType::class,
				[
					'label' => 'mautic.twiliosmsbundle.autoreply_message',
					'label_attr' => ['class' => 'control-label'],
					'required' => false,
					'attr' => [
						'class' => 'form-control',
					],
				],
			);
		}
	}
}

