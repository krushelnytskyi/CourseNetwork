ALTER TABLE `projects` ADD COLUMN
(
  `description` varchar(255) NOT NULL UNIQUE,
  `category` INT(3) NOT NULL,
  `work_type` varchar(124) DEFAULT 'Fixed Price',
	`requests_count` int(11) DEFAULT '0',
	`budget` int(7) DEFAULT '0',
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
