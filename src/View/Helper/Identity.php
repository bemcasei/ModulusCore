<?php

namespace ModulusCore\View\Helper;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\View\Helper\AbstractHelper;

/**
 * Helper that includes session in views
 *
 * @category ModulusCore
 * @package View\Helper
 * @author  William Hoffmann <williamhoffmann@outlook.com>
 */
class Identity extends AbstractHelper
{
    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @param null $namespace
     * @return bool|mixed|null
     */
    public function __invoke($namespace = null)
    {
        $sessionStorage    = new SessionStorage($namespace);
        $this->authService = new AuthenticationService();
        $this->authService->setStorage($sessionStorage);

        if ($this->getAuthService()->hasIdentity()) {
            return $this->getAuthService()->getIdentity();
        } else {
            return false;
        }
    }

    /**
     * Get authService
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }
}