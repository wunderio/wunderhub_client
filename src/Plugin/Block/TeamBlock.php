<?php

/**
 * @file
 * Contains \Drupal\wunderhub_client\Plugin\Block\TeamBlock.
 */

namespace Drupal\wunderhub_client\Plugin\Block;

use Drupal\Core\block\BlockBase;
use Drupal\wunderhub_client\Controller\TeamController;

/**
 * Provides a simple block.
 *
 * @Block(
 *   id = "wunderhub_client_team",
 *   admin_label = @Translation("Team")
 * )
 */
class TeamBlock extends BlockBase {

  /**
   * Implements \Drupal\block\BlockBase::blockBuild().
   */
  public function build() {
    $controller = new TeamController();
    $output = $controller->renderTeam();

    return $output;
  }

}
