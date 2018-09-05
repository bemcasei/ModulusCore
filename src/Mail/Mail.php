<?php

namespace ModulusCore\Mail;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\View\Model\ViewModel;

/**
 * Mail
 *
 * @category ModulusCore
 * @package Mail
 * @author William Hoffmann <williamhoffmann@outlook.com>
 */
class Mail
{
    /**
     * Mail SmtpTransport
     *
     * @var SmtpTransport
     */
    protected $transport;

    /**
     * @var $view
     */
    protected $view;

    /**
     * Mail body
     *
     * @var string
     */
    protected $body;

    /**
     * Mail message
     *
     * @var string
     */
    protected $message;

    /**
     * Mail subject
     *
     * @var string
     */
    protected $subject;

    /**
     * Mail from
     *
     * @var string
     */
    protected $from;

    /**
     * Mail to
     *
     * @var string
     */
    protected $to;

    /**
     * Mail data
     *
     * @var string
     */
    protected $data;

    /**
     * @var $page
     */
    protected $page;

    /**
     * Constructor
     *
     * @param SmtpTransport $transport
     * @param $view
     */
    public function __construct(SmtpTransport $transport, $view)
    {
        $this->transport = $transport;
        $this->view      = $view;
    }

    /**
     * Set page
     *
     * @param $page
     * @return $this
     */
    public function setPage($page)
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Set subject
     *
     * @param $subject
     * @return $this
     */
    function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Set from
     *
     * @param $from
     * @return $this
     */
    function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set to
     *
     * @param $to
     * @return $this
     */
    function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set data
     *
     * @param $data
     * @return $this
     */
    function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Render view
     *
     * @param $page
     * @param array $data
     * @return mixed
     */
    function renderView($page, array $data = [])
    {
        $model = new ViewModel();
        $model->setTemplate("mailer/{$page}.phtml")
            ->setOption('has_parent', true);

        if (count($data) > 0) {
            $model->setVariables($data);
        }

        return $this->view->render($model);
    }

    /**
     * Prepare
     *
     * @return $this
     */
    function prepare()
    {
        $html       = new MimePart($this->renderView($this->page, $this->data));
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->setParts([$html]);
        $this->body = $body;

        $config = $this->transport->getOptions()->toArray();

        $this->message = new Message();
        $this->message->addFrom(($this->from) ? $this->from : $config['connection_config']['from'])
            ->addTo($this->to)
            ->setSubject($this->subject)
            ->setBody($this->body)
            ->setEncoding('UTF-8');

        return $this;
    }

    /**
     * Send
     */
    function send()
    {
        $this->transport->send($this->message);
    }
}