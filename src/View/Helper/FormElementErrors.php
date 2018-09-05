<?php

namespace ModulusCore\View\Helper;

use Zend\Form\View\Helper\FormElementErrors as FormElementErrorsHelper;

/**
 * Form element erros
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class FormElementErrors extends FormElementErrorsHelper
{
    protected $messageOpenFormat      = '<small class="text-red">';
    protected $messageSeparatorString = '</small><br><small class="text-red">';
    protected $messageCloseString     = '</small>';
}
