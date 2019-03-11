<?php
session_start();
	
   require_once 'google-api-php-client-2.2.1/vendor/autoload.php';

        $client = new Google_Client();
        $client->setApplicationName('MMS-GAP');
        $client->setScopes(implode(' ', array(Google_Service_Gmail::GMAIL_READONLY)));
        //Web Applicaion (json)
        $client->setAuthConfigFile('client_secret_2.json');

        $client->setAccessType('offline');       

        // Redirect the URL after OAuth
        if (isset($_GET['code'])) {
            $client->authenticate($_GET['code']);
            $_SESSION['access_token'] = $client->getAccessToken();
            $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
            header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
        }

        // If Access Toket is not set, show the OAuth URL
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        } else {
            $authUrl = $client->createAuthUrl();
        }

        if ($client->getAccessToken()) {

            $_SESSION['access_token'] = $client->getAccessToken();

            // Prepare the message in message/rfc822
            try {

                // The message needs to be encoded in Base64URL

                 $service = new Google_Service_Gmail($client);

                $optParams = [];
                $optParams['maxResults'] = 5; // Return Only 5 Messages
                $optParams['labelIds'] = 'INBOX'; // Only show messages in Inbox
                $messages = $service->users_messages->listUsersMessages('me',$optParams);
                $list = $messages->getMessages();
                $messageId = $list[0]->getId(); // Grab first Message


                $optParamsGet = [];
                $optParamsGet['format'] = 'full'; // Display message in payload
                $message = $service->users_messages->get('me',$messageId,$optParamsGet);
                $messagePayload = $message->getPayload();
                $headers = $message->getPayload()->getHeaders();
                $parts = $message->getPayload()->getParts();

                $body = $parts[0]['body'];
                $rawData = $body->data;
                $sanitizedData = strtr($rawData,'-_', '+/');
                $decodedMessage = base64_decode($sanitizedData);

        var_dump($decodedMessage);

            } catch (Exception $e) {
                print($e->getMessage());
                unset($_SESSION['access_token']);
            }

        }

     // If there is no access token, there will show url
     if ( isset ( $authUrl ) ) { 
            echo $authUrl;
      }
	  ?>
