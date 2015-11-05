<?php

/**
 * @file
 * Contains \Drupal\wunderhub_client_blog\Controller\BlogController.
 */

namespace Drupal\wunderhub_client_blog\Controller;


use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BlogController extends ControllerBase {

  /**
   * Displays the blog overview.
   *
   * @return array
   *   Array of page elements to render.
   */
  public function renderBlog() {
    $wunderhub_api_endpoint = \Drupal::configFactory()->getEditable('wunderhub_client.settings')->get('wunderhub_api_url');
    $blog_endpoint = $wunderhub_api_endpoint . \Drupal::configFactory()->getEditable('wunderhub_client.settings')->get('blog_api_endpoint');

    if (!$blog_endpoint) {
      return new RedirectResponse('system/404');
    }

    $output = [
      '#theme' => 'wunderhub_client_blog',
      '#attached' => [
        'library' => [
          'wunderhub_client_blog/wunderhub_client_blog.blog',
        ],
        'drupalSettings' => [
          'wunderhubClientBlog' => [
            'url' => $blog_endpoint,
          ],
        ],
      ],
    ];

    return $output;
  }

  /**
   * Displays a single team member.
   *
   * @param int $id
   *   The ID of the team member.
   *
   * @return array
   *   Array of page elements to render.
   */
  public function renderBlogEntry($id) {
    $wunderhub_api_endpoint = \Drupal::configFactory()->getEditable('wunderhub_client.settings')->get('wunderhub_api_url');
    $blog_entry_endpoint = $wunderhub_api_endpoint . \Drupal::configFactory()->getEditable('wunderhub_client.settings')->get('blog_entry_api_endpoint');
    // Check we have a valid uuid
    preg_match('/\w{8}-\w{4}-\w{4}-\w{4}-\w{12}/', $id, $matches);

    if (!$blog_entry_endpoint|| empty($matches)) {
      return new RedirectResponse('system/404');
    }

    $output = [
      '#theme' => 'wunderhub_client_blog__entry',
      '#attached' => [
        'library' => [
          'wunderhub_client_blog/wunderhub_client_blog.blog',
        ],
        'drupalSettings' => [
          'wunderhubClientBlogEntry' => [
            'url' => $blog_entry_endpoint,
            'uuid' => $id,
          ],
        ],
      ],
    ];

    return $output;
  }

}