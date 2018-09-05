<?php

namespace ModulusCore\View\Helper;

use ModulusCore\Controller\Plugin\Format as FormatPlugin;
use Zend\View\Helper\AbstractHelper;

/**
 * Help format numbers in views
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class Format extends AbstractHelper
{
    /**
     * @var \ModulusCore\Controller\Plugin\Format
     */
    protected $pluginFormat;

    public function __invoke($value = null)
    {
        $this->getPluginFormat();
        if ($value == null) {
            return $this;
        }

        return $value;
    }

    /**
     * Return CPF formatted via plugin controller
     *
     * @param $cpf
     * @return string
     */
    public function cpf($cpf)
    {
        return $this->pluginFormat->cpf($cpf);
    }

    /**
     * Return CNPJ formatted via plugin controller
     *
     * @param $cnpj
     * @return string
     */
    public function cnpj($cnpj)
    {
        return $this->pluginFormat->cnpj($cnpj);
    }

    /**
     * Return CEP formatted via plugin controller
     *
     * @param $cep
     * @return string
     */
    public function cep($cep)
    {
        return $this->pluginFormat->cep($cep);
    }

    /**
     * Returns phone number formatted via plugin controller
     *
     * @param $number
     * @return string
     */
    public function phone($number)
    {
        return $this->pluginFormat->phone($number);
    }

    /**
     * Get pluginFormat
     *
     * @return \ModulusCore\Controller\Plugin\Format
     */
    protected function getPluginFormat()
    {
        if (null === $this->pluginFormat) {
            $this->setPluginFormat(new FormatPlugin());
        }

        return $this->pluginFormat;
    }

    /**
     * Set pluginFormat
     *
     * @param \ModulusCore\Controller\Plugin\Format $pluginFormat
     * @return $this
     */
    protected function setPluginFormat(FormatPlugin $pluginFormat)
    {
        $this->pluginFormat = $pluginFormat;

        return $this;
    }
}