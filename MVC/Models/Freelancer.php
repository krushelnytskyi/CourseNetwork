<?php

namespace MVC\Models;

use System\ORM\Repository;

/**
 * Class Freelancer
 * @package MVC\Models
 * @table(freelancers)
 */
class Freelancer
{

    /**
     * @var int
     * @column(id)
     */
    private $id;

    /**
     * @var float
     * @column(rate)
     */
    private $rate;

    /**
     * @var int
     * @column(plan_id)
     */
    private $plan;

    /**
     * @var int
     * @column(user_id)
     */
    private $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return Plan|null
     */
    public function getPlan()
    {
        $repo = new Repository('\MVC\Models\Plan');

        return $repo->findOneBy(
            [
                'id' => $this->plan
            ]
        );
    }

    /**
     * @return User|null
     */
    public function getUser()
    {
        $repo = new Repository(User::class);

        return $repo->findOneBy([
            'id' => $this->user
        ]);
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate)
    {
        $this->rate = $rate;
    }

    /**
     * @param int $plan
     */
    public function setPlan(int $plan)
    {
        $this->plan = $plan;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user)
    {
        $this->user = $user;
    }
}