<?php
/**
 * @file
 * Contains \Drupal\mydata\Controller\MyModuleController.
 */
namespace Drupal\mydata\Controller;
use Drupal\Core\Controller\ControllerBase;

class MyModuleController extends ControllerBase {
  // ...
  // Render a page of my messages
  public function messagesPage() {
    // .. build $content
    // Create render array.
    $page[] = array(
      '#type' => 'markup',
      '#markup' => $content,
    );
    // Attach JavaScript library.
    $page['#attached']['library'][] = 'mydata/mymodule.commands';
    return $page;
  }
  // ...
  
   // ...
// AJAX Callback to read a message.
  public function readMessageCallback($method, $mid) {
    $message = mymodule_load_message($mid);
    // Create AJAX Response object.
    $response = new AjaxResponse();
    // Call the readMessage javascript function.
    $response->addCommand( new ReadMessageCommand($message));
   );
   // Return ajax response.
   return $response;
  }
  // ...
}
?>