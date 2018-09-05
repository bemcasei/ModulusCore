<?php

namespace ModulusCore\Controller\Plugin;

use Zend\Crypt\BlockCipher;
use Zend\Http\Header\SetCookie;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Cookie
 *
 * @category ModulusCore
 * @package Controller\Plugin
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class Cookie extends AbstractPlugin
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var Response
     */
    protected $response;

    /**
     * Constructor
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request  = $request;
        $this->response = $response;
    }

    /**
     * @param $key
     * @param null $value
     * @param null $expire
     * @param bool $isEncrypted
     * @return bool|string
     */
    public function __invoke($key, $value = null, $expire = null, $isEncrypted = true)
    {
        if (! $value) {
            $value = $this->request->getHeaders()->get('Cookie')->{$key};
            return ($isEncrypted == true) ? $this->decrypted($value) : $value;
        }

        $cookie  = new SetCookie($key, ($isEncrypted == true) ? $this->encrypted($value) : $value, $expire);
        $headers = $this->response->getHeaders();

        $headers->addHeader($cookie);

        return true;
    }

    /**
     * Encrypted cookie
     *
     * @param $cookie
     * @return string
     */
    private function encrypted($cookie)
    {
        $blockCipher = BlockCipher::factory('mcrypt', ['algo' => 'aes']);
        $blockCipher->setKey('a1w2b4c6v7b6fcdbatyr');

        return $blockCipher->encrypt($cookie);
    }

    /**
     * Decrypted cookie
     *
     * @param $cookie
     * @return bool|string
     */
    private function decrypted($cookie)
    {
        $blockCipher = BlockCipher::factory('mcrypt', ['algo' => 'aes']);
        $blockCipher->setKey('a1w2b4c6v7b6fcdbatyr');

        return $blockCipher->decrypt($cookie);
    }
}
