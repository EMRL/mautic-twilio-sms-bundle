# Mautic Twilio SMS Bundle

This plugin helps keep DNC in sync between Twilio and Mautic, and allows you to specify an automatic reply for incoming SMS messages.

Mautic core only marks a contact as DNC for SMS if a message "STOP" is received. But [Twilio supports other keywords](https://support.twilio.com/hc/en-us/articles/223134027-Twilio-support-for-opt-out-keywords-SMS-STOP-filtering-) to unsubscribe as well, which can lead to Mautic attempting to send messages through Twilio only to be immediately blocked by Twilio.

This plugin also adds support for contacts to resubscribe (remove DNC) to SMS messages via the [Twilio keywords](https://support.twilio.com/hc/en-us/articles/223134027-Twilio-support-for-opt-out-keywords-SMS-STOP-filtering-#h_01FBWGE1XDCR8NWMEZ6MW9G8P8).

Lastly, the plugin also adds support for setting an SMS message (via Twilio integration form on Plugins page) that will be sent to contacts if they reply to an SMS message (excluding the special keywords). This can be useful for various reasons. For example, to let contacts know that the number is not monitored.
