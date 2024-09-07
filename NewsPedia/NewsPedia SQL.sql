-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2024 at 06:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newsfinal2`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `response_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`response_id`, `question_id`) VALUES
(43, 5);

-- --------------------------------------------------------

--
-- Table structure for table `survey_question`
--

CREATE TABLE `survey_question` (
  `question_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `question_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_question`
--

INSERT INTO `survey_question` (`question_id`, `admin_id`, `question_text`) VALUES
(5, 1, 'Who are You?');

-- --------------------------------------------------------

--
-- Table structure for table `survey_response`
--

CREATE TABLE `survey_response` (
  `response_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `response_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `survey_response`
--

INSERT INTO `survey_response` (`response_id`, `user_id`, `response_text`) VALUES
(42, 7, '1'),
(43, 7, '3');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `AdminUserName` varchar(255) DEFAULT NULL,
  `AdminPassword` varchar(255) DEFAULT NULL,
  `AdminEmailId` varchar(255) DEFAULT NULL,
  `userType` int(11) DEFAULT NULL,
  `CreationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `AdminUserName`, `AdminPassword`, `AdminEmailId`, `userType`, `CreationDate`, `UpdationDate`) VALUES
(1, 'admin', 'admin', 'phpgurukulofficial@gmail.com', 1, '2024-01-09 18:30:00', '2024-07-09 12:21:54'),
(3, 'subadmin', 'f925916e2754e5e03f75dd58a5733251', 'sudamin@gmail.in', 0, '2024-01-09 18:30:00', '2024-01-31 05:43:01'),
(4, 'suadmin2', 'f925916e2754e5e03f75dd58a5733251', 'sbadmin@test.com', 0, '2024-01-09 18:30:00', '2024-01-31 05:43:01');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 'Style', 'We stay in style', '2024-01-11 13:30:00', '2024-01-31 00:43:16', 1),
(2, 'Food', 'For all Foodies', '2024-01-11 13:30:00', '2024-01-31 00:43:16', 1),
(3, 'Sports', 'Related to sports news', '2024-01-11 18:30:00', '2024-01-31 05:43:16', 1),
(4, 'Health', 'For All Health Freaks', '2024-01-11 13:30:00', '2024-01-31 00:43:16', 1),
(5, 'Entertainment', 'Entertainment related  News', '2024-01-11 18:30:00', '2024-01-31 05:43:25', 1),
(6, 'Politics', 'Politics', '2024-01-11 18:30:00', '2024-01-31 05:43:25', 1),
(9, 'Local News', 'locall', '2024-07-09 14:35:40', '2024-07-09 14:35:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomments`
--

CREATE TABLE `tblcomments` (
  `comm_id` int(11) NOT NULL,
  `postId` int(11) DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcomments`
--

INSERT INTO `tblcomments` (`comm_id`, `postId`, `comment`, `postingDate`, `status`) VALUES
(1, 12, 'Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.', '2024-01-17 18:30:00', 1),
(2, 12, 'This is sample text for testing.', '2024-01-18 18:30:00', 1),
(3, 7, 'This is sample text for testing.', '2024-01-22 18:30:00', 1),
(4, 3, 'maaz comment pls no more errors\r\n', '2024-07-09 13:07:10', 1),
(5, 3, ':))))', '2024-07-09 13:07:22', 0),
(6, 29, 'sdsdsd', '2024-07-09 15:19:13', 0),
(7, 29, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem', '2024-08-31 10:13:58', 1),
(8, 1, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', '2024-08-31 10:14:22', 1),
(9, 8, 'On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish.', '2024-08-31 10:14:41', 1),
(10, 13, 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', '2024-08-31 10:14:56', 1),
(11, 6, 'Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?', '2024-08-31 10:15:13', 1),
(12, 5, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2024-08-31 10:15:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `Description` longtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `PageTitle`, `Description`, `PostingDate`, `UpdationDate`) VALUES
(1, 'aboutus', 'About News Portal', '<font color=\"#7b8898\" face=\"Mercury SSm A, Mercury SSm B, Georgia, Times, Times New Roman, Microsoft YaHei New, Microsoft Yahei, å¾®è½¯é›…é»‘, å®‹ä½“, SimSun, STXihei, åŽæ–‡ç»†é»‘, serif\"><span style=\"font-size: 26px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></font><br>', '2024-01-14 18:30:00', '2024-01-31 05:44:12'),
(2, 'contactus', 'Contact Details', '<p><br></p><p><b>Address :&nbsp; </b>New Delhi India</p><p><b>Phone Number : </b>+91 -01234567890</p><p><b>Email -id : </b>phpgurukulofficial@gmail.com</p>', '2024-01-15 18:30:00', '2024-01-31 05:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`) VALUES
(1, 'New Tax Reforms Announced by the Government', 6, 7, 'The government has announced a series of new tax reforms aimed at boosting the economy and reducing the fiscal deficit. These reforms include changes in income tax brackets and corporate tax rates.', '2024-02-01 04:00:00', '2024-08-31 10:14:22', 1, 'mid-adult-blonde-female-political-leader-addressing-world-important-issues-wit-SBV-346755528-preview(1).mp4', 'images.jpg', 3005, 'admin', NULL),
(2, 'Election Commission Releases 2024 Election Schedule', 6, 7, 'The Election Commission has released the schedule for the upcoming 2024 general elections. The elections will be held in seven phases starting from April 11 and ending on May 19, with counting on May 23.', '2024-02-02 05:00:00', '2024-07-09 17:23:07', 1, 'election-commission-releases-2024-election-schedule', 'hands.jpg', 2001, 'admin', NULL),
(3, 'Prime Minister Addresses the Nation on Economic Policies', 6, 7, 'In a televised address, the Prime Minister outlined the government’s economic policies and the steps being taken to ensure sustainable growth. He emphasized the need for fiscal discipline and innovative solutions.', '2024-02-03 06:00:00', '2024-09-02 16:02:42', 1, 'prime-minister-addresses-the-nation-on-economic-policies', 'fire.jpg', 3030, 'admin', NULL),
(4, 'Opposition Leaders Criticize New Healthcare Bill', 6, 7, 'Opposition leaders have voiced strong criticism against the new healthcare bill introduced by the government. They argue that the bill will reduce access to essential healthcare services for the underprivileged.', '2024-02-04 07:00:00', '2024-07-06 13:01:47', 1, 'opposition-leaders-criticize-new-healthcare-bill', 'immo.jpg', 4001, 'admin', NULL),
(5, 'New Environmental Regulations Passed by Parliament', 6, 7, 'Parliament has passed new environmental regulations aimed at reducing carbon emissions and promoting sustainable development. The regulations include stricter controls on industrial pollution and incentives for renewable energy projects.', '2024-02-05 08:00:00', '2024-08-31 10:15:30', 1, 'new-environmental-regulations-passed-by-parliament', 'mid-adult-blonde-female-political-leader-addressing-world-important-issues-wit-SBV-346755528-preview(1).mp4', 5002, 'admin', NULL),
(6, 'Foreign Minister Visits US to Strengthen Bilateral Ties', 6, 7, 'The Foreign Minister is on an official visit to the United States to discuss ways to strengthen bilateral ties and enhance cooperation on various global issues, including trade, security, and climate change.', '2024-02-06 09:00:00', '2024-08-31 10:15:13', 1, 'foreign-minister-visits-us-to-strengthen-bilateral-ties', 'images_portal.jpg', 6013, 'admin', NULL),
(7, 'Jasprit Bumrah ruled out of England T20I series due to injury', 3, 4, 'The Indian Cricket Team has received a huge blow right ahead of the commencement of the much-awaited series against England. Star speedster Jasprit Bumrah has been ruled out of the forthcoming 3-match T20I series as he suffered an injury in his left thumb.The 24-year-old pacer picked up a niggle during India’s first T20I match against Ireland played on June 27 at the Malahide cricket ground in Dublin. As per the reports, he is likely to be available for the ODI series against England scheduled to start from July 12.In the first, Bumrah exhibited a phenomenal performance with the ball. In his quota of four overs, he conceded 19 runs and picked 2 wickets at an economy rate of 4.75.Post his injury, he arrived at team’s optional training session on Thursday but didn’t train. Later, he was rested in the second face-off along with MS Dhoni, Shikhar Dhawan and Bhuvneshwar Kumar.of now, no replacement has been announced. However, Umesh Yadav may be be given chance in the team in Bumrah’s absence. foThe first T20I match between India and England will be played at Old Trafford, Manchester on July 3.', '2024-01-15 18:30:00', '2024-07-06 10:38:00', 1, 'Jasprit-Bumrah-ruled-out-of-England-T20I-series-due-to-injury', '6d08a26c92cf30db69197a1fb7230626.jpg', 24, 'admin', NULL),
(8, 'Government Launches New Digital India Initiative', 6, 7, 'The government has launched a new initiative under the Digital India campaign, aimed at improving digital infrastructure and promoting digital literacy across the country. The initiative includes new projects in e-governance and digital education.', '2024-02-07 10:00:00', '2024-09-02 15:58:03', 1, 'government-launches-new-digital-india-initiative', 'images8.jpg', 7009, 'admin', NULL),
(9, 'Budget 2024: Key Highlights and Reactions', 6, 7, 'The Finance Minister has presented the Budget for 2024, outlining key fiscal measures and allocation of resources for various sectors. The budget has received mixed reactions from industry leaders and political analysts.', '2024-02-08 11:00:00', '2024-07-06 13:46:18', 1, 'budget-2024-key-highlights-and-reactions', 'images9.jpg', 2005, 'admin', NULL),
(11, 'UNs Jean Pierre Lacroix thanks India for contribution to peacekeeping', 6, 8, 'UNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeepingUNs Jean Pierre Lacroix thanks India for contribution to peacekeeping', '2024-01-16 18:30:00', '2024-07-06 11:09:08', 1, 'UNs-Jean-Pierre-Lacroix-thanks-India-for-contribution-to-peacekeeping', '27095ab35ac9b89abb8f32ad3adef56a.jpg', 8000, 'admin', NULL),
(12, 'Shah holds meeting with NE states leaders in Manipur', 6, 7, 'New Delhi: BJP president Amit Shah today held meetings with his party leaders who are in-charge of 11 Lok Sabha seats spread across seven northeast states as part of a drive to ensure that it wins the maximum number of these constituencies in the general election next year.Shah held separate meetings with Lok Sabha toli (group) of Arunachal Pradesh, Tripura, Meghalaya, Mizoram, Nagaland, Sikkim and Manipur in Manipur, the party\'s media head Anil Baluni said.Baluni said that Shah was in West Bengal for two days before he arrived in Manipur. The BJP chief would reach Odisha tomorrow', '2024-01-17 18:30:00', '2024-07-06 11:09:08', 1, 'Shah-holds-meeting-with-NE-states-leaders-in-Manipur', '7fdc1a630c238af0815181f9faa190f5.jpg', 9000, 'admin', NULL),
(13, 'T20 World Cup 2021: Semi-final 1, England vs New Zealand', 3, 4, 'New Zealand held their nerves admirably to make it a hat-trick of ICC event final entrances, trumping <strong>England</strong></a> in a see-sawing semi-final clash in Abu Dhabi. You would feel they are too nice to believe in revenging anything, even if it is as bitter as the fateful 2019 ODI World Cup loss, so let’s put it this way: the scores are settled. And in doing so, New Zealand have made it to the finals of a tournament no one counted them as the favourites of.After being inserted, a Jason Roy-less England managed 166/4 largely on the back of Dawid Malan (41 off 30), who got back his mojo at the right time, and Moeen Ali (51 off 37), who proved it for the umpteenth time what a marvellous short-format asset he is.', '2024-01-18 18:30:00', '2024-08-31 10:14:56', 1, 'T20-World-Cup-2021:-Semi-final-1,-England-vs-New-Zealand-â€“-Who-Said-What', '8bc5c30be91dca9d07c1db858c60e39f.jpg', 10003, 'admin', 'subadmin'),
(14, 'Supreme Court Ruling on Electoral Bonds', 6, 7, 'The Supreme Court has issued a ruling on the legality of electoral bonds, stating that they can be used for political funding but with strict regulations to ensure transparency and accountability.', '2024-02-09 12:00:00', '2024-07-06 13:45:59', 1, 'supreme-court-ruling-on-electoral-bonds', 'images14.jpg', 4008, 'admin', NULL),
(15, 'Top 10 Summer Fashion Trends for 2024', 1, 1, 'Discover the top fashion trends for the summer of 2024. From bold colors to sustainable fabrics, here\'s what you need to stay stylish.', '2024-05-01 04:00:00', '2024-07-06 15:29:03', 1, 'top-10-summer-fashion-trends-2024', 'l2.jpg', 1200, 'admin', NULL),
(16, 'Healthy Lifestyle Tips for Busy Professionals', 1, 2, 'Busy professionals often neglect their health. Here are some practical tips to maintain a healthy lifestyle despite a hectic schedule.', '2024-05-05 05:00:00', '2024-07-06 15:29:03', 1, 'healthy-lifestyle-tips-for-busy-professionals', 'f3.jpg', 850, 'admin', NULL),
(17, 'The Rise of Sustainable Fashion', 1, 1, 'Sustainable fashion is gaining popularity as more people become aware of its impact on the environment. Learn about the key brands and trends in this movement.', '2024-05-10 06:00:00', '2024-07-06 16:05:56', 1, 'the-rise-of-sustainable-fashion', 'l1.jpg', 951, 'admin', NULL),
(18, 'Top Fitness Trends to Watch in 2024', 1, 2, 'Stay ahead of the fitness game with these top trends for 2024. From virtual workouts to wearable technology, find out what\'s new in fitness.', '2024-05-15 03:00:00', '2024-07-06 15:37:27', 1, 'top-fitness-trends-to-watch-2024', 'helsinki-finland-october-20-2017-fashion-show-katri-niskanen-during-fair-i-lov-SBV-318429871-preview.mp4', 720, 'admin', NULL),
(19, 'How to Create a Capsule Wardrobe', 1, 1, 'Simplify your wardrobe with a capsule collection. Learn the basics of building a versatile and stylish wardrobe with fewer pieces.', '2024-05-20 04:30:00', '2024-07-06 15:29:03', 1, 'how-to-create-a-capsule-wardrobe', 'f2.jpg', 530, 'admin', NULL),
(20, 'Mental Health and Lifestyle: Tips for Balance', 1, 2, 'Balancing mental health and lifestyle can be challenging. Here are some tips to help you maintain a healthy mental state while living a busy life.', '2024-05-25 02:00:00', '2024-07-06 15:29:03', 1, 'mental-health-and-lifestyle-tips-for-balance', 'l5.jpg', 670, 'admin', NULL),
(21, 'Best Organic Beauty Products of 2024', 1, 1, 'Looking for organic beauty products? Check out our list of the best organic beauty products of 2024 to keep your skin healthy and glowing.', '2024-05-30 07:00:00', '2024-07-06 15:29:03', 1, 'best-organic-beauty-products-2024', 'l5.jpg', 780, 'admin', NULL),
(22, 'Travel Guide: Top Lifestyle Destinations in 2024', 1, 2, 'Explore the top lifestyle destinations to visit in 2024. From tropical beaches to bustling cities, find the perfect spot for your next vacation.', '2024-06-01 06:00:00', '2024-07-06 15:29:03', 1, 'travel-guide-top-lifestyle-destinations-2024', 'l3.jpg', 650, 'admin', NULL),
(23, 'Fashion Tips for the Modern Man', 1, 1, 'Men\'s fashion is evolving. Get the latest fashion tips for the modern man to keep your wardrobe updated and stylish.', '2024-06-05 03:30:00', '2024-07-06 15:37:46', 1, 'fashion-tips-for-the-modern-man', 'f3.jpg', 501, 'admin', NULL),
(24, 'The Rise of Artisanal Sweets in the Market', 2, 9, 'Artisanal sweets have been gaining popularity in the market, offering unique flavors and high-quality ingredients. Many small businesses are thriving by focusing on handcrafted confectioneries.', '2024-07-06 05:00:00', '2024-08-26 22:24:54', 1, 'the-rise-of-artisanal-sweets-in-the-market', 's1.jpeg', 151, 'admin', NULL),
(25, 'Health Benefits of Natural Fruit Drinks', 2, 10, 'Natural fruit drinks are becoming a popular choice for health-conscious consumers. These beverages are rich in vitamins, minerals, and antioxidants, making them a nutritious alternative to sugary sodas.', '2024-07-06 06:00:00', '2024-07-06 16:46:44', 1, 'health-benefits-of-natural-fruit-drinks', 'd1.jpeg', 200, 'admin', NULL),
(26, 'The Best Homemade Dessert Recipes for Summer', 2, 9, 'With summer in full swing, it\'s the perfect time to try out some refreshing homemade dessert recipes. From fruit sorbets to no-bake cheesecakes, these recipes are easy to make and perfect for any occasion.', '2024-07-06 07:00:00', '2024-08-26 22:27:07', 1, 'the-best-homemade-dessert-recipes-for-summer', 'family-puts-food-on-plates-at-buffet-table-2-SBV-300066298-preview.mp4', 182, 'admin', NULL),
(27, 'Exploring Exotic Coffee Drinks from Around the World', 2, 10, 'Coffee enthusiasts are always on the lookout for new and exciting flavors. This article explores some of the most exotic coffee drinks from around the world, including Turkish coffee, Vietnamese egg coffee, and Italian affogato.', '2024-07-06 08:00:00', '2024-07-06 16:46:44', 1, 'exploring-exotic-coffee-drinks-from-around-the-world', 'd2.jpeg', 220, 'subadmin', NULL),
(28, 'Vegan Sweets: Delicious and Cruelty-Free', 2, 9, 'Vegan sweets are not only delicious but also cruelty-free, making them a great choice for those looking to enjoy treats without compromising their values. This article highlights some of the best vegan sweet recipes and brands.', '2024-07-06 09:00:00', '2024-07-06 16:46:44', 1, 'vegan-sweets-delicious-and-cruelty-free', 's3.jpeg', 175, 'admin', NULL),
(29, 'The Popularity of Spicy Foods: Why We Love the Heat', 2, 11, 'Spicy foods have a dedicated fan base, and their popularity continues to grow. This article delves into the reasons why people love spicy foods and explores some of the hottest dishes from around the world.', '2024-07-06 10:00:00', '2024-09-02 16:25:57', 1, 'the-popularity-of-spicy-foods-why-we-love-the-heat', 'h1.jpeg', 314, 'subadmin', NULL),
(30, 'The Popularity of Spicy Foods: Why We Love the Heat', 2, 11, 'Spicy foods have a dedicated fan base, and their popularity continues to grow. This article delves into the reasons why people love spicy foods and explores some of the hottest dishes from around the world.', '2024-07-06 10:00:00', '2024-07-08 22:04:56', 1, 'the-popularity-of-spicy-foods-why-we-love-the-heat', 'h2.jpg', 302, 'subadmin', NULL),
(31, 'Top 10 Must-Watch Movies of 2024', 5, 3, 'Discover the top 10 must-watch movies of 2024, featuring an exciting mix of action, drama, and comedy that you won\'t want to miss.', '2024-07-01 05:00:00', '2024-07-06 17:41:54', 1, NULL, 'e2.jpg', 350, 'admin', NULL),
(32, 'Exclusive Interview with Famous Director', 5, 6, 'Get an exclusive insight into the life and career of a renowned director, as they discuss their latest blockbuster and upcoming projects.', '2024-07-02 04:00:00', '2024-07-06 17:41:54', 1, NULL, 'e3.jpg', 280, 'admin', NULL),
(33, 'Behind the Scenes of a Hit TV Series', 5, 3, 'Take a peek behind the scenes of a popular TV series, from set design to scriptwriting, and meet the talented cast and crew.', '2024-07-03 06:00:00', '2024-07-06 17:41:54', 1, NULL, 'e4.png', 410, 'subadmin', NULL),
(34, 'The Rise of Virtual Reality in Gaming', 5, 6, 'Explore how virtual reality technology is revolutionizing the gaming industry, providing immersive experiences and new gameplay possibilities.', '2024-07-04 08:00:00', '2024-07-06 17:41:54', 1, NULL, 'e5.jpg', 320, 'admin', NULL),
(35, 'Review: Concert of the Year', 5, 3, 'Read our review of the concert that everyone is talking about, featuring top-notch performances and unforgettable moments.', '2024-07-05 10:00:00', '2024-07-06 18:37:49', 1, NULL, 'laser-light-show-with-people-dancing-at-night-in-the-middle-of-a-desert-music--SBV-347569638-preview.mp4', 380, 'subadmin', NULL),
(36, 'Top 10 TV Shows You Must Binge-Watch in 2024', 5, 4, 'Explore the top 10 TV shows you must binge-watch in 2024. From gripping dramas to hilarious comedies, these shows are perfect for your entertainment!', '2024-07-05 07:00:00', '2024-07-06 17:41:54', 1, NULL, 'e1.jpg', 280, 'admin', NULL),
(37, 'Best Video Games of 2024 You Should Play', 5, 5, 'Discover the best video games of 2024 that every gamer should play. From action-packed adventures to immersive RPGs, these games will keep you entertained!', '2024-07-06 09:30:00', '2024-07-09 17:28:38', 1, NULL, 'e7.jpg', 322, 'admin', NULL),
(38, 'Top 5 Music Albums Making Waves in 2024', 5, 6, 'Check out the top 5 music albums making waves in 2024. Whether you are into pop, rock, or hip-hop, these albums showcase the best of this year\'s music scene!', '2024-07-07 06:00:00', '2024-09-02 16:15:53', 1, NULL, 'e8.jpg', 262, 'admin', NULL),
(39, 'The Importance of Regular Exercise', 4, NULL, 'Learn about the importance of regular exercise for maintaining good physical and mental health.', '2024-07-06 04:00:00', '2024-07-06 04:00:00', 1, NULL, 'he1.jpg', 200, 'admin', NULL),
(40, 'Healthy Eating Tips for Busy Professionals', 4, NULL, 'Discover practical tips for busy professionals to maintain a healthy diet amidst a hectic schedule.', '2024-07-05 10:30:00', '2024-08-24 13:16:37', 1, NULL, 'he2.jpg', 180, 'admin', NULL),
(41, 'Benefits of Meditation for Stress Relief', 4, NULL, 'Explore how meditation can effectively reduce stress and promote overall well-being.', '2024-07-04 06:00:00', '2024-07-04 06:00:00', 1, NULL, 'he3.jpg', 220, 'admin', NULL),
(42, 'Tips for Better Sleep Hygiene', 4, NULL, 'Learn practical tips to improve sleep hygiene and enhance overall sleep quality.', '2024-07-03 12:45:00', '2024-07-03 12:45:00', 1, NULL, 'he4.png', 190, 'admin', NULL),
(43, 'Common Mental Health Issues in Adolescents', 4, NULL, 'Identify common mental health issues that adolescents face and how they can be addressed.', '2024-07-02 09:20:00', '2024-07-02 09:20:00', 1, NULL, 'he5.jpg', 160, 'admin', NULL),
(44, 'Benefits of Regular Cardiovascular Exercise', 4, NULL, 'Explore the various benefits of incorporating regular cardiovascular exercise into your routine.', '2024-07-01 07:00:00', '2024-07-06 18:37:49', 1, NULL, 'doctor-explaining-x-ray-results-to-patient-during-hospital-visit-SBV-347292618-preview.mp4', 230, 'admin', NULL),
(45, 'Nutritional Benefits of Eating More Fruits and Vegetables', 4, NULL, 'Discover the nutritional benefits of adding more fruits and vegetables to your daily diet.', '2024-06-30 05:30:00', '2024-06-30 05:30:00', 1, NULL, 'he7.jpg', 250, 'admin', NULL),
(46, 'Tips for Managing Stress at Work', 4, NULL, 'Learn effective strategies for managing and reducing stress in the workplace.', '2024-06-29 11:00:00', '2024-06-29 11:00:00', 1, NULL, 'he8.jpg', 210, 'admin', NULL),
(47, 'The Importance of Mental Health Awareness', 4, NULL, 'Understand why raising awareness about mental health is crucial for overall well-being.', '2024-06-28 08:45:00', '2024-06-28 08:45:00', 1, NULL, 'he9.jpg', 270, 'admin', NULL),
(48, 'Top Football Transfer Rumors', 3, 5, 'Explore the latest transfer rumors in football, including potential big-money moves and player transfers between clubs.', '2024-07-02 06:45:00', '2024-07-06 18:34:35', 1, 'top-football-transfer-rumors', 'fb1.jpg', 250, 'admin', NULL),
(49, 'Key Tactics for Winning Football Matches', 3, 5, 'Discover key tactics and strategies used by top football teams to win matches, from defense to attack.', '2024-07-01 05:15:00', '2024-07-06 18:34:35', 1, 'winning-football-match-tactics', 'fb2.jpg', 200, 'admin', NULL),
(50, 'Upcoming Cricket Tournaments to Watch Out For', 3, 4, 'Stay updated on the upcoming cricket tournaments around the world that promise thrilling cricket action.', '2024-06-30 04:00:00', '2024-07-06 18:37:49', 1, 'upcoming-cricket-tournaments', 'baseball-stadium-club-seat-fans-SBV-335761284-preview.mp4', 230, 'admin', NULL),
(51, 'Football Fitness Tips for Players', 3, 5, 'Get essential fitness tips tailored for football players to improve endurance, strength, and agility on the field.', '2024-06-29 10:30:00', '2024-07-06 18:34:35', 1, 'football-fitness-tips', 'fb3.jpg', 190, 'admin', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) DEFAULT NULL,
  `SubCatDescription` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(1, 1, 'Lifestyle ', 'Lifestyle tips', '2024-01-14 13:30:00', '2024-01-31 00:48:30', 1),
(2, 1, 'Fashion', 'Fashion tips', '2024-01-14 13:30:00', '2024-01-31 00:48:30', 1),
(3, 5, 'Bollywood ', 'Bollywood masala', '2024-01-14 18:30:00', '2024-01-31 05:48:30', 1),
(4, 3, 'Cricket', 'Cricket\r\n\r\n', '2024-01-14 18:30:00', '2024-01-31 05:48:39', 1),
(5, 3, 'Football', 'Football', '2024-01-14 18:30:00', '2024-01-31 05:48:39', 1),
(6, 5, 'Television', 'TeleVision', '2024-01-14 18:30:00', '2024-01-31 05:48:39', 1),
(7, 6, 'National', 'National', '2024-01-14 18:30:00', '2024-01-31 05:48:39', 1),
(8, 6, 'International', 'International', '2024-01-14 18:30:00', '2024-01-31 05:48:39', 1),
(9, 2, 'Sweets', 'Various types of sweets including artisanal and vegan options.', '2024-07-06 05:00:00', '2024-07-06 05:00:00', 1),
(10, 2, 'Drinks', 'Health benefits of natural fruit drinks and exotic coffee varieties.', '2024-07-06 06:00:00', '2024-07-06 06:00:00', 1),
(11, 2, 'Spicy Food', 'Exploring the popularity and reasons why people love spicy foods.', '2024-07-06 10:00:00', '2024-07-09 14:36:01', 0),
(12, 4, 'locally', 'jbjygyu', '2024-07-09 14:36:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userId` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `emailId` varchar(255) DEFAULT NULL,
  `contactno` bigint(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userId`, `fullName`, `emailId`, `contactno`, `password`) VALUES
(1, 'John Doe', 'john.doe@example.com', 123, ''),
(2, 'Jane Smith', 'jane.smith@example.com', 987, ''),
(3, 'Michael Johnson', 'michael.johnson@example.com', 555, ''),
(4, 'ayan', 'ayan123@gmail.com', 123456789, '$2y$10$b59mobl8ZYTgHpTrw6nv7eqdzVcFGzwhBKB4hF/eW0KwFRF4uXBw.'),
(5, 'ayan', 'ayan123@gmail.com', 123456789, '$2y$10$hdPNvnlPkqP/VM/Zb.FuoOFYAS7En9r6iNEGoZBpKrdQGxlPpsVSq'),
(6, 'ayan', 'ayan123@gmail.com', 123456789, '$2y$10$flrXjR2TFPEZ0Y3RDGamEuQ4JKUSsZCjwNUGaL3Ez3aJCKS/lueMC'),
(7, 'Maaz', 'maaz@gmail.com', 300213233, '$2y$10$XrnLKD.vjAc4xpq0YAKt0.A.ibUmBUY5Fd9f1JO8oAZnqehmdTW1u');

-- --------------------------------------------------------

--
-- Table structure for table `user_comment`
--

CREATE TABLE `user_comment` (
  `comm_id` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_comment`
--

INSERT INTO `user_comment` (`comm_id`, `userId`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 7),
(5, 7),
(6, 7),
(7, 7),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(12, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`response_id`,`question_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `survey_question`
--
ALTER TABLE `survey_question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `survey_response`
--
ALTER TABLE `survey_response`
  ADD PRIMARY KEY (`response_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AdminUserName` (`AdminUserName`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD PRIMARY KEY (`comm_id`),
  ADD KEY `id` (`comm_id`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `postsucatid` (`SubCategoryId`),
  ADD KEY `subadmin` (`postedBy`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`),
  ADD KEY `catid` (`CategoryId`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD PRIMARY KEY (`comm_id`,`userId`),
  ADD KEY `userId` (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `survey_question`
--
ALTER TABLE `survey_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `survey_response`
--
ALTER TABLE `survey_response`
  MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblcomments`
--
ALTER TABLE `tblcomments`
  MODIFY `comm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `survey`
--
ALTER TABLE `survey`
  ADD CONSTRAINT `survey_ibfk_1` FOREIGN KEY (`response_id`) REFERENCES `survey_response` (`response_id`),
  ADD CONSTRAINT `survey_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `survey_question` (`question_id`);

--
-- Constraints for table `survey_question`
--
ALTER TABLE `survey_question`
  ADD CONSTRAINT `survey_question_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `tbladmin` (`id`);

--
-- Constraints for table `survey_response`
--
ALTER TABLE `survey_response`
  ADD CONSTRAINT `survey_response_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tblusers` (`userId`);

--
-- Constraints for table `tblcomments`
--
ALTER TABLE `tblcomments`
  ADD CONSTRAINT `pid` FOREIGN KEY (`postId`) REFERENCES `tblposts` (`id`);

--
-- Constraints for table `tblposts`
--
ALTER TABLE `tblposts`
  ADD CONSTRAINT `postcatid` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `postsucatid` FOREIGN KEY (`SubCategoryId`) REFERENCES `tblsubcategory` (`SubCategoryId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subadmin` FOREIGN KEY (`postedBy`) REFERENCES `tbladmin` (`AdminUserName`);

--
-- Constraints for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD CONSTRAINT `cat_id` FOREIGN KEY (`CategoryId`) REFERENCES `tblcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_comment`
--
ALTER TABLE `user_comment`
  ADD CONSTRAINT `comm_id` FOREIGN KEY (`comm_id`) REFERENCES `tblcomments` (`comm_id`),
  ADD CONSTRAINT `user_comment_ibfk_1` FOREIGN KEY (`comm_id`) REFERENCES `tblcomments` (`comm_id`),
  ADD CONSTRAINT `user_comment_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `tblusers` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
