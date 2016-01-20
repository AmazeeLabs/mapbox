<?php
/**
 * @file
 * Contains \Drupal\header_image_block\Plugin\Block\HeaderImage.
 */
namespace Drupal\mapbox\Plugin\Block;
use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'MapBox_Map' block.
 *
 * @Block(
 *  id = "mapbox_map",
 *  admin_label = @Translation("Mapbox Map"),
 * )
 */
class MapboxMap extends BlockBase {
    /**
     * {@inheritdoc}
     */
    public function build() {
        return array(
            '#markup' => '<div id="mapbox-map"></div>',
        );
    }
}
