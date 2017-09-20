<?php

use ChatbaseAPI\Chatbase;
use PHPUnit\Framework\TestCase;

class ChatbaseTest extends TestCase {

  public function testUserMessage() {
    $cb = new Chatbase('some-key');
    $cb_data = $cb->userMessage('userid', 'alexa', 'some message', 'some-intent');

    $expected_data = array(
      'api_key' => 'some-key',
      'type' => 'user',
      'user_id' => 'userid',
      'time_stamp' => round(microtime(true) * 1000),
      'platform' => 'alexa',
      'message' => 'some message',
      'intent' => 'some-intent',
      'not_handled' => false,
      'feedback' => false
    );

    $this->assertEquals(count($expected_data), count($cb_data));
  }

  public function testAgentMessage() {
    $cb = new Chatbase('some-key');
    $cb_data = $cb->agentMessage('userid', 'alexa', 'some message', 'some-intent');

    $expected_data = array(
      'api_key' => 'some-key',
      'type' => 'agent',
      'user_id' => 'userid',
      'time_stamp' => round(microtime(true) * 1000),
      'platform' => 'alexa',
      'message' => 'some message',
      'not_handled' => false
    );

    $this->assertEquals(count($expected_data), count($cb_data));
  }

  public function testTwoWayMessages() {
    $cb = new Chatbase('some-key');
    $cb_data = $cb->twoWayMessages('userid', 'alexa', 'some user message', 'some agent message', 'some-intent');

    $agent_data = array(
      'api_key' => 'some-key',
      'type' => 'agent',
      'user_id' => 'userid',
      'time_stamp' => round(microtime(true) * 1000),
      'platform' => 'alexa',
      'message' => 'some agent message',
      'not_handled' => false
    );
    $user_data = array(
      'api_key' => 'some-key',
      'type' => 'user',
      'user_id' => 'userid',
      'time_stamp' => round(microtime(true) * 1000),
      'platform' => 'alexa',
      'message' => 'some user message',
      'intent' => 'some-intent',
      'not_handled' => false
    );

    $expected_data = array(
      'messages' => array($agent_data, $user_data)
    );

    $this->assertEquals(count($expected_data['messages'][0]), count($cb_data['messages'][0]));
  }

  public function testPostRequest() {
    $cb = new Chatbase('some-key');
    $cb_data = $cb->agentMessage('userid', 'alexa', 'some message', 'some-intent');
    $result = $cb->send($cb_data);
    $this->assertEquals($result->status, '400');
  }
}
