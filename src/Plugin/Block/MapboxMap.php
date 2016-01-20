<?php
/**
 * @file
 * Contains \Drupal\header_image_block\Plugin\Block\HeaderImage.
 */
namespace Drupal\mapbox_bridge\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormStateInterface;
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
            '#attached' => array('library' => array('mapbox_bridge/map'), 'drupalSettings' => array('mapbox_bridge' => $this->getConfiguration())),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);

        // Retrieve existing configuration for this block.
        $config = $this->getConfiguration();

        // Add a form field to the existing block configuration form.
        $form['mapbox_id'] = array(
            '#type' => 'textfield',
            '#title' => t('Mapbox ID'),
            'description' => 'ID given to you by mapbox as a user',
            '#default_value' => isset($config['mapbox_id']) ? $config['mapbox_id'] : '',
        );
        $form['mapbox_accesstoken'] = array(
            '#type' => 'textfield',
            '#title' => t('Access Token'),
            'description' => 'The map access token provided by mapbox',
            '#default_value' => isset($config['mapbox_accesstoken']) ? $config['mapbox_accesstoken'] : '',
        );
        $form['zoom_level'] = array(
            '#type' => 'number',
            '#title' => t('Zoom Level'),
            'description' => 'The Level of zoom (the higher the level, the closer)',
            '#default_value' => isset($config['zoom_level']) ? $config['zoom_level'] : '',
        );
        $form['center'] = array(
            '#type' => 'textfield',
            '#title' => t('Map Center'),
            'description' => 'The coordinates, separated by comma, where to center the map.',
            '#default_value' => isset($config['center']) ? $config['center'] : '',
        );
        $form['marker_popup'] = array(
            '#type' => 'checkbox',
            '#title' => t('Marker Popup'),
            'description' => 'Show a popup when clicking the marker.',
            '#default_value' => isset($config['marker_popup']) ? $config['marker_popup'] : '',
        );
        $form['marker_view_mode'] = array(
            '#type' => 'textfield',
            '#title' => t('Maker View Mode'),
            'description' => 'View mode to be used when displaying in the popup.',
            '#default_value' => isset($config['marker_view_mode']) ? $config['marker_view_mode'] : '',
        );
        $form['marker_legend'] = array(
            '#type' => 'checkbox',
            '#title' => t('Marker Lengend'),
            'description' => 'Enable the marker legend below the map.',
            '#default_value' => isset($config['marker_legend']) ? $config['marker_legend'] : '',
        );
        $form['marker_cluster'] = array(
            '#type' => 'checkbox',
            '#title' => t('Marker Clustering'),
            'description' => 'Enabling clustering',
            '#default_value' => isset($config['marker_cluster']) ? $config['marker_cluster'] : '',
        );
        $form['marker_proximity_search'] = array(
            '#type' => 'checkbox',
            '#title' => t('Maker Proximity search'),
            'description' => 'Enable the proximity search feature.',
            '#default_value' => isset($config['marker_proximity_search']) ? $config['marker_proximity_search'] : '',
        );
        $form['marker_anchor'] = array(
            '#type' => 'textfield',
            '#title' => t('Marker Anchor'),
            'description' => 'What is considered to be the "tip" of the marker icon.',
            '#default_value' => isset($config['marker_anchor']) ? $config['marker_anchor'] : '',
        );
        $form['marker_filter'] = array(
            '#type' => 'checkbox',
            '#title' => t('Marker Filtering'),
            'description' => 'Filter markers based on the "filter" attribute within the JSON.',
            '#default_value' => isset($config['marker_filter']) ? $config['marker_filter'] : '',
        );
        $form['marker_filter_fields'] = array(
            '#type' => 'textfield',
            '#title' => t('Marker Field Filters'),
            'description' => 'Name of the field that acts as a fulter from the json. Separate multiple fields by a comma.',
            '#default_value' => isset($config['marker_filter_fields']) ? $config['marker_filter_fields'] : '',
        );
        $form['marker_icon_src'] = array(
            '#type' => 'textfield',
            '#title' => t('Maker Icon Path'),
            'description' => 'Path to an image that will be used as a marker pin.',
            '#default_value' => isset($config['marker_icon_src']) ? $config['marker_icon_src'] : '',
        );
        $form['marker_icon_width'] = array(
            '#type' => 'number',
            '#title' => t('Marker Icon Width'),
            'description' => 'Icon width in pixels.',
            '#default_value' => isset($config['marker_icon_width']) ? $config['marker_icon_width'] : '',
        );
        $form['marker_icon_height'] = array(
            '#type' => 'number',
            '#title' => t('Marker Icon Height'),
            'description' => 'Icon height in pixels.',
            '#default_value' => isset($config['marker_icon_height']) ? $config['marker_icon_height'] : '',
        );
        $form['data_path'] = array(
            '#type' => 'number',
            '#title' => t('View Rest Path'),
            'description' => 'Rest Based url path',
            '#default_value' => isset($config['data_path']) ? $config['data_path'] : '',
        );
        return $form;
    }
    public function blockSubmit($form, FormStateInterface $form_state) {
        // Save our custom settings when the form is submitted.
        $this->setConfigurationValue('mapbox_id', $form_state->getValue('mapbox_id'));
        $this->setConfigurationValue('mapbox_accesstoken', $form_state->getValue('mapbox_accesstoken'));
        $this->setConfigurationValue('zoom_level', $form_state->getValue('zoom_level'));
        $this->setConfigurationValue('center', $form_state->getValue('center'));
        $this->setConfigurationValue('marker_popup', $form_state->getValue('marker_popup'));
        $this->setConfigurationValue('marker_view_mode', $form_state->getValue('marker_view_mode'));
        $this->setConfigurationValue('marker_legend', $form_state->getValue('marker_legend'));
        $this->setConfigurationValue('marker_cluster', $form_state->getValue('marker_cluster'));
        $this->setConfigurationValue('marker_proximity_search', $form_state->getValue('marker_proximity_search'));
        $this->setConfigurationValue('marker_anchor', $form_state->getValue('marker_anchor'));
        $this->setConfigurationValue('marker_filter', $form_state->getValue('marker_filter'));
        $this->setConfigurationValue('marker_filter_fields', $form_state->getValue('marker_filter_fields'));
        $this->setConfigurationValue('marker_icon_src', $form_state->getValue('marker_icon_src'));
        $this->setConfigurationValue('marker_icon_width', $form_state->getValue('marker_icon_width'));
        $this->setConfigurationValue('marker_icon_height', $form_state->getValue('marker_icon_height'));
        $this->setConfigurationValue('data_path', $form_state->getValue('data_path'));
    }

}
