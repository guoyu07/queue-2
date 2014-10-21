<?php
namespace Graze\Queue\Message;

class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $metadata;

    /**
     * @var callable
     */
    protected $validator;

    /**
     * @param string $body
     * @param array $metadata
     * @param callable $validator
     */
    public function __construct($body, array $metadata, callable $validator)
    {
        $this->body = (string) $body;
        $this->metadata = $metadata;
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * {@inheritdoc}
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * @return boolean
     */
    public function isValid()
    {
        return (boolean) call_user_func($this->validator, $this);
    }
}