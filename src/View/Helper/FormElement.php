<?php

namespace ModulusCore\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\FormElement as FormElementHelper;

/**
 * Form element
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class FormElement extends FormElementHelper
{
    /**
     * Render
     *
     * @param ElementInterface $element
     * @return string
     */
    public function render(ElementInterface $element)
    {
        $errors = $element->getMessages();
        if (! empty($errors)) {
            $classes = $element->getAttribute('class');
            if (null === $classes) {
                $classes = [];
            }

            if (! is_array($classes)) {
                $classes = explode(' ', $classes);
            }

            $classes = array_unique(array_merge($classes, ['has-error']));
            $element->setAttribute('class', implode(' ', $classes));
        }

        return parent::render($element);
    }
}
