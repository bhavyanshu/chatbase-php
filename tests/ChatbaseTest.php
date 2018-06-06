<?php

use ChatbaseAPI\Chatbase;
use PHPUnit\Framework\TestCase;

class ChatbaseTest extends TestCase {

  public function testUserMessage() {
    $cb = new Chatbase(getenv('CHATBASE_API_KEY'));
    $cb_data = $cb->userMessage('userid', 'alexa', 'some message', 'some-intent');
    $result = $cb->send($cb_data);
    $this->assertEquals(200, $result->status);
  }

  public function testAgentMessage() {
    $cb = new Chatbase(getenv('CHATBASE_API_KEY'));
    $cb_data = $cb->agentMessage('userid', 'alexa', 'some message', 'some-intent');
    $result = $cb->send($cb_data);
    $this->assertEquals(200, $result->status);
  }

  public function testTwoWayMessages() {
    $cb = new Chatbase(getenv('CHATBASE_API_KEY'));
    $cb_data = $cb->twoWayMessages('userid', 'alexa', 'some user message', 'some agent message', 'some-intent');
    $result = $cb->sendall($cb_data);
    $this->assertEquals(true, $result->all_succeeded);
  }
}
