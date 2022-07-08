<?php

namespace MauticPlugin\TwilioSmsBundle\DependencyInjection\Compiler;

use MauticPlugin\TwilioSmsBundle\Integration\TwilioIntegration;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwilioIntegrationPass implements CompilerPassInterface
{
	public function process(ContainerBuilder $container): void
	{
		if ($container->has('mautic.integration.twilio')) {
			$container
				->getDefinition('mautic.integration.twilio')
				->setClass(TwilioIntegration::class);
		}
	}
}

