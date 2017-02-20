<?php

    namespace MVC\Models;

    use System\ORM\Repository;

    /**
    * Class Freelancers
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
     * @var int
     * @column(user_id)
     */
    private $user;

    /**
     * @var string
     * @column(description)
     */
    private $description;

    /**
     * @var float
     * @column(rate)
     */
    private $rate;

    /**
     * @var float
     * @column(rating)
     */
    private $rating;

    /**
     * @var int
     * @column(job_count)
     */
    private $jobCount;

    /**
     * @var int
     * @column(plan_id)
     */
    private $plan;

    /**
     * @var int
     * @column(status)
     */
    private $status;

    /**
     * @var int
     * @column(request_balance)
     */
    private $requestBalance;

    /**
     * @var int
     * @column(category_id)
     */
    private $category;

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int)$this->id;
    }

    /**
     * @return \MVC\Models\Category
     */
    public function getCategory()
    {
        $repo = new Repository(Category::class);

        return $repo -> findOneBy( [
            'id' => $this->category
        ] );
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getJobCount():int
    {
        return (int)$this->jobCount;
    }

    /**
     * @return \MVC\Models\Plan
     */
    public function getPlan()
    {
        $repo = new Repository(Plan::class);

        return $repo -> findOneBy( [
            'id' => $this->plan
        ] );
    }

    /**
     * @return float
     */
    public function getRating():float
    {
        return (float)$this->rating;
    }

    /**
     * @return float
     */
    public function getRate():float
    {
        return (float)$this->rate;
    }

    /**
     * @return int
     */
    public function getRequestBalance():int
    {
        return (int)$this->requestBalance;
    }

    /**
     * @return int
     */
    public function getStatus():int
    {
        return (int)$this->status;
    }

    /**
     * @return \MVC\Models\User
     */
    public function getUser(): User
    {
        $repo = new Repository(User::class);

        return $repo -> findOneBy( [
            'id' => $this->user
        ] );
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate)
    {
        $this->rate = (float)$rate;
    }

    /**
     * @param int $user
     */
    public function setUser(int $user)
    {
        $this->user = (int)$user;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category)
    {
        $this->category = (int)$category;
    }

    /**
     * @param int $plan
     */
    public function setPlan(int $plan)
    {
        $this->plan = (int)$plan;
    }

    /**
     * @param float $rating
     */
    public function setRating(float $rating)
    {
        $this->rating = (float)$rating;
    }

    /**
     * @param int $jobCount
     */
    public function setJobCount(int $jobCount)
    {
        $this->jobCount = (int)$jobCount;
    }

    /**
     * @param int $requestBalance
     */
    public function setRequestBalance(int $requestBalance)
    {
        $this->requestBalance = (int)$requestBalance;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = (int)$status;
    }

}
