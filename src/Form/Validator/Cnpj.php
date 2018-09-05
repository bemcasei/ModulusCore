<?php

namespace ModulusCore\Form\Validator;

use Zend\Filter\Digits;
use Zend\Validator\AbstractValidator;
use Zend\Validator\Exception;

/**
 * Validator CNPJ
 *
 * @category ModulusCore
 * @package Form\Validator
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class Cnpj extends AbstractValidator
{
    const INVALID = "CNPJInvalid";

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates  = [
        self::INVALID => 'CNPJ Inválido'
    ];

    /**
     * Returns true if and only if $value meets the validation requirements
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed
     *
     * @param  mixed $value
     * @return boolean
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($value)
    {
        $cnpj = $this->trimCNPJ($value);
        if ($this->respectsRegularExpression($cnpj) != 1) {
            $this->error(self::INVALID);
            return false;
        } else {
            $x = strlen($cnpj) - 2;
            if ($this->applyingCnpjRules($cnpj, $x) == 1) {
                $x = strlen($cnpj) - 1;
                if ($this->applyingCnpjRules($cnpj, $x) == 1) {
                    return true;
                } else {
                    $this->error(self::INVALID);
                    return false;
                }
            } else {
                $this->error(self::INVALID);
                return false;
            }
        }
    }

    /**
     * Trim CNPJ
     *
     * @param $cnpj
     * @return string
     */
    private function trimCNPJ($cnpj)
    {
        $digitsFilter = new Digits();
        return $digitsFilter->filter($cnpj);
    }

    /**
     * Respects regular expression
     *
     * @param $cnpj
     * @return bool
     */
    private function respectsRegularExpression($cnpj)
    {
        $regularExpression = "[0-9]{2,3}\\.?[0-9]{3}\\.?[0-9]{3}/?[0-9]{4}-?[0-9]{2}";
        if (! preg_match("#" . $regularExpression . "#", $cnpj)) {
            return false;
        }

        return true;
    }

    /**
     * Applying CNPJ rules
     *
     * @param $cnpj
     * @param $x
     * @return bool
     */
    private function applyingCnpjRules($cnpj, $x)
    {
        $verCNPJ = 0;
        $ind = 2;

        for ($y = $x; $y > 0; $y--) {
            $verCNPJ += (int) substr($cnpj, $y - 1, 1) * $ind;
            if ($ind > 8) {
                $ind = 2;
            } else {
                $ind++;
            }
        }

        $verCNPJ %= 11;
        if (($verCNPJ == 0) || ($verCNPJ == 1)) {
            $verCNPJ = 0;
        } else {
            $verCNPJ = 11 - $verCNPJ;
        }
        if ($verCNPJ != (int) substr($cnpj, $x, 1)) {
            return false;
        } else {
            return true;
        }
    }
}
