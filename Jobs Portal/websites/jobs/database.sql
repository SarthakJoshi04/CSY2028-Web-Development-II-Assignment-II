-- Adminer 4.8.1 MySQL 11.3.2-MariaDB-1:11.3.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `applicants`;
CREATE TABLE `applicants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `details` longblob DEFAULT NULL,
  `jobId` int(11) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `applicants` (`id`, `name`, `email`, `details`, `jobId`, `cv`) VALUES
(13,	'Sarthak Joshi',	'demo@demo.com',	'Cover Letter',	6,	'663a4377ef043.txt');

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`) VALUES
(1,	'IT'),
(2,	'Human Resources'),
(4,	'Sales'),
(5,	'Finance and Accounting'),
(6,	'Media & Entertainment'),
(9,	'Legal');

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `clients` (`client_id`, `username`, `password`) VALUES
(8,	'client1',	'$2y$10$xiXK9p1F9uogDkxlFCq8sOA/PoUXAG0NKvjaPP9vDWchvDezDvzka'),
(9,	'client2',	'$2y$10$uYFzfOhhGqOGZugsZTLMlu6JC8URn/c/k9ix3ZckfQhvKcdJYbrsy'),
(10,	'client3',	'$2y$10$ETg6eQRyRbEwfVbSZF1zvuueZmuL8BZ.f4cFblwkUptuO0w8BwObq');

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `enquiry` longblob NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `completedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `enquiries` (`id`, `first_name`, `last_name`, `email`, `telephone`, `enquiry`, `status`, `completedBy`) VALUES
(1,	'Steve',	'Jobs',	'jobs.steve@demo.com',	'343-564-789',	'I am unemployed.',	'Completed',	4),
(2,	'John',	'Son',	'abcd@demo.com',	'123-556-008',	'Text',	'Pending',	NULL),
(3,	'Hina',	'Choi',	'choi.hina@demo.com',	'334-564-778',	'I have a question',	'Pending',	NULL),
(4,	'Starc',	'Cummins',	'winner@demo.com',	'213-422-321',	'I have another question',	'Pending',	NULL),
(5,	'Ino',	'Stone',	'rock.ino@demo.com',	'212-342-123',	'Hello',	'Pending',	NULL);

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `description` longblob DEFAULT NULL,
  `salary` varchar(45) DEFAULT NULL,
  `postedDate` date DEFAULT NULL,
  `closingDate` date DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `clientId` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `isArchive` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `jobs` (`id`, `title`, `description`, `salary`, `postedDate`, `closingDate`, `categoryId`, `clientId`, `location`, `isArchive`) VALUES
(3,	'First Level Tech Support',	'To work alongside the IT field based team in one of our acute Hospital sites. This team provides high quality equipment installation, technical support and advisory services for EKHUFT staff. They proactively manage incidents and requests, accepting ownership, evaluating, resolving and enabling the rapid resolution of a broad range of issues. This will include the testing and implementing of new and replacement hardware and appropriate software and the resolving of malfunctions. They look to achieve high standards of customer service and delivery of maximum business benefits.\r\n\r\nMain responsibilities:\r\n\r\nTo analyze incidents and deliver technical resolutions as part of the IT support\r\n\r\nService, to contribute to an efficient and effective IT service desk.\r\n\r\nReview tickets within Service Management systems using established priorities.\r\n\r\nMan the helpdesk telephone on a daily basis to resolve issues for end users.\r\n\r\nLearn what notes and updates should be done on tickets.\r\n\r\nThe initial investigation and resolution of incidents relating to business and\r\n\r\nDesktop applications, and subsequent referral to either senior support analysts, to\r\n\r\n2nd/ 3rd line support, the application management team or a 3rd party.\r\n\r\nLearn to deliver end user introductory training on IT systems.\r\n\r\nUndertakes daily operational checks as defined and trained by the wider team.\r\n\r\nParticipate in projects as required.\r\n\r\nSupport tracking of IT assets (software and hardware) using software tools.\r\n\r\nSetup workstations and laptops for new starters\r\n\r\nSupport with physical desk moves between locations\r\n\r\nDeploy and install software to computers\r\n\r\nPerform password resets and help end users with profile and connectivity issues.\r\n\r\nAllow and remove access to folders and email distribution lists\r\n\r\nPerform basic proactive tasks for backups and learn how to restore backups.\r\n\r\nCarry out any other duties as required by the IT Management Team.',	'£15,000 - £18,000',	'2024-05-02',	'2024-07-28',	1,	NULL,	'Northampton',	'Y'),
(4,	'IT Infrastructure Manager',	'As an experienced IT Infrastructure Manager, you will work closely with the Head of IT to design and deliver a robust, secure, and flexible IT solution.\r\n\r\nTaking day-to-day responsibility for the smooth running of the IT systems, you will ensure that full business continuity plans are in place for our IT systems and services.\r\n\r\nYou will work closely with the Park Services and Events teams to ensure that appropriate access to IT services, including CCTV, is available throughout the Parks.',	'£45,000 - £58,000',	'2024-04-29',	'2024-07-26',	1,	NULL,	'Northampton',	'N'),
(5,	'Sales Assistant',	'Our client is an award winning sales and marketing organization; who are looking to enhance their sales team with independent individuals who are capable of seeking and developing new opportunities within the sales and marketing industry.\r\n\r\nWithin this opportunity you will be working alongside the best sales and marketing specialists, promoting an exciting client portfolio. You will represent iconic brands and play a very important role in ongoing business success while developing your skills in residential environments. This opportunity will provide high rewards both career wise, and financially.\r\n\r\nThe successful candidate will be a well-presented, self-starter capable of demonstrating a desire to succeed in a sales environment.\r\n\r\nCandidates should:\r\nHave strong communication skills\r\nBe self-motivated\r\nPossess an impeccable work ethic\r\nHave a tenacious approach to personal development\r\nPossess a competitive sales mentality\r\nHave an entrepreneurial mind-set\r\nTeam work\r\n\r\nIf you can demonstrate the qualities as set out above and believe that you have the ability to develop new business, they would like to hear from you!\r\n\r\nNo experience is necessary although our client welcomes candidates with any previous experience in the following areas: customer service, sales representative, marketing supervisor, sales executive, direct sales, field sales, marketing executive, retail, service supervisor, call center, call center inbound, marketing representative, manager, bar manager, hospitality, receptionist, warehouse, marketing assistant, front of house, direct marketing, sales assistant, and any other customer service or sales role. This is a self employed commission only opportunity with the ability to create your own future.',	'£12,000 - £15,000',	'2024-05-05',	'2024-07-20',	4,	NULL,	'Northampton',	'N'),
(6,	'HR Manager',	'An ambitious HR Manager is required to help deliver an effective and comprehensive Human Resource service to a growing organization with fully-funded plans to double in size over the next 18 months.\r\n\r\nWorking in a consultative manner, the successful HR Manager will work on a standalone basis to ensure quality advice and support is provided as part of the journey to make the organization an industry leading \"Employer of Choice\".\r\n\r\nThis exciting new role would ideally suit an ambitious generalist HR professional eager to take on a dynamic position offering genuine career progression opportunities.\r\n\r\nKey Responsibilities:\r\n\r\nProvide HR support and advice to management on company HR policies and procedures, including employment law advice e.g. disciplinary, grievance, performance.\r\n\r\nProvide high-quality recruitment and selection service to all departments including the use of social media.\r\n\r\nDevelop and implement HR policy and practice, contract templates, HR documentation and HR database developments, ensuring that all are up to date with UK legislation.\r\n\r\nProvide ongoing employee relations support and advice to whole firm relating to contractual and general HR matters.\r\n\r\nReview compensation and benefit plans e.g. salary review, bonus plan and other non-specified benefit plans.\r\n\r\nPropose and advise on internal and external training for employees.\r\n\r\nCreate career path models to include job descriptions, person specs and competency models for all roles to support individuals\' career progression.\r\n\r\nManage the HR calendar: performance reviews, salary reviews, development planning, ensuring these processes support the ongoing strategic growth plan.\r\n\r\nDevelop the organization culture to ensure \"Employer of Choice\" status is attained through determining the current culture, proposing organization initiatives and then implementing after approval to achieve \"EOC\" tag.',	'£35,000 - £40,000',	'2024-05-04',	'2024-08-02',	2,	NULL,	'Northampton',	'N'),
(8,	'Auditor',	'As an Auditor, you will be responsible for examining and analyzing financial records, ensuring compliance with regulations, and identifying areas for improvement in financial processes. Your role will involve assessing the accuracy of financial statements, verifying transactions, and providing recommendations to enhance efficiency and mitigate risk.\r\n\r\nKey Responsibilities:\r\n\r\nConduct audits of financial statements, internal controls, and operational procedures.\r\n\r\nExamine financial documents, such as ledgers, income statements, and balance sheets, to ensure accuracy and compliance with regulatory standards.\r\n\r\nEvaluate internal controls to assess their effectiveness in safeguarding assets and preventing fraud.\r\n\r\nIdentify and investigate discrepancies, errors, or irregularities in financial records.\r\n\r\nPrepare detailed audit reports outlining findings, recommendations, and corrective actions.\r\n\r\nCommunicate audit results to management and stakeholders, providing insights and recommendations for improvement.',	'£20,000',	'2024-05-10',	'2024-06-28',	5,	NULL,	'Manchester',	'N'),
(10,	'Video Editor',	'As a Video Editor, you will be responsible for assembling recorded raw material into a finished product suitable for broadcasting, online sharing, or other distribution platforms. You will work closely with the creative team to understand project requirements and translate them into visually compelling videos that effectively communicate the desired message or story.\r\n\r\nKey Responsibilities:\r\n\r\nReview and analyze raw footage to determine the best sequences and scenes for final edit.\r\n\r\nTrim footage segments to specified lengths, rearrange sequences, and add transitions, sound effects, and other enhancements.\r\n\r\nCollaborate with the creative team to understand project goals, audience demographics, and messaging objectives.\r\n\r\nEnsure logical sequencing and smooth running of videos, adhering to established brand guidelines and creative direction.\r\n\r\nManipulate and edit video content for various platforms, including social media, websites, and broadcast.',	'£8,000 - £10,000',	'2024-05-10',	'2024-06-30',	6,	9,	'Remote',	'N'),
(11,	'Sales Representative',	'As a Sales Representative, you will be responsible for generating leads, building relationships with potential clients, and closing sales to meet or exceed revenue targets. You will represent our company\'s products or services to prospective customers and act as a key point of contact throughout the sales process. Your success will be measured by your ability to identify opportunities, effectively communicate value propositions, and cultivate long-term client partnerships.\r\n\r\nKey Responsibilities:\r\n\r\nProspect and qualify leads through various channels, including cold calling, networking, and referrals.\r\n\r\nConduct thorough research to understand potential clients\' needs, challenges, and buying behavior.\r\n\r\nDevelop and maintain a pipeline of opportunities, tracking progress and updating CRM systems accordingly.\r\n\r\nInitiate contact with prospects to introduce our products or services, articulate value propositions, and schedule meetings or demonstrations.\r\n\r\nDeliver compelling sales presentations tailored to the needs and interests of prospective clients.',	'£12,000 - £16,000',	'2024-05-10',	'2024-07-02',	4,	10,	'Birmingham',	'N'),
(12,	'Content Writer',	'As a Content Writer, you will be responsible for creating engaging and informative content that resonates with our target audience and aligns with our brand voice and objectives. You will collaborate with the marketing team to develop content strategies, produce high-quality written materials, and ensure consistency across various channels and platforms. Your creativity, attention to detail, and ability to craft compelling narratives will be essential in driving audience engagement and brand awareness.\r\n\r\nKey Responsibilities:\r\n\r\nResearch and understand our target audience, industry trends, and content marketing best practices to inform content strategy and execution.\r\n\r\nCreate original, well-researched content for a variety of channels, including blog posts, articles, website copy, social media posts, emails, and whitepapers.\r\n\r\nDevelop content outlines, drafts, and final copies based on project requirements and objectives, adhering to deadlines and editorial guidelines.\r\n\r\nCollaborate with cross-functional teams, including marketing, design, and product development, to ensure content aligns with brand messaging and marketing initiatives.\r\n\r\nOptimize content for search engines (SEO) and user experience (UX), incorporating relevant keywords, meta tags, and formatting techniques.',	'£8,000 - £10,000',	'2024-05-10',	'2024-06-19',	6,	8,	'Birmingham',	'N');

DROP TABLE IF EXISTS `staffs`;
CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `staffs` (`staff_id`, `username`, `password`) VALUES
(4,	'staff1',	'$2y$10$nLb2MRscyMrbjYXBj53aLeA1W5atKNRRYHUvL873AlY5N6bCYgnBK'),
(5,	'staff2',	'$2y$10$K45N1gCb.AF7S1j2Kra1vOtmQ4kpOOq6pI/vQUmXg12CP6UkVeU5C'),
(9,	'staff3',	'$2y$10$B/hMR9Xci9ZpBL9jPngGK.tEc6c7psIpRyNcvU7YGzGW7PfJ7XdsW'),
(15,	'staff4',	'$2y$10$PVMb2nIdVLv4pCqJBWkav.k4pac7mTIm4WVHUwaTEj71QkxSxVMP.');

-- 2024-05-12 10:09:14