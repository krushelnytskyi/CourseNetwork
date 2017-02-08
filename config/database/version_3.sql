ALTER TABLE `projects` ADD COLUMN
(
  `description` varchar(255) NOT NULL UNIQUE,
  `category` INT(3) NOT NULL,
  `work_type` varchar(124) DEFAULT 'Fixed Price',
	`requests_count` int(11) DEFAULT '0',
	`budget` decimal(4,2) DEFAULT '0',
) 
AFTER `name`;

ALTER TABLE `categories` ADD COLUMN (`count` int(11) DEFAULT '0');



INSERT INTO `categories` (`id`, `name`, `description`) VALUES 
(NULL, 'Design', 'Design logos and printed collateral, plan marketing and print anything that can be printed! From business cards to apparel, to floor & wall graphics or even flip-flops.'),
(NULL, 'Web Development', 'Web development is a broad term for the work involved in developing a web site for the Internet (World Wide Web) or an intranet (a private network). Web development can range from developing the simplest static single page of plain text to the most complex web-based internet applications, electronic businesses, and social network services.'),
(NULL, 'Video photo & audio', 'As long as you have a web browser that connects to the Internet, you can find multimedia editors to get your photos, audio files or even videos edited on the fly. '),
(NULL, 'Marketing & PR', 'Most people – even communication pros – find it difficult to distinguish marketing from public relations.'),
(NULL, 'Mobile Development', 'Mobile application development is a term used to denote the act or process by which application software is developed for mobile devices, such as personal digital assistants, enterprise digital assistants or mobile phones.'),
(NULL, 'Software Development', 'Software development is the process of computer programming, documenting, testing, and bug fixing involved in creating and maintaining applications and frameworks resulting in a software product.'),
(NULL, 'Translations', 'Translation is the communication of the meaning of a source-language text by means of an equivalent target-language text. While interpreting—the facilitating of oral or sign-language communication between users of different languages—antedates writing, translation began only after the appearance of written literature.'),
(NULL, 'Creative Arts', 'We specialise in subjects across the creative arts, with courses covering fashion, film, photography and animation being particularly well recognised both .');

ALTER TABLE `plans` DROP COLUMN
(
  `skills_amount`,
  `follow_allow`,
  `article_allow`,
  `for_freelancer`,
  `for_customer`,
)

ALTER TABLE `plans` ADD COLUMN
(
  `price` decimal(4,2) DEFAULT '0',
  `role` varchar(255) DEFAULT '0',
)
AFTER `description`;

INSERT INTO `plans` (`id`, `name`, `description`, `price`, `role`, `request_amount`, `project_amount`) VALUES
(NULL, 'Free', 'You can publish 8 projects per month', '0', 'customer', '0', '8'),
(NULL, 'Silver', 'You can publish 32 projects per month', '29.99', 'customer', '0', '32'),
(NULL, 'Gold', 'You can publish 64 projects per month', '39.99', 'customer', '0', '64'),
(NULL, 'Professional', 'You can publish unlimited projects per month', '59.99', 'customer', '0', '99999'),
(NULL, 'Free', 'You can apply 8 requests per month', '0', 'freelancer', '8', '0'),
(NULL, 'Basic', 'You can apply 32 requests per month', '19.99', 'freelancer', '32', '0'),
(NULL, 'Medium', 'You can apply 64 requests per month', '29.99', 'freelancer', '64', '0'),
(NULL, 'Unlimited', 'You can apply unlimited requests per month', '59.99', 'freelancer', '99999', '0');

ALTER TABLE `customers` ADD COLUMN
(
  `project_balance` int(11) DEFAULT '8',
);

ALTER TABLE `freelancers` ADD COLUMN
(
  `request_balance` int(11) DEFAULT '8',
);



