<?php

namespace MauticPlugin\TwilioSmsBundle\Integration\Twilio;

use Mautic\PluginBundle\Helper\IntegrationHelper;
use Twilio\Exceptions\ConfigurationException;

class Configuration
{
    private IntegrationHelper $integrationHelper;

    private string $autoreplyMessage;

    public function __construct(IntegrationHelper $integrationHelper)
    {
        $this->integrationHelper = $integrationHelper;
    }

    public function getAutoreplyMessage(): string
    {
        $this->setConfiguration();
        return $this->autoreplyMessage;
    }

    private function setConfiguration(): void
    {
        if ($this->autoreplyMessage || $this->autoreplyMessage === '') {
            return;
        }

        $integration = $this->integrationHelper->getIntegrationObject('Twilio');

        if (!$integration || !$integration->getIntegrationSettings()->getIsPublished()) {
            throw new ConfigurationException();
        }

        $this->autoreplyMessage = (string) $integration->getIntegrationSettings()
            ->getFeatureSettings()['autoreply_message'];
    }
}

