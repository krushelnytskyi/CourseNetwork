ALTER TABLE `projects` ADD COLUMN
(
  `description` varchar(255) NOT NULL UNIQUE,
  `category` INT(3) NOT NULL,
  `work_type` varchar(124) DEFAULT 'Fixed Price',
	`requests_count` int(11) DEFAULT '0',
	`budget` decimal(4,2) DEFAULT '0'
);

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

ALTER TABLE `plans`
  DROP `skills_amount`,
  DROP `follow_allow`,
  DROP `article_allow`,
  DROP `for_freelancer`,
  DROP `for_customer`;

ALTER TABLE `plans` ADD COLUMN
(
  `price` decimal(4,2) DEFAULT '0',
  `role` varchar(255) DEFAULT '0'
);

INSERT INTO `plans` (`id`, `name`, `description`, `price`, `role`, `request_amount`, `project_amount`) VALUES
(NULL, 'Free', 'You can publish 8 projects per month', '0', 'customer', '0', '8'),
(NULL, 'Silver', 'You can publish 32 projects per month', '29.99', 'customer', '0', '32'),
(NULL, 'Gold', 'You can publish 64 projects per month', '39.99', 'customer', '0', '64'),
(NULL, 'Professional', 'You can publish unlimited projects per month', '59.99', 'customer', '0', '99999'),
(NULL, 'Basic', 'You can apply 8 requests per month', '0', 'freelancer', '8', '0'),
(NULL, 'Medium', 'You can apply 32 requests per month', '19.99', 'freelancer', '32', '0'),
(NULL, 'Advantage', 'You can apply 64 requests per month', '29.99', 'freelancer', '64', '0'),
(NULL, 'Unlimited', 'You can apply unlimited requests per month', '59.99', 'freelancer', '99999', '0');


INSERT INTO `projects` (`id`, `name`, `description`, `category`, `work_type`, `requests_count`, `created`, `start`, `finish`, `status`, `budget`, `paid`, `freelancer`, `customer`) VALUES
(1, 'I would like to hire a WordPress Developer', 'I am after someone that can develop a word press themed based off another website. Its a very simple site, 4 pages max. Will provide the site reference once the job is acceptedrnrnOn one of the pages I would also like built in a module that currently sits another site. See this Page here [url removed, login to view] Its the our people module they have in which I would like on my site also under our people.rnrnIn terms of style guide. I have fonts and colours to provide that need to be incorporated throughout', 2, 'fixed-price', 0, '2017-02-16 08:38:55', NULL, NULL, 0, 250, 0, NULL, 1),
(2, 'Build a Website', 'I\\''m looking for a e-commerce, realised in Prestashop. I am a small company and would want something personalised, with an affordable price. I have a very clear idea of what I want, so maybe it will be needed to write a personalised template as I didn\\''t find anything that could work for me.', 2, 'per-hour', 0, '2017-02-16 08:45:26', NULL, NULL, 0, 1000, 0, NULL, 1),
(3, 'Build a website from template examples in html5+css+automatic data updating from XML feed', 'Design a website like in attached files. It will include also a search engine with drop down list like in trivago dot com website. The website will automatically update articles from other website feeds, together with photo and other digit data from XML files. The website will be an approximate full screen one, with a search bar at its\\'' bottom. The full screen image will be updated from a list of uploaded images, depending on the selected location. Some animation like in the attached video is also required (video time from second 09-14 and 0,36min-0,40min )', 2, 'fixed-price', 0, '2017-02-16 09:07:30', NULL, NULL, 0, 200, 0, NULL, 1),
(4, 'I need some changes to an existing website', 'I need some changes to an existing website. I want to transfer to shopify from woocommerce no products on website just to change the admin and site layout.', 2, 'fixed-price', 0, '2017-02-16 09:18:33', NULL, NULL, 0, 20, 0, NULL, 1),
(5, 'Hire a Logo Designer', 'I am an fairly new independent yoga teacher who is looking to update/ streamline my business logo.rnrnI have a black and white vector image that is a rough design. It needs to be sharpened and improved. Adding in colour, streamlining the letters and updating the overall visual.rnrnThe finished logo needs to be reusable, resizable and timeless. Something that has a transparent background so that it is versatile.rnrnThe timeframe for this project is flexible, but ideally it should be completed by the end of April.', 1, 'fixed-price', 0, '2017-02-16 09:20:35', NULL, NULL, 0, 250, 0, NULL, 1),
(6, 'web designing', 'I have domain name from [url removed, login to view] now want to design a website to be up there. its Online law journal, which i need to update every month or so, design i am expecting to be similar to [url removed, login to view] With necessary changes. I MUST BE ABLE TO UPLOAD THE STUFF WITHOUT THE KNOWLEDGE OF ANY COMPUTER LANGUAGES/CODES', 1, 'fixed-price', 0, '2017-02-16 09:21:25', NULL, NULL, 0, 3500, 0, NULL, 1),
(7, 'Design a company logo', 'I need a Graphic Designer to design a logo for a freelance event and merchandising start up business in the fashion industry.rnrnI would like to complete the project within a week', 1, 'per-hour', 0, '2017-02-16 09:22:30', NULL, NULL, 0, 150, 0, NULL, 1),
(8, 'Youtube Video Editing', 'I will be needing a makeup tutorial of about 20 minutes in duration edited to about 10-15minutes. This will be an ongoing project, one video a week (for now), if I am happy with the work received. So this would be 1 hour of work a week (about $7/hr).rnrnProject Details:rnrnSome of the videos will be a talk through of the makeup application and others I will do a separate voice over recording which will then need to be added to the video.rnrnSimple Requirements:rnrn- Cutting, smooth transitioning and speeding up of some partsrnrn- Adding some text descriptions of products used when I display them in the videornrn- Adding some soft background musicrnrn- Adding an intro pic of my channel and an exit pic with my website and social media infornrnI have one video uploaded on my channel which I edited and I have some other examples of makeup videos as a reference.', 3, 'per-hour', 0, '2017-02-16 09:24:22', NULL, NULL, 0, 8, 0, NULL, 1),
(9, 'Create a Video Testimonial 30 seconds', 'We are looking for Talented actors to record around 30 seconds testimonial speaking about the benefit of a product. We are looking for native English speaking actors for the testimonials with a good portfolio of past projects and samples.rnrnWhen applying please mention your delivery timeline and what sorts of retakes or edits do you allow in the deliverable. Also what kind of recording would you be providing, the camera used, video resolution and format and do you provide options for dress code options and would you be doing these testimonials on a Green screen if not please share image or samples of your recording area for consideration.rnrnWe would be hiring around 5 different talents for this job so please send your portfolio with past testimonial examples for review and selection. Once a suitable candidate has been found we would share the product script and directions which you could review and confirm any other details so we could get started with the work', 3, 'fixed-price', 0, '2017-02-16 09:25:36', NULL, NULL, 0, 300, 0, NULL, 1),
(10, 'Mobile development', 'I need an Android app. I already have a design for it, I just need it to be built. My project is to collect html data from 4-7 websites into database and present this data in android app according to numbers of rules. Because it\\''s html data collection, the code needs to use some &quot;try and catch&quot; mechanism. Also, Should be some service, every 10 min, that monitors whether the data in each website has been updated and update the DB. The all process needs to be automatic. I would be happy to receive relevant offers.', 5, 'fixed-price', 0, '2017-02-16 09:29:01', NULL, NULL, 0, 500, 0, NULL, 1),
(11, 'iPhone/iPad App', 'I need an iPhone/iPad app. I would like it designed and built. I would like to build a social poker application using play chips with some additional features such as coaching. I would like it to be running on iPhone, iPad and android.rnrnIt should use unity3d engine.rnrnDetails can be discussed further', 5, 'fixed-price', 0, '2017-02-16 09:30:18', NULL, NULL, 0, 5500, 0, NULL, 1),
(12, 'I would like to hire a Social Media Marketer', 'Hi, we are launching a new brand and product on the market in the fast food industry. Target market is teenagers to late 20\\''s with disposable income willing to spend more on something different. Must have strong social media component to build interest amongst target market and develop brand recognition', 4, 'fixed-price', 0, '2017-02-16 09:32:41', NULL, NULL, 0, 500, 0, NULL, 1),
(13, 'Stack Developer Req to Install &amp; Customize App Store Script', 'We require a Stack Web Developer to install and customise an App Store Script.rnrnOur budget is $150 to $200 MAXIMUM for this project. We will be doing a lot more work on this website over the next 6 to 9 months. Therefore we are looking for a Freelancer to work with on a long term basis who is looking for regular work, on a monthly basis to work on this project. We need someone to start working on this project IMMEDIATELY.rnrnWe have an open source App Store Script. It is normally used by Organisations to distribute apps internally within their Company. The script has no shopping cart. We are therefore customising this Java/JSP script to sell apps publicly by adding a Wordpress Shopping Cart on the frontend. The App Store Script consist of 3 elements. It has 1) A Gateway 2) A Publisher and 3) A Storefront. The script is a fully functioning script which is ready to run from \\''out of the box\\''.rnrnYou will NOT be building the script from scratch. You will simply be using Java, JSP, PHP, Wordpress and any other coding, programming and Web Development skills to customise the script. Server maintenance + sever management + server security skills will also be an advantage when working on this project as we will be hosting and installing the script on our Linux VPS server.rnrnTASKS WILL INCLUDE THE FOLLOWING:rnrn1. You will download and install script on our dedicated OR VPS sever. We will send you a link to the App Store script, including documentation after you bid and send us a PM.rnrn2. You will add categories and sub categories to the storernrn3. You will design logo and/or header banner for storernrn4. You will install + configure Woocommerce shopping cart + configure PayPalrnrn5. You will install + configure Wordpress Loyalty Points pluginrnrn6. You will install + configure Wordpress security pluginrnrn7. We will give you a few apps to test publishing to store, test sale via shopping cart and test installation of app after salernrnPLEASE ALSO SEE DETAILED &quot;WORK FLOW&quot; DOCUMENT WE HAVE UPLOADED TO THIS PROJECT.rnrnOur budget is $150 to $200 MAXIMUM for this project and we need the project completed within 5 days.rnrnPlease remember THIS IS LONG TERM PROJECT and is suitable for a Web Developer looking for for regular projects on a weekly or monthly basis.rnrnPlease leave PM if interested', 6, 'fixed-price', 0, '2017-02-16 09:41:58', NULL, NULL, 0, 3000, 0, NULL, 1),
(14, 'TV Streaming Interface for Television Screens', 'Need a tv interface app for Roku or Smart TV or HDMI stick. I want to offer my customers a tv screen interface. my product is a Christian tv and movie streaming service. i want to have an interface to run on a tv screen.', 6, 'fixed-price', 0, '2017-02-16 09:47:25', NULL, NULL, 0, 150, 0, NULL, 1),
(15, 'Jira Report Gadgets', 'I need you to develop some software for me. I would like this software to be developed using Java. Develop multiple report gadgets as a Jira plugin. This data comes directly from the Jira APIs and would be sourced by a saved JQL filter.', 6, 'fixed-price', 0, '2017-02-16 09:48:11', NULL, NULL, 0, 1800, 0, NULL, 1),
(16, 'Write some Articles', 'We need Hindi Articles on the continuous basis. The length of the article will be 800 words and We will pay you Rs. 100 per article fixed. Apply only if you agree with the rates', 7, 'per-hour', 0, '2017-02-16 09:49:43', NULL, NULL, 0, 8, 0, NULL, 1),
(17, 'Translation of Product Brochure for Export to China', 'I need a translation. I am a liquor retailer exporting wine, beer and spirits to China. I have a product brochure with product descriptions that I need translated from English to Mandarin.', 7, 'fixed-price', 0, '2017-02-16 09:50:48', NULL, NULL, 0, 30, 0, NULL, 1),
(18, 'I would like to hire an Artist', 'We run a large residential high rise building called Orion Living. What we need is a newsletter produced once every 3 months. We have all the assets logo/colour palette etc ready to go. This was all done professionally by the developer when the building was opened a few months ago. Check us out at www.orionliving.com.au. We have taken over the management and wish to do a relatively low cost Newsletter. It will mostly be emailed as a pdf to apartment owners plus a small print quantity as well. Probably 6 or 7 articles each time with accompanying (happy snap) photos. What we want to do is continue the same look and feel (without going over the top). Just as neat and professional as possible (taking into account that we won\\''t have professional photos).', 8, 'fixed-price', 0, '2017-02-16 09:52:19', NULL, NULL, 0, 230, 0, NULL, 1);

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created`, `balance`, `plan_id`, `site`, `phone`, `skype`, `avatar`) VALUES
(1, 'Christina', 'kristolukky@gmail.com', '$2y$12$25f9e794323b453885f51uL.pW85W9dkveiH2oY6967tRv5Wl4pr2', 'customer', '2017-02-16 08:36:22', NULL, 1, NULL, NULL, NULL, NULL),
(2, 'John Smit', 'fajnuj@gmail.com', '$2y$12$6ebe76c9fb411be97b3b0OFyF/eSyiWlo2DsibXJIguNFJYUP5DT.', 'customer', '2017-02-16 10:07:42', NULL, 1, NULL, NULL, NULL, NULL),
(3, 'Prynduk', 'fajnuj_p@gmail.com', '$2y$12$6ebe76c9fb411be97b3b0OFyF/eSyiWlo2DsibXJIguNFJYUP5DT.', 'customer', '2017-02-16 10:20:37', NULL, 1, NULL, NULL, NULL, NULL),
(4, 'Mickle Fun', 'mickle@gmail.com', '$2y$12$9fab6755cd2e8817d3e73OyzJvUfdX08tQiWzhm/fpgv2y5i17UoS', 'freelancer', '2017-02-16 10:43:06', NULL, 1, NULL, NULL, NULL, NULL),
(5, 'Asan Bridge', 'asan@gmail.com', '$2y$12$9fab6755cd2e8817d3e73OyzJvUfdX08tQiWzhm/fpgv2y5i17UoS', 'freelancer', '2017-02-16 10:45:37', NULL, 1, NULL, NULL, NULL, NULL),
(6, 'Adam Sam', 'adam@gmail.com', '$2y$12$9fab6755cd2e8817d3e73OyzJvUfdX08tQiWzhm/fpgv2y5i17UoS', 'freelancer', '2017-02-16 10:47:01', NULL, 1, NULL, NULL, NULL, NULL);

INSERT INTO `customers` (`id`, `user_id`, `rating`, `plan_id`, `project_balance`) VALUES
(1, 1, NULL, NULL, 8),
(2, 2, NULL, NULL, 8),
(3, 3, NULL, NULL, 8);

INSERT INTO `freelancers` (`id`, `user_id`, `rate`, `rating`, `job_count`, `plan_id`, `status`, `category_id`, `request_balance`, `description`) VALUES
(1, 4, '11.00', '5.00', 0, 6, NULL, 2, 8, 'We are high class professional designers, expert developers and flawless QA Testers in Theme and Template designing; CMS like Wordpress, Joomla, Drupal; Ecommerce like Magento, Opencart, Woocommerce, Virtuemart; on MVC 5/6; PHP on CI, Yii, Symphony, Zend, Laravel frameworks; Apps in Android and IOS platforms.'),
(2, 5, '20.00', '5.00', 0, 6, NULL, 6, 8, 'We are a team of designers and developers. Our expertise are WordPress, Joomla ,PHP, Magento , PrestaShop ,Shopify ,Osclass , Opencart ,MySql : Responsive theme development,Theme customization, Child Theme, Plugin Development, Multi stie, Membership site, Backup and Restore at different domain and a lot more'),
(3, 6, '15.00', '5.00', 0, 7, NULL, 2, 8, 'We specializes in custom e-commerce store development. We have an elite team of 20+ experienced and dedicated developers who are ready to go that extra mile to deliver you 100% unique web solutions that are sure to lure customers. Our commitment and dedication to excellence has helped us offer our customers the ');


ALTER TABLE `customers` ADD COLUMN
(
  `project_balance` int(11) DEFAULT '8'
);

ALTER TABLE `freelancers` ADD COLUMN
(
  `request_balance` int(11) DEFAULT '8'
);

ALTER TABLE `requests` ADD COLUMN
(
  `deadline` int(11) NOT NULL
);

ALTER TABLE `categories` ADD COLUMN
(
  `count_freelancers` int(11) DEFAULT '0'
);

ALTER TABLE `freelancers` ADD COLUMN
(
  `description` TEXT
);


