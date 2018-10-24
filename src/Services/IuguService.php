<?php

namespace ModulusCore\Services;

use Iugu\Sdk\Iugu;

/**
 * Iugu
 *
 * @category ModulusCore
 * @package Services
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class IuguService
{
    /**
     * @var Iugu
     */
    protected $iuguSdk;

    /**
     * Constructor
     *
     * @param Iugu $iuguSdk
     */
    public function __construct(Iugu $iuguSdk)
    {
        $this->iuguSdk = $iuguSdk;
    }

    /**
     * Client
     *
     * @return Iugu
     */
    public function client()
    {
        return $this->iuguSdk;
    }
}