<?php
namespace Drupal\mydata\Ajax;
use Drupal\Core\Ajax\CommandInterface;

class ReadMessageCommand implements CommandInterface {
  protected $message;
  // Constructs a ReadMessageCommand object.
  public function __construct($message) {
    $this->message = $message;
  }
  // Implements Drupal\Core\Ajax\CommandInterface:render().
  public function render() {
    return array(
      'command' => 'readMessage',
      'mid' => $this->message->mid,
      'subject' => $this->message->subject,
      'content' => $this->message->content,
    );
  }
}