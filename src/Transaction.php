<?php

namespace Gamesmkt\Fishpond;

use Gamesmkt\Fishpond\PlayerInterface;
use Gamesmkt\Fishpond\TransactionInterface;
use InvalidArgumentException;

class Transaction implements TransactionInterface
{
    /** @var int */
    private $method;

    /** @var \Gamesmkt\Fishpond\PlayerInterface */
    private $user;

    /** @var string */
    private $id;

    /** @var string */
    private $amount;

    /** @var int */
    private $status;

    /**
     * @param int $method Transaction method
     * @param \Gamesmkt\Fishpond\PlayerInterface $user The user
     * @param string $id Id
     * @param string $amount Amount
     * @param string $status Status
     */
    public function __construct(
        int $method,
        PlayerInterface $user,
        string $id,
        string $amount,
        int $status
    ) {
        $this->assertMethod($method);
        $this->assertStatus($status);

        $this->method = $method;
        $this->user = $user;
        $this->id = $id;
        $this->amount = $amount;
        $this->status = $status;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function withStatus($status)
    {
        $this->assertStatus($status);
        $new = clone $this;
        $new->status = $status;
        return $new;
    }

    private function assertMethod($method)
    {
        if (!is_int($method) || $method <= 0) {
            throw new InvalidArgumentException('Method must be an integer and more then zero.');
        }

        switch ($method) {
            case self::METHOD_DEPOSIT:
                break;
            case self::METHOD_WITHDRAW:
                break;
            default:
                throw new InvalidArgumentException("Not support [$method] method.");
        }
    }

    private function assertStatus($status)
    {
        if (!is_int($status) || $status <= 0) {
            throw new InvalidArgumentException('Status must be an integer and more then zero.');
        }

        switch ($status) {
            case self::STATUS_PENDDING:
                break;
            case self::STATUS_COMPLETE:
                break;
            case self::STATUS_FAILED:
                break;
            case self::STATUS_ERROR:
                break;
            default:
                throw new InvalidArgumentException("Not support [$status] status.");
        }
    }
}
