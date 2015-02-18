<?php

/**
 * @file
 * Contains \Drupal\wunderhub_client\Controller\TeamController.
 */

namespace Drupal\wunderhub_client\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Returns responses for System Info routes.
 */
class TeamController extends ControllerBase {

  /**
   * Displays the team overview.
   *
   * @return array
   *   Array of page elements to render.
   */
  public function renderTeam() {
    $team_endpoint = \Drupal::configFactory()->getEditable('wunderhub_client.settings')->get('team_url');

    if (!$team_endpoint) {
      return new RedirectResponse('system/404');
    }

    $output = [
      '#theme' => 'wunderhub_client_team',
      '#attached' => [
        'library' => [
          'wunderhub_client/wunderhub_client.team',
        ],
        'drupalSettings' => [
          'wunderhubClient' => [
            'url' => $team_endpoint,
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
  public function renderTeamMember($id) {
    $team_member_endpoint = \Drupal::configFactory()->getEditable('wunderhub_client.settings')->get('team_member_url');

    if (!$team_member_endpoint || !is_numeric($id)) {
      return new RedirectResponse('system/404');
    }

    $output = [
      '#theme' => 'wunderhub_client_team__member',
      '#attached' => [
        'library' => [
          'wunderhub_client/wunderhub_client.team',
        ],
        'drupalSettings' => [
          'wunderhubClient' => [
            'url' => $team_member_endpoint,
            'id' => $id,
          ],
        ],
      ],
    ];

    return $output;
  }

}
