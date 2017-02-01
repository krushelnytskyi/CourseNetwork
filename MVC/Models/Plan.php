<?php
namespace MVC\Models;

/**
 * Class Plan
 * @package MVC\Models
 * @table(plans)
 */
class Plan
{

    /**
     * @var int
     * @column(id)
     */
    private $id;

    /**
     * @var string
     * @column(name)
     */
    private $name;

    /**
     * @var string
     * @column(description)
     */
    private $description;

    /**
     * @var int
     * @column(request_amount)
     */
    private $request_amount;

	/**
     * @var int
     * @column(skills_amount)
     */
    private $skills_amount;
	
	/**
     * @var int
     * @column(follow_allow)
     */
    private $follow_allow;
	
	/**
     * @var int
     * @column(article_allow)
     */
    private $article_allow;
	
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

	/**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
	
	/**
     * @return int
     */
    public function getRequest_Amount(): int
    {
        return $this->request_amount;
    }
	
	/**
     * @return int
     */
    public function getSkills_Amount(): int
    {
        return $this->skills_amount;
    }
	
	/**
     * @return int
     */
    public function getFollow_Allow(): int
    {
        return $this->follow_allow;
    }
	
	/**
     * @return int
     */
    public function getArticle_Allow(): int
    {
        return $this->article_allow;
    }
	
	/**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
	
	/**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
	
	/**
     * @param int $request_amount
     */
    public function setRequest_Amount($request_amount)
    {
        $this->request_amount = $request_amount;
    }
	
	/**
     * @param int $skills_amount
     */
    public function setSkills_Amount($skills_amount)
    {
        $this->skills_amount = $skills_amount;
    }
	
	/**
     * @param int $follow_allow
     */
    public function setFollow_Allow($follow_allow)
    {
        $this->follow_allow = $follow_allow;
    }
	
	/**
     * @param int $article_allow
     */
    public function setArticle_Allow($article_allow)
    {
        $this->article_allow = $article_allow;
    }
}
