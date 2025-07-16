-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2025 at 01:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bharatyatra_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `tour_package` varchar(255) NOT NULL,
  `travel_date` date NOT NULL,
  `return_date` date NOT NULL,
  `number_of_persons` int(11) NOT NULL,
  `status` enum('new','cancelled','confirmed') DEFAULT 'new',
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `name`, `email`, `country_code`, `phone`, `tour_package`, `travel_date`, `return_date`, `number_of_persons`, `status`, `submission_date`) VALUES
(1, 'Emily Davis', 'emily@example.com', '+91', '1234567894', 'Goa Beach Holiday', '2024-10-14', '2024-11-30', 1, 'confirmed', '2024-07-09 08:02:12'),
(2, 'Daniel White', 'daniel@example.com', '+91', '1234567895', 'Leh Ladakh Adventure', '2024-11-02', '2024-11-19', 2, 'confirmed', '2024-06-09 08:02:12'),
(3, 'Sophia Brown', 'sophia@example.com', '+91', '1234567896', 'Himalayan Trek', '2024-10-13', '2024-11-27', 1, 'cancelled', '2024-05-10 08:02:12'),
(4, 'admin', 'admin@gmail.com', '+91', '9879719578', 'Chhattisgarh', '2024-10-24', '2024-11-05', 3, 'confirmed', '2024-10-19 06:40:49');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form_submissions`
--

CREATE TABLE `contact_form_submissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` enum('new','read') DEFAULT 'new',
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `response` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form_submissions`
--

INSERT INTO `contact_form_submissions` (`id`, `name`, `mobile`, `email`, `destination`, `comment`, `status`, `submission_date`, `response`) VALUES
(1, 'Pooja', '9879719578', 'poojazanzmera@gmail.com', 'Mumbai', 'Good', 'read', '2024-09-18 20:54:38', 'hello'),
(2, 'Arjun Kumar', '9876543210', 'arjun.kumar@gmail.com', 'Goa', 'Looking for a beach vacation.', 'read', '2024-10-07 13:23:57', 'ok now we add ythis package.'),
(3, 'Meena Rai', '9876543211', 'meena.rai@gmail.com', 'Kerala', 'Interested in backwater tours.', 'read', '2024-10-07 13:23:57', 'nooo never'),
(4, 'Deepak Malhotra', '9876543212', 'deepak.malhotra@gmail.com', 'Leh Ladakh', 'Need details about adventure sports.', 'new', '2024-10-07 13:23:57', NULL),
(5, 'Radhika Mishra', '9876543213', 'radhika.mishra@gmail.com', 'Rajasthan', 'Interested in cultural tours.', 'new', '2024-10-07 13:23:57', NULL),
(6, 'Sumit Khanna', '9876543214', 'sumit.khanna@gmail.com', 'Delhi, Agra', 'Golden Triangle tour details.', 'new', '2024-10-07 13:23:57', NULL),
(7, 'Anita Deshmukh', '9876543215', 'anita.deshmukh@gmail.com', 'North East India', 'Need package details.', 'new', '2024-10-07 13:23:57', NULL),
(8, 'Kiran Reddy', '9876543216', 'kiran.reddy@gmail.com', 'Uttarakhand', 'Looking for pilgrimage tour.', 'new', '2024-10-07 13:23:57', NULL),
(9, 'Manoj Singh', '9876543217', 'manoj.singh@gmail.com', 'Madhya Pradesh', 'Heritage sites tour info needed.', 'new', '2024-10-07 13:23:57', NULL),
(10, 'Priya Nair', '9876543218', 'priya.nair@gmail.com', 'Andaman', 'Island tour details please.', 'new', '2024-10-07 13:23:57', NULL),
(11, 'Rohit Jain', '9876543219', 'rohit.jain@gmail.com', 'Goa', 'Want to book a beach holiday.', 'new', '2024-10-07 13:23:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content_package`
--

CREATE TABLE `content_package` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `tour_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `tour_package_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `content_package`
--

INSERT INTO `content_package` (`id`, `image_path`, `tour_name`, `location`, `description`, `tour_package_id`, `created_at`) VALUES
(7, 'images/up.jpeg', 'Delhi UttarPradesh', 'India', '    Day 1: Arrival in Delhi\r\n    Arrival: Reach Delhi, the capital of India, by flight or train.\r\n    Activities:\r\n        Check into a mid-range hotel (e.g., Hotel Hari Piorko).\r\n        Visit the Red Fort and Jama Masjid.\r\n        Stroll around Chandni Chowk and enjoy street food at Paranthe Wali Gali.\r\n    Stay: Hotel Hari Piorko, Delhi\r\n\r\n    Day 2: Delhi Sightseeing\r\n    Activities:\r\n        Explore India Gate, Qutub Minar, and Humayun\'s Tomb.\r\n        Visit Lotus Temple and drive past Rashtrapati Bhavan.\r\n        Shop at Connaught Place and enjoy dinner at a local restaurant.\r\n        Stay: Hotel Hari Piorko, Delhi\r\n\r\n    Day 3: Delhi to Agra (230 km, 4 hours)\r\n    Activities:\r\n        Early morning departure for Agra.\r\n        Visit the Taj Mahal and Agra Fort.\r\n        Explore Mehtab Bagh for a sunset view of the Taj Mahal.\r\n    Stay: Hotel Taj Resorts, Agra\r\n\r\n    Day 4: Agra to Mathura-Vrindavan to Fatehpur Sikri (100 km, 2 hours)\r\n    Activities:\r\n        Visit the Krishna Janmabhoomi Temple and Banke Bihari Temple in Mathura.\r\n        Explore the ISKCON Temple in Vrindavan.\r\n        Drive to Fatehpur Sikri and visit the Buland Darwaza and Jama Masjid.\r\n    Stay: Hotel Goverdhan Palace, Mathura\r\n\r\n    Day 5: Mathura to Lucknow (360 km, 6 hours)\r\n    Activities:\r\n        Depart for Lucknow, the City of Nawabs.\r\n        Check into a hotel (e.g., Hotel Clarks Avadh).\r\n        Explore Bara Imambara and Chota Imambara.\r\n    Stay: Hotel Clarks Avadh, Lucknow\r\n\r\n    Day 6: Lucknow Sightseeing\r\n    Activities:\r\n        Visit Rumi Darwaza and the British Residency.\r\n        Stroll around Hazratganj Market for shopping and local cuisine.\r\n        Visit the Ambedkar Memorial Park.\r\n    Stay: Hotel Clarks Avadh, Lucknow\r\n\r\n    Day 7: Lucknow to Varanasi (320 km, 5.5 hours)\r\n    Activities:\r\n        Early morning departure for Varanasi.\r\n        Check into a hotel (e.g., Hotel Alka).\r\n        Attend the Ganga Aarti at Dashashwamedh Ghat in the evening.\r\n    Stay: Hotel Alka, Varanasi\r\n\r\n    Day 8: Varanasi Sightseeing\r\n    Activities:\r\n        Visit Kashi Vishwanath Temple and Sankat Mochan Temple.\r\n        Take a boat ride on the Ganges at sunrise.\r\n        Explore Sarnath, the birthplace of Buddhism.\r\n    Stay: Hotel Alka, Varanasi\r\n\r\n    Day 9: Varanasi to Allahabad (120 km, 3 hours)\r\n    Activities:\r\n        Drive to Allahabad (Prayagraj).\r\n        Visit Triveni Sangam, Anand Bhavan, and Khusro Bagh.\r\n        Check into a hotel (e.g., Hotel Kanha Shyam).\r\n    Stay: Hotel Kanha Shyam, Allahabad\r\n\r\n    Day 10: Allahabad to Ayodhya (170 km, 4 hours)\r\n    Activities:\r\n        Early morning departure for Ayodhya.\r\n        Visit Ram Janmabhoomi and Hanuman Garhi.\r\n        Explore Kanak Bhawan and Sita Ki Rasoi.\r\n    Stay: Hotel Ramprastha, Ayodhya\r\n\r\n    Day 11: Ayodhya to Naimisaranya\r\n    Activities:\r\n\r\n    Stay: \r\n\r\n    Day 12: Ayodhya to Lucknow to Delhi (135 km, 3 hours to Lucknow; Flight to Delhi)\r\n    Activities:\r\n        Drive back to Lucknow.\r\n        Fly back to Delhi.\r\n        Drop off at the airport or railway station for your return journey.\r\n\r\n    Estimated Cost for bharatyatra Traveler\r\n    Accommodation: ₹15,000 (₹1,500 per night for 11 nights)\r\n    Transportation (Car with Driver): ₹20,000 (including fuel and tolls)\r\n    Meals: ₹10,000 (₹1,000 per day)\r\n    Sightseeing & Entry Fees: ₹7,000\r\n    Miscellaneous (Boating, Aarti, etc.): ₹3,000\r\n    Total Estimated Cost: ₹56,000 per person\r\n\r\n    This estimate is providing by guides of bharatyatra for a bharatyatra traveler, which includes 5-star hotels, private transportation, and a balance of comfort and affordability. Prices may vary depending on the season and specific preferences.\r\n\r\n\r\n\r\n\r\n\r\n', 4, '2024-10-08 10:48:29'),
(8, 'images/ch.jpg', 'Chhattisgarh', 'India', '12-Day Chhattisgarh Travel Itinerary\r\n\r\nDay 1: Arrival in Raipur\r\nArrival: Reach Raipur by flight or train. \r\nActivities:\r\n    Check into a mid-range hotel (e.g., Hotel Babylon International).\r\n    Visit the Mahant Ghasidas Memorial Museum and Rajiv Smriti Van.\r\n    Explore local markets and enjoy a traditional Chhattisgarhi meal. \r\nStay: Hotel Babylon International, Raipur\r\n\r\nDay 2: Raipur Sightseeing\r\nActivities:\r\n    Visit the Nandan Van Zoo and Safari.\r\n    Explore the Vivekananda Sarovar and Purkhauti Muktangan.\r\n    Enjoy local cuisine at a renowned restaurant. \r\nStay: Hotel Babylon International, Raipur\r\n\r\nDay 3: Raipur to Bilaspur (110 km, 2.5 hours)\r\nActivities:\r\n    Drive to Bilaspur.\r\n    Visit the Achanakmar Wildlife Sanctuary.\r\n    Explore the local markets and temples. \r\nStay: Hotel Dwarika, Bilaspur\r\n\r\nDay 4: Bilaspur to Korba (120 km, 3 hours)\r\nActivities:\r\n    Drive to Korba.\r\n    Visit the Koriya and Koriya Wildlife Sanctuaries.\r\n    Explore local attractions and markets. \r\nStay: Hotel Grand Korba, Korba\r\n\r\nDay 5: Korba to Jagdalpur (250 km, 6 hours)\r\nActivities:\r\n    Drive to Jagdalpur.\r\n    Visit the Chitrakote Waterfall and Tirathgarh Waterfall.\r\n    Explore the local tribal markets. \r\nStay: Hotel Mangi\'s, Jagdalpur\r\n\r\nDay 6: Jagdalpur Sightseeing\r\nActivities:\r\n    Visit the Kanger Valley National Park and its famous caves (Kanger Caves).\r\n    Explore local tribal villages and learn about their culture.\r\n    Enjoy traditional tribal cuisine. \r\nStay: Hotel Mangi\'s, Jagdalpur\r\n\r\nDay 7: Jagdalpur to Dantewada (90 km, 2 hours)\r\nActivities:\r\n    Drive to Dantewada.\r\n    Visit the Dantewada Temple and the local market.\r\n    Explore the nearby village and interact with locals. \r\nStay: Hotel Anand, Dantewada\r\n\r\nDay 8: Dantewada to Raigarh (220 km, 5 hours)\r\nActivities:\r\n    Drive to Raigarh.\r\n    Visit the Raigarh Fort and the local market.\r\n    Explore nearby attractions and enjoy local cuisine. \r\nStay: Hotel Arpit, Raigarh\r\n\r\nDay 9: Raigarh to Bilaspur (150 km, 3.5 hours)\r\nActivities:\r\n    Drive back to Bilaspur.\r\n    Free day for leisure activities or revisiting favorite spots. \r\nStay: Hotel Dwarika, Bilaspur\r\n\r\nDay 10: Bilaspur to Raipur (110 km, 2.5 hours)\r\nActivities:\r\n    Drive back to Raipur.\r\n    Visit any missed attractions or explore local markets. \r\nStay: Hotel Babylon International, Raipur\r\n\r\nDay 11: Raipur to Sirpur (80 km, 2 hours)\r\nActivities:\r\n    Drive to Sirpur.\r\n    Visit the Sirpur Archaeological Site and Laxman Temple.\r\n    Explore the local area and return to Raipur. \r\nStay: Hotel Babylon International, Raipur\r\n\r\nDay 12: Departure from Raipur\r\nActivities:\r\n    Last-minute shopping or relaxing.\r\n    Drop off at the airport or railway station for your return journey.\r\n\r\nKey Highlights and Famous Things in Chhattisgarh\r\n    Chitrakote Waterfall: Often called the \"Niagara of India,\" it\'s one of the largest waterfalls in India.\r\n    Kanger Valley National Park: Known for its scenic beauty and biodiversity.\r\n    Sirpur Archaeological Site: Famous for its ancient temples and ruins.\r\n\r\nEstimated Cost for bharatyatra Travelers\r\nAccommodation: ₹30,000\r\nFood: ₹15,000\r\nTransport: ₹35,000\r\nEntry Fees & Activities: ₹12,000\r\n\r\nTotal Estimated Cost: ₹92,000 per person\r\n\r\nThis estimate includes 5-star hotels, private transportation, and a balance of comfort and affordability. Prices may vary depending on the season and specific preferences.', 3, '2024-10-08 10:49:27'),
(9, 'images/ap4.jpg', 'Andhra-Pradesh', 'India', '12-Day Andhra Pradesh Travel Itinerary\r\n\r\nDay 1: Arrival in Visakhapatnam\r\nArrival: Reach Visakhapatnam (Vizag), a major port city known for its beaches and natural beauty, by flight or train.\r\nActivities:\r\n    Check into a mid-range hotel (e.g., Hotel Novotel).\r\n    Visit Ramakrishna Beach and the INS Kursura Submarine Museum.\r\n    Explore the Kailasagiri Hill Park for panoramic views.\r\nStay: Hotel Novotel, Visakhapatnam\r\n\r\nDay 2: Visakhapatnam Sightseeing\r\nActivities:\r\n    Visit the Simhachalam Temple and explore Araku Valley.\r\n    Enjoy a trip to Borra Caves, famous for their stalactites and stalagmites.\r\n    Visit the Tribal Museum in Araku Valley.\r\nStay: Hotel Novotel, Visakhapatnam\r\n\r\nDay 3: Visakhapatnam to Rajahmundry (200 km, 4 hours)\r\nActivities:\r\n    Drive to Rajahmundry.\r\n    Visit the Dowleswaram Barrage and Godavari River.\r\n    Explore the ISKCON Temple and Kadiyapulanka flower gardens.\r\nStay: Hotel Shelton, Rajahmundry\r\n\r\nDay 4: Rajahmundry to Kakinada (65 km, 1.5 hours)\r\nActivities:\r\n    Drive to Kakinada.\r\n    Visit the Coringa Wildlife Sanctuary and Hope Island.\r\n    Explore Uppada Beach and the local fish market.\r\nStay: Hotel Grand Kakinada, Kakinada\r\n\r\nDay 5: Kakinada to Vijayawada (160 km, 3.5 hours)\r\nActivities:\r\n    Drive to Vijayawada.\r\n    Visit the Kanaka Durga Temple and Prakasam Barrage.\r\n    Explore Bhavani Island and the Undavalli Caves.\r\nStay: Hotel Novotel, Vijayawada\r\n\r\nDay 6: Vijayawada to Guntur (35 km, 1 hour)\r\nActivities:\r\n    Drive to Guntur.\r\n    Visit Amaravati, the ancient Buddhist site and Amaravati Stupa.\r\n    Explore the Kondaveedu Fort and Mangalagiri Temple.\r\n    Stay: Hotel V Royal Park, Guntur\r\n\r\nDay 7: Guntur to Ongole (120 km, 2.5 hours)\r\nActivities:\r\n    Drive to Ongole.\r\n    Visit the Kothapatnam Beach and Chennakesava Swamy Temple.\r\n    Explore local markets for Ongole cattle and tobacco products.\r\nStay: Hotel Mourya Inn, Ongole\r\n\r\nDay 8: Ongole to Nellore (145 km, 3 hours)\r\nActivities:\r\n    Drive to Nellore.\r\n    Visit the Udayagiri Fort and Venkatagiri Fort.\r\n    Explore the Nelapattu Bird Sanctuary.\r\nStay: Hotel Yesh Park, Nellore\r\n\r\nDay 9: Nellore to Tirupati (135 km, 3 hours)\r\nActivities:\r\n    Drive to Tirupati.\r\n    Visit the famous Tirumala Venkateswara Temple.\r\n    Explore Chandragiri Fort and the Sri Venkateswara Zoological Park.\r\nStay: Hotel Bliss, Tirupati\r\n\r\nDay 10: Tirupati to Srikalahasti (37 km, 1 hour)\r\nActivities:\r\n    Drive to Srikalahasti.\r\n    Visit the Srikalahasti Temple, known for its Vayu Linga.\r\n    Explore the Durgambika Temple and the Bhakta Kannappa Temple.\r\nStay: Hotel MGM Grand, Srikalahasti\r\n\r\nDay 11: Srikalahasti to Chittoor (50 km, 1.5 hours)\r\nActivities:\r\n    Drive to Chittoor.\r\n    Visit the Horsley Hills, a popular hill station.\r\n    Explore the Kalavagunta Temple and the Kaundinya Wildlife Sanctuary.\r\nStay: Hotel Saroj Krishna, Chittoor\r\n\r\nDay 12: Departure from Chittoor\r\nActivities:\r\n    Last-minute sightseeing or relaxing.\r\n    Drop off at the airport or railway station for your return journey.\r\n\r\nKey Highlights and Famous Things in Andhra Pradesh\r\n    Tirumala Venkateswara Temple: One of the most revered Hindu pilgrimage sites in India, known for its rich spiritual heritage.\r\n    Araku Valley: A picturesque hill station with coffee plantations, waterfalls, and caves.\r\n    Amaravati: An ancient Buddhist site with a historic stupa and archaeological significance.\r\n\r\nEstimated Cost for bharatyatra Travelers\r\n\r\nAccommodation: ₹27,000\r\nFood: ₹13,200\r\nTransport: ₹28,000\r\nEntry Fees & Activities: ₹8,500\r\n\r\nTotal Estimated Cost: ₹76,700 per person\r\n\r\nThis estimate provided by guides of bharatyatra for a bharatyatra traveler includes 4-star hotels, private transportation, and a balance of comfort and affordability. Prices may vary depending on the season and specific preferences.', 1, '2024-10-17 06:29:31'),
(10, 'images/Jharkhand.jpeg', 'Bihar-Jharkhand', 'India', '12-Day Bihar and Jharkhand Travel Itinerary\r\n\r\nDay 1: Arrival in Patna, Bihar\r\nArrival: Reach Patna, the capital city of Bihar, by flight or train.\r\nActivities:\r\n    Check into a mid-range hotel (e.g., Hotel Maurya).\r\n    Visit Golghar, Patna Museum, and Gandhi Maidan.\r\n    Enjoy an evening stroll by the Ganges River.\r\nStay: Hotel Maurya, Patna\r\n\r\nDay 2: Patna to Nalanda and Rajgir (90 km, 2.5 hours)\r\nActivities:\r\n    Drive to Nalanda and explore the ancient Nalanda University ruins and Nalanda Archaeological Museum.\r\n    Continue to Rajgir and visit Venu Vana, the Griddhakuta Hill, and Japanese Peace Pagoda.\r\nStay: Hotel Siddharth, Rajgir\r\n\r\nDay 3: Rajgir to Bodh Gaya (75 km, 2 hours)\r\nActivities:\r\n    Drive to Bodh Gaya, the place where Lord Buddha attained enlightenment.\r\n    Visit the Mahabodhi Temple, Bodhi Tree, and various international monasteries.\r\n    Participate in an evening prayer at the temple.\r\nStay: Hotel Bodhgaya Regency, Bodh Gaya\r\n\r\nDay 4: Bodh Gaya to Gaya and Back (15 km, 30 minutes)\r\nActivities:\r\n    Drive to Gaya and visit Vishnupad Temple, Mangla Gauri Temple, and Pretshila Hill.\r\n    Return to Bodh Gaya for relaxation and meditation.\r\nStay: Hotel Bodhgaya Regency, Bodh Gaya\r\n\r\nDay 5: Bodh Gaya to Deoghar, Jharkhand (200 km, 5 hours)\r\nActivities:\r\n    Drive to Deoghar, known for its spiritual significance.\r\n    Visit the Baidyanath Temple, one of the 12 Jyotirlingas of Lord Shiva.\r\n    Explore the Nandan Pahar and Trikut Hill.\r\nStay: Hotel Yashoda International, Deoghar\r\n\r\nDay 6: Deoghar to Ranchi (270 km, 6 hours)\r\nActivities:\r\n    Drive to Ranchi, the capital of Jharkhand.\r\n    Visit the Tagore Hill, Ranchi Lake, and Pahari Mandir.\r\n    Enjoy the local Jharkhand cuisine.\r\nStay: Hotel Radisson Blu, Ranchi\r\n\r\nDay 7: Ranchi Sightseeing\r\n    Activities:\r\n    Visit the Birsa Zoological Park, Rock Garden, and Kanke Dam.\r\n    Explore the beautiful waterfalls around Ranchi, such as Hundru Falls and Jonha Falls.\r\nStay: Hotel Radisson Blu, Ranchi\r\n\r\nDay 8: Ranchi to Jamshedpur (130 km, 3 hours)\r\nActivities:\r\n    Drive to Jamshedpur, known as the Steel City.\r\n    Visit the Tata Steel Zoological Park, Jubilee Park, and Dimna Lake.\r\nStay: Hotel Fortune Park Centre Point, Jamshedpur\r\n\r\nDay 9: Jamshedpur to Hazaribagh (180 km, 4.5 hours)\r\nActivities:\r\n    Drive to Hazaribagh, a city surrounded by forests and natural beauty.\r\n    Visit Hazaribagh Wildlife Sanctuary and Canary Hill.\r\n    Explore the local markets.\r\nStay: Hotel Canary Hill, Hazaribagh\r\n\r\nDay 10: Hazaribagh to Bhagalpur (200 km, 5 hours)\r\nActivities:\r\n    Drive to Bhagalpur, known for its silk industry.\r\n    Visit the Vikramshila Ruins, Mandar Hill, and Kuppaghat Ashram.\r\nStay: Hotel Rajhans International, Bhagalpur\r\n\r\nDay 11: Bhagalpur to Vaishali and Back to Patna (200 km, 5 hours)\r\nActivities:\r\n    Drive to Vaishali, an important archaeological site related to Buddha.\r\n    Visit Ashokan Pillar, Vishwa Shanti Stupa, and the Relic Stupa.\r\n    Return to Patna for the night.\r\nStay: Hotel Maurya, Patna\r\n\r\nDay 12: Departure from Patna\r\nActivities:\r\n    Last-minute shopping or relaxing.\r\n    Drop off at the airport or railway station for your return journey.\r\n\r\nKey Highlights and Famous Things in Bihar and Jharkhand\r\nMahabodhi Temple (Bodh Gaya): A UNESCO World Heritage Site where Buddha attained enlightenment.\r\nNalanda University: Ancient center of learning and a significant historical site.\r\nBaidyanath Temple (Deoghar): A major pilgrimage site for Hindus, dedicated to Lord Shiva.\r\nRanchi Waterfalls: Picturesque waterfalls that are popular tourist attractions in Jharkhand.\r\n\r\nEstimated Cost for bharatyatra Travelers:\r\nAccommodation: ₹30,000\r\nFood: ₹15,000\r\nTransport: ₹35,000\r\nEntry Fees & Activities: ₹10,000\r\n\r\nTotal Estimated Cost: ₹90,000 per person\r\n\r\nThis estimate is provided by guides of BharatYatra for a BharatYatra traveler, which includes 4-star hotels, private transportation, and a balance of comfort and affordability. Prices may vary depending on the season and specific preferences.', 2, '2024-10-17 10:16:58'),
(11, 'images/goa2.jpeg', 'Goa', 'India', '12-Day Goa Travel Itinerary\r\n\r\nDay 1: Arrival in Goa\r\nArrival: Reach Goa by flight or train.\r\nActivities:\r\n    Check into a mid-range hotel (e.g., The Park Calangute).\r\n    Relax at Calangute Beach.\r\n    Explore the local markets and enjoy a Goan dinner. \r\nStay: The Park Calangute, Goa\r\n\r\nDay 2: North Goa Beaches\r\nActivities:\r\n    Visit Baga Beach for water sports.\r\n    Explore Anjuna Beach and Flea Market.\r\n    Visit Vagator Beach for a scenic sunset. \r\nStay: The Park Calangute, Goa\r\n\r\nDay 3: Historic Sites in Old Goa\r\nActivities:\r\n    Visit Basilica of Bom Jesus and Se Cathedral.\r\n    Explore the Archaeological Museum.\r\n    Visit St. Augustine Tower and Church of St. Cajetan. \r\nStay: The Park Calangute, Goa\r\n\r\nDay 4: Panjim and Dona Paula\r\nActivities:\r\n    Explore Panjim’s Latin Quarter, Fontainhas.\r\n    Visit the Church of Our Lady of the Immaculate Conception.\r\n    Take a trip to Dona Paula Beach.\r\n    Enjoy a river cruise on the Mandovi River. \r\nStay: Vivanta by Taj, Panaji\r\n\r\nDay 5: South Goa Beaches\r\nActivities:\r\n    Drive to South Goa.\r\n    Visit Colva Beach and Benaulim Beach.\r\n    Explore Palolem Beach for its serene beauty.    \r\nStay: The Leela, Goa\r\n\r\nDay 6: Wildlife and Nature\r\nActivities:\r\n    Visit Bhagwan Mahavir Wildlife Sanctuary.\r\n    Explore Dudhsagar Waterfalls.\r\n    Visit Spice Plantations in Ponda. \r\nStay: The Leela, Goa\r\n\r\nDay 7: Adventure and Water Sports\r\nActivities:\r\n    Try water sports at Candolim Beach.\r\n    Go snorkeling and scuba diving at Grande Island.\r\n    Relax at Sinquerim Beach. \r\nStay: Novotel Goa Resort & Spa, Candolim\r\n\r\nDay 8: Explore Goa’s Hinterlands\r\nActivities:\r\n    Visit the Salaulim Dam and Botanical Gardens.\r\n    Explore the lesser-known Cabo de Rama Fort.\r\n    Visit Cotigao Wildlife Sanctuary. \r\nStay: Novotel Goa Resort & Spa, Candolim\r\n\r\nDay 9: Visit Churches and Temples\r\nActivities:\r\n    Explore the Church of St. Francis of Assisi.\r\n    Visit Shri Manguesh Temple and Shantadurga Temple.\r\n    Explore Chandreshwar Bhutnath Temple. \r\nStay: The Lalit Golf & Spa Resort, Canacona\r\n\r\nDay 10: Shopping and Markets\r\nActivities:\r\n    Visit the Mapusa Market for traditional Goan crafts.\r\n    Explore the flea markets in Arpora and Anjuna.\r\n    Enjoy street food and local cuisine. \r\nStay: The Lalit Golf & Spa Resort, Canacona\r\n\r\nDay 11: Relaxation and Spa Day\r\nActivities:\r\n    Enjoy a relaxing day at a spa in your hotel.\r\n    Spend time at Agonda Beach.\r\n    Optional visit to Cabo de Rama Beach for a secluded experience. Stay: The Lalit Golf & Spa Resort, Canacona\r\n\r\nDay 12: Departure from Goa\r\nActivities:\r\n    Last-minute shopping or beach time.\r\n    Drop off at the airport or railway station for your return journey.\r\n\r\nKey Highlights and Famous Things in Goa\r\n    Basilica of Bom Jesus: A UNESCO World Heritage Site and one of the most famous churches in Goa.\r\n    Dudhsagar Waterfalls: One of the highest waterfalls in India, located on the Mandovi River.\r\n    Palolem Beach: Known for its serene environment and beautiful sunsets.\r\n    Spice Plantations: Experience the rich aroma and flavors of Goan spices.\r\n    Panjim’s Latin Quarter: Explore the old-world charm of Goa’s capital with its vibrant streets.\r\n\r\nEstimated Cost for bharatyatra Travelers\r\nAccommodation: ₹36,000\r\nFood: ₹16,800\r\nTransport: ₹32,000\r\nEntry Fees & Activities: ₹12,000\r\n\r\nTotal Estimated Cost: ₹96,800 per person\r\n\r\nThis estimate is provided by guides of Bharat Yatra for a Bharat Yatra traveler, which includes 5-star hotels, private transportation, and a balance of comfort and affordability. Prices may vary depending on the season and specific preferences.', 5, '2024-10-21 05:37:28'),
(12, 'images/guj2.jpeg', 'Gujarat', 'India', '12-Day Gujarat Travel Itinerary\r\n\r\nDay 1: Arrival in Ahmedabad\r\nArrival: Reach Ahmedabad, the largest city in Gujarat, by flight or train.\r\nActivities:\r\n    Check into a mid-range hotel (e.g., The House of MG).\r\n    Visit Sabarmati Ashram, the residence of Mahatma Gandhi.\r\n    Explore Sardar Patel Museum and Kankaria Lake.\r\n    Stroll around Manek Chowk for local street food and shopping.\r\nStay: The House of MG, Ahmedabad\r\n\r\nDay 2: Ahmedabad Sightseeing\r\nActivities:\r\n    Visit the Ahmedabad Jain Temple and Swaminarayan Akshardham Temple.\r\n    Explore Adalaj Stepwell and its intricate architecture.\r\n    Shop at Law Garden Night Market for traditional Gujarati garments and handicrafts.\r\nStay: The House of MG, Ahmedabad\r\n\r\nDay 3: Ahmedabad to Vadodara (110 km, 2 hours)\r\nActivities:\r\n    Drive to Vadodara.\r\n    Visit the Laxmi Vilas Palace and Sayaji Garden.\r\n    Explore the Baroda Museum and Picture Gallery.\r\nStay: Taj Hotel, Vadodara\r\n\r\nDay 4: Vadodara to Gir National Park (270 km, 5 hours)\r\nActivities:\r\n    Drive to Gir National Park.\r\n    Check into a lodge (e.g., Gir Jungle Lodge).\r\n    Relax or take an evening safari.\r\nStay: Gir Jungle Lodge, Gir National Park\r\n\r\nDay 5: Gir National Park Safari\r\nActivities:\r\n    Full-day safari in Gir National Park to spot Asiatic lions and other wildlife.\r\n    Visit the Sasan Gir Interpretation Zone for educational displays on local wildlife.\r\n    Stay: Gir Jungle Lodge, Gir National Park\r\n\r\nDay 6: Gir National Park to Somnath (80 km, 2 hours)\r\nActivities:\r\n    Drive to Somnath.\r\n    Visit the Somnath Temple, a revered Jyotirlinga shrine.\r\n    Explore the Somnath Beach and Prabhas Patan Museum.\r\nStay: Hotel Lotus, Somnath\r\n\r\nDay 7: Somnath to Dwarka (230 km, 4.5 hours)\r\nActivities:\r\n    Drive to Dwarka.\r\n    Visit the Dwarkadhish Temple, one of the Char Dham pilgrimage sites.\r\n    Explore Nageshwar Temple and Gomti Ghat.\r\nStay: Dwarkadhish Lords Eco Inn, Dwarka\r\n\r\nDay 8: Dwarka Sightseeing\r\nActivities:\r\n    Take a boat ride to Bet Dwarka.\r\n    Visit Rukmini Devi Temple.\r\n    Explore local markets and shops.\r\nStay: Dwarkadhish Lords Eco Inn, Dwarka\r\n\r\nDay 9: Dwarka to Kutch (350 km, 6 hours)\r\nActivities:\r\n    Drive to Kutch.\r\n    Check into a resort (e.g., Rann Riders).\r\n    Explore local crafts and enjoy a traditional Kutch meal.\r\nStay: Rann Riders, Kutch\r\n\r\nDay 10: Kutch Desert Experience\r\nActivities:\r\n    Explore the Rann of Kutch and enjoy the stunning White Desert landscapes.\r\n    Visit Kalo Dungar for panoramic views.\r\n    Experience a camel safari and a cultural program at Sam Sand Dunes.\r\n    Stay overnight in a desert camp.\r\nStay: Desert Camp, Kutch\r\n\r\nDay 11: Kutch to Ahmedabad (400 km, 7 hours)\r\nActivities:\r\n    Drive back to Ahmedabad.\r\n    Visit Gandhi Ashram and explore local markets for last-minute shopping.\r\nStay: The House of MG, Ahmedabad\r\n\r\nDay 12: Departure\r\nActivities:\r\n    Depending on your flight/train schedule, visit Gujarat Vidyapith or relax in a local café.\r\n    Departure from Ahmedabad.\r\n\r\nKey Highlights and Famous Things in Gujarat\r\n    Sabarmati Ashram: A historical site associated with Mahatma Gandhi’s struggle for independence.\r\n    Gir National Park: The last refuge of the Asiatic lion, offering unique wildlife experiences.\r\n    Somnath Temple: One of the 12 Jyotirlingas, important for Hindu pilgrims.\r\n    Dwarka: One of the Char Dham pilgrimage sites with significant religious importance.\r\n    Kutch Desert: Known for its expansive white salt desert and unique cultural experiences.\r\n\r\nEstimated Cost for bharatyatra Travelers\r\n\r\nAccommodation: ₹25,000\r\nFood: = ₹12,000\r\nTransport: ₹28,000\r\nEntry Fees & Activities: ₹5,000\r\nDesert Camp Experience: ₹4,000\r\n\r\nTotal Estimated Cost: ₹74,000 per person\r\n\r\nThis estimate is providing by guides of bharatyatra for a bharatyatra traveler, which includes 5-star hotels, private transportation, and a balance of comfort and affordability. Prices may vary depending on the season and specific preferences.', 6, '2024-10-23 17:29:25');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `comments` text NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `rating`, `comments`, `status`, `submission_date`) VALUES
(1, 'Amit Sharma', 'amit.sharma@gmail.com', 5, 'Excellent service and experience.', 'approved', '2024-10-07 13:23:57'),
(2, 'Neha Verma', 'neha.verma@gmail.com', 4, 'Great trip but some improvements can be made.', 'rejected', '2024-10-07 13:23:57'),
(3, 'Rahul Mehta', 'rahul.mehta@gmail.com', 3, 'Average experience, could have been better.', 'pending', '2024-10-07 13:23:57'),
(4, 'Pooja Singh', 'pooja.singh@gmail.com', 5, 'Amazing trip! Loved every part of it.', 'approved', '2024-10-07 13:23:57'),
(5, 'Vikram Patel', 'vikram.patel@gmail.com', 2, 'Not satisfied with the service.', 'rejected', '2024-10-07 13:23:57'),
(6, 'Anjali Desai', 'anjali.desai@gmail.com', 4, 'Very good experience overall.', 'approved', '2024-10-07 13:23:57'),
(7, 'Suresh Gupta', 'suresh.gupta@gmail.com', 3, 'The trip was okay, but there were some delays.', 'pending', '2024-10-07 13:23:57'),
(8, 'Kavita Joshi', 'kavita.joshi@gmail.com', 5, 'Loved the trip! Highly recommended.', 'approved', '2024-10-07 13:23:57'),
(9, 'Nikhil Kapoor', 'nikhil.kapoor@gmail.com', 1, 'Worst experience ever.', 'pending', '2024-10-07 13:23:57'),
(10, 'Richa Saxena', 'richa.saxena@gmail.com', 4, 'Good trip, had a great time.', 'approved', '2024-10-07 13:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cost` varchar(50) NOT NULL,
  `duration` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `title`, `image`, `description`, `cost`, `duration`, `location`, `status`, `submission_date`) VALUES
(1, 'Andhra Pradesh', 'images/ap3.png', 'Known for its rich cultural heritage, historical monuments, and scenic landscapes.', '76,700/Person', '12 Days', 'Andhra Pradesh,India', 'active', '2024-10-08 10:37:21'),
(2, 'Bihar and Jharkhand', 'images/bihar.jpeg', 'Known for its historical significance as a center of ancient Indian civilization.', '90,000/Person', '12 Days', 'Bihar and Jharkhand', 'active', '2024-10-08 10:38:41'),
(3, 'Chhattisgarh', 'images/chattisgadh2.jpeg', 'Famous for its tribal culture, dense forests, and natural beauty.', '92,000/Person', '12 Days', 'Chhattisgarh,India', 'active', '2024-10-08 10:40:34'),
(4, 'Delhi UttarPradesh', 'images/up.jpeg', 'Renowned for its picturesque hill stations, spiritual sites, and cultural heritage.', '56,000/Person', '12 Days', 'Delhi UttarPradesh,India', 'active', '2024-10-08 10:42:25'),
(5, 'Goa', 'images/goa.jpeg', 'Renowned for its beautiful beaches, vibrant nightlife, and Portuguese heritage.', '90,000/Person', '12 Days', 'Goa/India', 'active', '2024-10-21 05:36:43'),
(6, 'Gujarat', 'images/guj.jpeg', 'Known for its diverse cultural heritage, historical landmarks, and wildlife sanctuaries.', '74,000', '12 Days', 'Gujarat,India', 'active', '2024-10-23 17:28:37'),
(7, 'Rajasthan', 'jaipur.jpg', 'Famous for its royal palaces, desert landscapes, and rich cultural heritage.', '74,000/Person', '12 Days', 'Goa,India', 'active', '2024-11-10 06:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` enum('active','blocked') DEFAULT 'active',
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL DEFAULT 'uploads/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `status`, `submission_date`, `first_name`, `last_name`, `phone`, `profile_image`) VALUES
(10, 'pallvi', 'poojazanzmera31@gmail.com', '$2y$10$0RANwAbMgsyVMGAuVBtlmevMB98s/DVTOz9MRzhKCYk3T2WcJ2S4i', 'active', '2025-02-07 07:17:07', 'Pooja', 'Zanzmera', '9879719578', 'uploads/pp2.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `contact_form_submissions`
--
ALTER TABLE `contact_form_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_package`
--
ALTER TABLE `content_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_package_id` (`tour_package_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact_form_submissions`
--
ALTER TABLE `contact_form_submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `content_package`
--
ALTER TABLE `content_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `content_package`
--
ALTER TABLE `content_package`
  ADD CONSTRAINT `content_package_ibfk_1` FOREIGN KEY (`tour_package_id`) REFERENCES `tour_packages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
