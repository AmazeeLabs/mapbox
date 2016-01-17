<?php

namespace Drupal\mapbox_bridge\Plugin\Field\MapboxType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * @FieldType(
 *   id = "MapBox",
 *   label = @Translation("MapBox field"),
 * )
 */

class MapboxType extends FieldItemBase implements FieldItemInterface {
    /**
     * {@inheritdoc}
     */
    public static function schema(FieldStorageDefinitionInterface $field_definition) {
        return array(
            'columns' => array(
                'value' => array(
                    'type' => 'text',
                    'size' => 'tiny',
                    'not null' => FALSE,
                ),
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
        $properties['value'] = DataDefinition::create('string');

        return $properties;
    }
}
?>