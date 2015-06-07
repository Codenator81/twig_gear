<?php

/**
 * @file
 * Contains \Drupal\twig_gear\Twig\TwigGearExtension.
 */

namespace Drupal\twig_gear\Twig;

use Drupal\Core\Template\Attribute;

/**
 * Provides the helper function for Twig
 */
class TwigGearExtension extends \Twig_Extension {

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'twig_gear';
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('swapClass', array($this, 'swapClass')),
        );
    }

    /**
     * Swap CSS class in attribute if class exist
     * In this filter need pass two string where first is class which will be
     * removed and second class which will be added.
     * for example {{ item.attributes|swapClass('menu-item--active-trail', 'active') }}
     * @param $attribute Attribute
     * @param string[] $args, ...
     * @return Attribute
     */
    public function swapClass($attribute) {
        if (!$attribute instanceof Attribute) {
            return $attribute;
        }
        $args = func_get_args();
        if ($attribute->hasClass($args[1])) {
            $attribute->removeClass($args[1]);
            return $attribute->addClass($args[2]);
        }
        return $attribute;
    }
}