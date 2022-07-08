<?php

namespace MauticPlugin\TwilioSmsBundle;

use Mautic\PluginBundle\Bundle\PluginBundleBase;
use MauticPlugin\TwilioSmsBundle\DependencyInjection\Compiler\TwilioIntegrationPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class TwilioSmsBundle extends PluginBundleBase
{
	public function build(ContainerBuilder $container)
	{
		$container->addCompilerPass(new TwilioIntegrationPass());
	}
}

