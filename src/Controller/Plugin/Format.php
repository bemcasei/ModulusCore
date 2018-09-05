<?php

namespace ModulusCore\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Format
 *
 * @category ModulusCore
 * @package Controller\Plugin
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class Format extends AbstractPlugin
{
    /**
     * Format the CPF number for the format 999.999.999-99
     *
     * @param $cpf
     * @access public
     * @return string in the format '999.999.999-99'
     */
    public function cpf($cpf)
    {
        $cpf = preg_replace('/[^0-9]/', '', trim($cpf));
        if (strlen($cpf) != 11) {
            return $cpf;
        }

        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 3);
    }

    /**
     * Format the CNPJ number for the format 99.999.999/9999-99
     *
     * @param $cnpj
     * @access public
     * @return string in the format '99.999.999/9999-99'
     */
    public function cnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', trim($cnpj));
        if (strlen($cnpj) != 14) {
            return $cnpj;
        }

        return substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    }


    /**
     * Format the zip code number to 99999-999 format
     *
     * @param $cep
     * @access public
     * @return string in the format '99999-999'
     */
    public function cep($cep)
    {
        $cep = preg_replace('/[^0-9]/', '', trim($cep));
        if (strlen($cep) != 8) {
            return $cep;
        }

        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }

    /**
     * Formats the phone number to the format '(99) 9999-9999'
     * Allow new 9-digit numbers modified by Anatel to meet
     * Demand for the increase of new numbers in São Paulo
     * Serves for both 8- and 9-digit models
     *
     * @param $number
     * @access public
     * @return string in the format "(99)9999-9999" ou (99)99999-9999
     */
    public function phone($number)
    {
        $number = preg_replace('/[^0-9]/', '', trim($number));
        if (strlen($number) > 10) {
            $numberFormat = '(' . substr($number, 0, 2) . ')';
            $numberFormat .= substr($number, 2, 5) . '-';
            $numberFormat .= substr($number, 7, 4);

            return $numberFormat;
        } else {
            $numberFormat = '(' . substr($number, 0, 2) . ')';
            $numberFormat .= substr($number, 2, 4) . '-';
            $numberFormat .= substr($number, 6, 4);

            return $numberFormat;
        }
    }
}