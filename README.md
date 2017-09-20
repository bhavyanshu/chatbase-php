## chatbase-php

[![Build Status](https://travis-ci.org/bhavyanshu/chatbase-php.svg?branch=master)](https://travis-ci.org/bhavyanshu/chatbase-php)

A PHP library for the Chatbase API that helps you integrate chatbase with your PHP app. Note: This is not an official Google product.

For more information, read [official documentation](https://chatbase.com/documentation/generic)

## Example Usage

- Initializing

  ```php
  use ChatbaseAPI\Chatbase;
  $cb = new Chatbase('YOUR_AGENT_API_KEY');
  ```

- Loggin what User asked for

  ```php
  //userMessage($user_id, $platform, $message = "", $intent = "", $not_handled = false, $feedback = false)
  $cb_data = $cb->userMessage('userid', 'alexa', 'some message', 'some-intent', false, false);
  $result = $cb->send($cb_data); //returns json decoded object
  ```

- Logging what Agent/Bot replied
  ```php
  //agentMessage($user_id, $platform, $message = "", $intent = "", $not_handled = false)
  $cb_data = $cb->agentMessage('userid', 'alexa', 'some message', 'some-intent');
  $result = $cb->send($cb_data);
  ```

- Logging two way communication:

  ```php
  //twoWayMessages($user_id, $platform, $user_message = "", $agent_message = "", $intent = "", $not_handled = false)
  $cb_data = $cb->twoWayMessages('user-xyz', 'alexa', 'about food options', 'Let me read todays menu', 'food-menu');
  $result = $cb->sendAll($cb_data);
  ```
  Example Response:
  ```
  {
    "all_succeeded": true,
    "responses": [{
    	"message_id": 1212121,
    	"status": "success"
    }, {
    	"message_id": 13131313,
    	"status": "success"
    }],
    "status": 200
  }
  ```

- Logging multiple messages at once

  ```php
  $message1 = array(
   'type' => 'user',
   'user_id' => 'user-xyz',
   'platform' => 'alexa',
   'message' => 'travel to chicago',
   'intent' => 'travel-intent',
   'not_handled' => false
  );
  $message2 = array(
   'type' => 'agent',
   'user_id' => 'user-xyz',
   'platform' => 'alexa',
   'message' => 'Next flight at 4 PM',
   'intent' => 'travel-intent',
   'not_handled' => false
  );
  $arr_messages = array($message1, $message2);
  $cb_data = $cb->rawMultipleMessages($arr_messages);
  $result = $cb->sendAll($cb_data);
  ```
