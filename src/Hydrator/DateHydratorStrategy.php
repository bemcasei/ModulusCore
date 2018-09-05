<?php

namespace ModulusCore\Hydrator;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

/**
 * Date hydrator format d/m/Y
 *
 * @category ModulusCore
 * @package Mail
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class DateHydratorStrategy extends DoctrineObject
{
    protected function handleTypeConversions($value, $typeOfField)
    {
        if ($typeOfField == 'date') {
            if ($value == "") {
                return null;
            } else {
                return \DateTime::createFromFormat('d/m/Y', $value);
            }
        }

        return parent::handleTypeConversions($value, $typeOfField);
    }
}
