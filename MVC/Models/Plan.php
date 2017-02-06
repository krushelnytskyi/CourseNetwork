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
     * User roles
     */
    const PLAN_ORDINARY  = 'ordinary';
    const PLAN_PREMIUM  = 'premium';
    const PLAN_SUPERPREMIUM  = 'superpremium';
  
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
   private $requestAmount; 
  
   /** 
    * @var int 
    * @column(skills_amount) 
    */ 
   private $skillsAmount; 
  
   /** 
    * @var int 
    * @column(follow_allow) 
    */ 
   private $followAllow; 
  
   /** 
    * @var int 
    * @column(article_allow) 
    */ 
   private $articleAllow; 
  
   /** 
    * @var int 
    * @column(project_amount) 
    */ 
   private $projectAmount; 
  
   /** 
    * @var boolean 
    * @column(for_freelancer) 
    */ 
   private $forFreelancer; 
  
   /** 
    * @var boolean 
    * @column(for_customer) 
    */ 
   private $forCustomer; 
  
   /** 
    * @return int 
    */ 
   public function getId()
   { 
     return $this->id; 
   } 
  
   /** 
    * @return string 
    */ 
   public function getName()
   { 
     return $this->name; 
   } 
  
   /** 
    * @return string 
    */ 
   public function getDescription()
   { 
     return $this->description; 
   } 
  
   /** 
    * @return int 
    */ 
   public function getRequestAmount()
   { 
     return $this->requestAmount; 
   } 
  
   /** 
    * @return int 
    */ 
   public function getSkillsAmount()
   { 
     return $this->skillsAmount; 
   } 
  
   /** 
    * @return int 
    */ 
   public function getFollowAllow() 
   { 
     return $this->followAllow; 
   } 
  
   /** 
    * @return int 
    */ 
   public function getArticleAllow()
   { 
     return $this->articleAllow; 
   } 
  
   /** 
    * @return int 
    */ 
   public function getProjectAmount() 
   { 
     return $this->projectAmount; 
   } 
  
   /** 
    * @return bool 
    */ 
   public function getForFreelancer()
   { 
     return $this->forFreelancer; 
   } 
  
   /** 
    * @return bool 
    */ 
   public function getForCustomer()
   { 
     return $this->forCustomer; 
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
    * @param int $requestAmount 
    */ 
   public function setRequestAmount($requestAmount) 
   { 
     $this->requestAmount = $requestAmount; 
   } 
  
   /** 
    * @param int $skillsAmount 
    */ 
   public function setSkillsAmount($skillsAmount) 
   { 
     $this->skillsAmount = $skillsAmount; 
   } 
  
   /** 
    * @param int $followAllow 
    */ 
   public function setFollowAllow($followAllow) 
   { 
     $this->followAllow = $followAllow; 
   } 
  
   /** 
    * @param int $articleAllow 
    */ 
   public function setArticleAllow($articleAllow) 
   { 
     $this->articleAllow = $articleAllow; 
   } 
  
   /** 
    * @param int $projectAmount 
    */ 
   public function setProjectAmount($projectAmount) 
   { 
     $this->projectAmount = $projectAmount; 
   } 
  
   /** 
    * @param bool $forFreelancer 
    */ 
   public function setForFreelancer($forFreelancer) 
   { 
     $this->forFreelancer = $forFreelancer; 
   } 
  
   /** 
    * @param bool $forCustomer 
    */ 
   public function setForCustomer($forCustomer) 
   { 
     $this->forCustomer = $forCustomer; 
   } 
  
 } 
