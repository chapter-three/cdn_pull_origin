<?php

/**
 * @file
 * Contains \Drupal\cdn_pull_origin\EventSubscriber\CDNSubscriber.
 */

namespace Drupal\cdn_pull_origin\EventSubscriber;
 
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Session\AccountInterface;
 
class CDNSubscriber implements EventSubscriberInterface {

  protected $account;

  /**
   * Implements __construct().
   */
  public function __construct(AccountInterface $account) {
    $this->account = $account;
  }

  /*
   * Make sure Amazon CloudFront doesn't serve dynamic content
   * from static*.metaltoad.com
   */
  public function checkForCloudFront(GetResponseEvent $event) {
    $req = $event->getRequest();
 
    if (strstr($req->server->get('HTTP_HOST'), 'static')) {
      if (!strstr($req->getPathInfo(), 'files/styles')) {
        header("HTTP/1.0 404 Not Found");
        print '404 Not Found';
        exit();
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::REQUEST][] = ['checkForCloudFront'];
    return $events;
  }
 
}
