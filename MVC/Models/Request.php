<?php

    namespace MVC\Models;

    use System\ORM\Repository;

    /**
    * Class Requests
    * @package MVC\Models
    * @table(requests)
    */
class Request
{

    /**
    * @var int
    * @column(id)
    */
    private $id;

    /**
    * @var int
    * @column(project_id)
    */
    private $projectId;

    /**
    * @var int
    * @column(freelancer_id)
    */
    private $freelancerId;

    /**
    * @var string
    * @column(request_text)
    */
    private $requestText;

    /**
    * @var float
    * @column(rate)
    */
    private $rate;

    /**
     * @var int
     * @column(deadline)
     */
    private $deadline;

    /**
    * @return int
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * @return \MVC\Models\Project
    */
    public function getProjectId()
    {
        $repo = new Repository( Project::class );

        return $repo -> findOneBy( [
            'id' => $this->projectId
          ] );
    }

    /**
    * @return \MVC\Models\Freelancer
    */
    public function getFreelancerId()
    {
        $repo = new Repository(Freelancer::class);

        return $repo->findOneBy( [
            'id' => $this -> freelancerId
          ] );
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return int
     */
    public function getDeadline(): int
    {
        return $this->deadline;
    }

    /**
     * @return string
     */
    public function getRequestText(): string
    {
        return $this->requestText;
    }

    /**
     * @param int $deadline
     */
    public function setDeadline(int $deadline)
    {
        $this->deadline = $deadline;
    }

    /**


    /**
     * @param int $freelancerId
     */
    public function setFreelancerId(int $freelancerId)
    {
        $this->freelancerId = $freelancerId;
    }

    /**
     * @param int $projectId
     */
    public function setProjectId(int $projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate)
    {
        $this->rate = $rate;
    }

    /**
     * @param string $requestText
     */
    public function setRequestText(string $requestText)
    {
        $this->requestText = $requestText;
    }

}
