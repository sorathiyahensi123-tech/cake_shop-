-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2025 at 05:54 AM
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
-- Database: `onlinecakeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cake_shop_admin_registrations`
--

CREATE TABLE `cake_shop_admin_registrations` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_shop_admin_registrations`
--

INSERT INTO `cake_shop_admin_registrations` (`admin_id`, `admin_username`, `admin_email`, `admin_password`) VALUES
(1, 'kaxeel', 'k@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `cake_shop_category`
--

CREATE TABLE `cake_shop_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_shop_category`
--

INSERT INTO `cake_shop_category` (`category_id`, `category_name`, `category_image`) VALUES
(1, 'Cakes', '250310112706.webp'),
(3, 'Desserts', '250312010240.webp'),
(4, 'Cookies', '250310110543.webp'),
(5, 'pastries', '250312105157.webp'),
(6, 'Breads & Savories', '250314102005.webp');

-- --------------------------------------------------------

--
-- Table structure for table `cake_shop_orders`
--

CREATE TABLE `cake_shop_orders` (
  `orders_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `invoice_id` varchar(50) NOT NULL,
  `delivery_date` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `total_amount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_shop_orders`
--

INSERT INTO `cake_shop_orders` (`orders_id`, `users_id`, `invoice_id`, `delivery_date`, `payment_method`, `total_amount`) VALUES
(1, 1, 'HEER-20250329MI72', '2025-03-31T10:17', 'Cash', '449'),
(2, 1, 'HEER-20250329TE51', '2025-03-31T10:22', 'Cash', '419');

-- --------------------------------------------------------

--
-- Table structure for table `cake_shop_orders_detail`
--

CREATE TABLE `cake_shop_orders_detail` (
  `orders_detail_id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_shop_orders_detail`
--

INSERT INTO `cake_shop_orders_detail` (`orders_detail_id`, `orders_id`, `product_name`, `quantity`) VALUES
(1, 1, 'Red velvet', 1),
(2, 2, 'Biscottie', 1),
(3, 2, 'Gingersnap', 1),
(4, 2, 'Choco chips', 1),
(5, 2, 'Fortune', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cake_shop_product`
--

CREATE TABLE `cake_shop_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_description` varchar(300) NOT NULL,
  `product_image` varchar(300) NOT NULL,
  `product_discount` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_shop_product`
--

INSERT INTO `cake_shop_product` (`product_id`, `product_name`, `product_category`, `product_price`, `product_description`, `product_image`, `product_discount`) VALUES
(1, 'Black choco', 1, '499', 'A black chocolate cake is a rich and indulgent dessert made with dark cocoa or black cocoa powder, giving it a deep, almost jet-black color.\r\nIt is Non-vage cake !\r\nQty(400 gm.)', '2007310437280.jpg, 2007310437281.jpg, 2007310437282.jpg', 0),
(2, 'Red velvet', 1, '449', 'Red velvet cake is a classic, elegant dessert known for its vibrant red color and velvety-soft texture.\r\nIt is Veg Cake !\r\nQty(400 gm.)', '2007310439020.jpg, 2007310439021.jpg, 2007310439022.jpg', 0),
(3, 'Black forest', 1, '549', 'Black Forest Cake is a classic German dessert known for its rich chocolate flavor and luscious cherry filling.\r\nIt is Veg Cake !\r\nQty(450 gm.)', '2007310440210.jpg, 2007310440211.jpg, 2007310440212.jpg', 0),
(4, 'Oreo', 1, '649', 'Oreo cake is a delicious and indulgent dessert inspired by the Oreo cookie. It features layers of moist chocolate sponge cake, filled and frosted with a rich cookies-and-cream frosting made from crushed Oreo cookies mixed into whipped cream or buttercream.\r\nQty(400 gm.)\r\nIt is Non veg cake !', '2007310441020.jpg, 2007310441021.jpg, 2007310441022.jpg', 0),
(5, 'Black Choco', 2, '100', 'This is a black chocolate.', '2007310442250.jpg', 0),
(6, 'Strawberry', 2, '100', 'This is a strawberry.', '2007310443190.jpg', 0),
(7, 'Butterscotch', 2, '100', 'This is a butterscotch.', '2007310444030.jpg', 0),
(8, 'Choco chips', 4, '80', 'This is a plate of rich and delicious chocolate chip cookies with a dark brown, crumbly texture. The cookies are generously topped with semi-sweet chocolate chips, which have slightly melted into the dough, enhancing their gooey appeal.\r\nQty(5 piece)', '2503120119160.jpg', 0),
(11, 'Black Choco', 5, '80', 'This is black chocolate .\r\nQty(50 gm.)', '2503120921400.jpg', 0),
(12, 'Strawberry', 5, '99', 'This is strawberry.\r\nQty(50 gm.)', '2503120923140.jpg', 0),
(13, 'Butterscotch', 5, '80', 'This is Butterscotch.\r\nQty(50 gm.)', '2503120924400.jpg', 0),
(14, 'Choux', 5, '90', 'Choux pastry is a light, airy, and delicate dough that puffs up when baked, creating a crisp outer shell and a hollow interior perfect for fillings.\r\nQty(50 gm.)', '2503120958080.jpg', 0),
(15, 'Shortcrust', 5, '100', 'Shortcrust pastry is a crisp, crumbly, and buttery dough commonly used as a base for pies, tarts, and quiches.\r\nQty(50 gm.)', '2503121000030.jpg', 0),
(16, 'Danish ', 5, '120', 'Danish pastry is a light, flaky, and buttery pastry made from laminated yeast-leavened dough.\r\nQty(50 gm.)', '2503121001120.jpg', 0),
(17, 'Austrain', 5, '150', 'This is an elegant raspberry and cream pastry, beautifully decorated with fresh raspberries, whipped cream, and delicate sugar flowers.\r\nQty(50 gm.)', '2503121006460.jpg', 0),
(18, 'Filo', 5, '140', 'This is Baklava, a famous Middle Eastern and Mediterranean pastry made with layers of thin phyllo (filo) dough, finely chopped nuts (usually pistachios or walnuts), and sweetened with honey or sugar syrup.\r\nQty(50 gm.)', '2503121013470.png', 0),
(19, 'Donuts', 5, '70', 'The image showcases four baked donuts dusted with powdered sugar, placed on parchment paper over a bright turquoise wooden surface. A small sieve filled with powdered sugar and a white bowl are on the left side, and a red and white checkered napkin is neatly folded on the right.\r\nQty(50 gm.)', '2503121019510.jpg', 0),
(20, 'Bakingo', 5, '130', 'The image features two beautifully layered strawberry shortcake pastries with alternating layers of sponge cake and cream, topped with fresh strawberry compote and piped whipped cream.\r\nQty(50 gm.)', '2503121022520.webp', 0),
(21, 'Chocochips', 5, '80', 'The image features two rich and decadent chocolate pastries with multiple layers of moist chocolate sponge and creamy chocolate filling.\r\nQty(50 gm.)', '2503121026480.jpg', 0),
(22, 'Blueberry', 5, '149', 'The image showcases a slice of delicious blueberry cake with layers of soft vanilla sponge and blueberry-infused cream.\r\nQty(50 gm.)', '2503121029060.webp', 0),
(23, 'Choco vanilla', 1, '349', 'This elegant choco-vanilla cake features a striking half-and-half design, combining rich chocolate and smooth vanilla frosting.\r\nIt is Non-veg cake !\r\nQty(500 gm.)', '2503121041460.jpg', 0),
(24, 'Mild Choco', 1, '399', 'This elegant mild chocolate cake is covered with a smooth, creamy white chocolate ganache and artistically drizzled with fine chocolate streaks.\r\nIt is Veg Cake !\r\nQty(500 gm.)', '2503121043190.jpg', 0),
(25, '3-tier choco', 1, '1299', 'This stunning three-tier chocolate cake is a masterpiece of elegance and indulgence. Each tier is coated in a smooth, glossy chocolate ganache, giving it a rich and luxurious appearance.\r\nIt is Veg Cake !\r\nQty(1 kg.)', '2503121048380.jpg', 20),
(26, '2-tier cherry choco', 1, '749', 'This is a beautifully decorated two-tier chocolate cake with intricate chocolate icing patterns. It is adorned with red cherries and chocolate shards, giving it a luxurious and appetizing look.\r\nIt is Veg Cake !\r\nQty(650 gm.)', '2503121059560.jpg', 0),
(27, 'Engagement cake', 1, '1449', 'This is an elegant three-tier wedding or engagement cake with a white and chocolate drip design. It is decorated with fresh strawberries, chocolate-covered strawberries, Oreo cookies, heart-shaped decorations, and chocolate sticks.\r\nIt is Veg Cake !\r\nQty(1.5 kg.)\r\n', '2503121105090.png', 20),
(28, 'Panda Choco', 1, '849', 'This is a beautifully designed panda-themed cake with a black-and-white color scheme. The cake features a smooth white base with black chocolate drips running down the sides.\r\nIt is Non - Veg Cake !\r\nQty(650 gm.)', '2503121110120.jpg', 20),
(29, 'Heart shape', 1, '1099', 'This is a romantic heart-shaped wedding or anniversary cake, designed with two interlocking hearts. The cake is covered in smooth white frosting with intricate piping along the edges.\r\nIt is Non-veg Cake !\r\nQty(700 gm.)', '2503121115350.jpg', 20),
(30, 'love cake', 1, '1399', 'This is a beautiful two-tier love-themed cake, perfect for romantic occasions like anniversaries, weddings, or Valentine Day.\r\nIt is Veg Cake !', '2503121232250.jpg', 20),
(31, 'Square chocolate', 1, '499', 'This is a beautifully crafted square chocolate cake with a glossy, mirror-like chocolate glaze. The cake is decorated with delicate chocolate drizzles, crunchy caramelized nuts, and chocolate truffles arranged artistically on top.\r\nIt is Veg Cake !\r\nQty(500 gm.)', '2503121250100.jpg', 0),
(32, 'Dry fruit cake', 1, '699', 'This is a wholesome whole wheat cake topped with a generous layer of chopped nuts, including almonds and cashews. The cake has a rustic, golden-brown texture, with a moist and dense crumb. A slice has been cut out, revealing bits of dried fruits inside.\r\nIt is Veg Cake !\r\nQty(500 gm.)', '2503121254540.jpg', 0),
(34, 'Battenberg', 1, '899', 'This is a beautifully layered cake with a vibrant pink frosting, elegantly decorated with chopped pistachios. The cake has alternating layers of yellow and pink sponge, giving it a visually appealing contrast.\r\nIt is Non-veg cake !\r\nQty(700 gm.)', '2503121257030.jpg', 20),
(35, 'coconut cake', 1, '949', 'The image features a beautifully decorated cake with a rich purple frosting. The cake is adorned with elegant piping along the top edge and is topped with fresh flowers, including purple and white blooms with green leaves.\r\nIt is Non -Veg Cake !\r\nQty(800 gm.)', '2503120104250.jpg', 20),
(36, 'Choco-leva', 1, '499', 'This is a rich and decadent chocolate cake covered in a glossy dark chocolate ganache. The sides of the cake are coated with fine chocolate crumbs, adding texture to the presentation.\r\nIt is Veg Cake !\r\nQty(400 gm.)', '2503120107130.jpg', 0),
(37, 'Tiramisu', 1, '599', 'This is a classic tiramisu cake with a smooth and creamy mascarpone cheese layer, dusted with a fine coat of cocoa powder on top.\r\nIt is Veg Cake !\r\nQty(500 gm.)', '2503120109190.webp', 0),
(38, 'Marble', 1, '999', 'This is an elegant chocolate marble cake with a smooth, creamy white frosting on top, decorated with fine chocolate drizzle. The sides of the cake are adorned with a dense layer of chocolate curls, creating a visually appealing texture.\r\nIt is Veg Cake !\r\nQty(700 gm.)', '2503120111430.webp', 20),
(39, 'Lamington', 1, '1099', 'This is a delicious Lamington cake with a light and fluffy sponge, coated in a generous layer of chocolate and desiccated coconut. The cake is sliced to reveal a rich filling of fresh cream and raspberry jam, creating a perfect balance of sweetness and tartness. It is placed on a wooden serving boar', '2503120113360.gif', 20),
(40, 'Gingersnap', 4, '90', 'his is a close-up photograph of freshly baked gingersnap cookies with a golden brown color and a textured surface. The cookies are coated in coarse sugar, giving them a delightful crunch.\r\nQty(3 piece)', '2503120124400.jpg', 0),
(41, 'Biscottie', 4, '99', 'This is an image of chocolate biscotti with chopped nuts, possibly walnuts or almonds, embedded in the crispy texture. The biscotti are stacked in a slightly leaning arrangement, showcasing their crunchy, twice-baked nature.\r\nQty(5 piece)', '2503120126460.jpg', 0),
(42, 'Fortune', 4, '150', 'This is an image of beautifully decorated fortune cookies dipped in glossy chocolate. Each cookie has a delicate pink sugar flower on top, adding an elegant and festive touch.\r\nQty(7 piece)', '2503120129370.webp', 0),
(43, 'Macaroons', 4, '99', 'This is a beautifully styled image of pink French macarons with a creamy white filling. The macarons are delicately arranged on a white pedestal cake stand, highlighting their smooth, glossy shells and delicate texture.\r\nQty(4 piece)', '2503120132230.webp', 0),
(44, 'Oatmeal', 4, '150', 'A stack of six golden-brown oatmeal raisin cookies with a crispy exterior and a soft, chewy texture. The cookies are filled with raisins and have a rustic, homemade appearance.\r\nQty(6 piece)', '2503120210060.jpg', 0),
(45, 'Spider', 4, '99', 'A close-up of Halloween-themed spider cookies made with round sugar cookies. Each cookie has a peanut butter cup placed in the center, decorated with candy eyes and chocolate icing to resemble spider legs.\r\nQty(4 piece)', '2503120211520.jpg', 0),
(46, 'snickerdoodle', 4, '50', 'A close-up of freshly baked snickerdoodle cookies with a golden-brown cinnamon-sugar coating. One cookie in the foreground has a bite taken out, revealing a soft and chewy interior.\r\nQty(5 piece)', '2503120214320.jpg', 0),
(47, 'red velvet', 4, '35', 'A plate of freshly baked red velvet cookies with a rich, deep red color, generously topped with white chocolate chips.\r\nQty(7 piece)\r\nthala ', '2503120216460.jpg', 0),
(48, 'blue', 4, '99', 'A stack of vibrant blue cookies loaded with chunks of chocolate chip cookies, Oreo pieces, and white and dark chocolate chips. The cookies have a soft, chewy texture with a colorful and playful appearance.\r\nQty(4 piece)', '2503120219410.jpg', 0),
(49, 'air fryer nutella ', 4, '99', 'A batch of rich, chocolate cookie sandwiches with a creamy white filling is neatly arranged on a wooden surface. \r\nQty(8 piece)', '2503120227590.jpg', 0),
(50, 'Milano', 4, '150', 'This image showcases freshly baked Milano-style cookies, which consist of two delicate, golden-brown oval-shaped biscuits sandwiched together with a layer of smooth chocolate filling.\r\nQty(3 piece)', '2503120238200.webp', 0),
(51, 'red velvet', 3, '159', 'The image features a slice of red velvet cake with rich red sponge layers and creamy white frosting.\r\nQty(1 piece)', '2503130129130.jpg', 0),
(52, 'strawberry ice cream', 3, '199', 'This image showcases a strawberry ice cream cake with a chocolate crust at the base. The cake consists of layers of creamy white and pink strawberry-flavored ice cream.\r\nQty(1 piece)', '2503130130090.webp', 0),
(53, ' lemon raspberry', 3, '179', 'This image features a slice of lemon raspberry cake with a moist, golden-yellow sponge infused with fresh raspberries. The cake has a layer of raspberry jam filling in the center, adding a rich, fruity contrast.\r\nQty(1 piece)', '2503130131390.jpg', 0),
(54, 'triple chocolate mousse ', 3, '199', 'This image features a slice of triple chocolate mousse cake with three distinct layers. The bottom layer is a rich chocolate crust, followed by a dark chocolate mousse, and topped with a lighter milk chocolate mousse.', '2503130134030.jpg', 0),
(55, 'chocolate layer', 3, '149', 'This image showcases a decadent multi-layered chocolate cake with rich chocolate ganache between each layer. The cake has a smooth, glossy chocolate glaze on top, adding an extra touch of indulgence. A chocolate truffle sits atop the cake, enhancing its luxurious appearance.\r\nQty(1 piece)', '2503130136490.jpg', 0),
(56, 'truffle', 3, '249', 'This is a rich, multi-layered chocolate truffle cake with alternating layers of dark chocolate cake, chocolate ganache, and a light-colored creamy filling.\r\nQty(1 piece)', '2503130138590.jpg', 0),
(57, 'red velvet & sponge layers', 3, '179', 'This image features a delicious slice of red velvet cake with vibrant red sponge layers and creamy white frosting in between.\r\nQty(1 piece)', '2503130141230.jpg', 0),
(58, 'raspberry and Oreo', 3, '139', 'This image showcases a delectable no-bake raspberry and Oreo dessert. The dessert is layered with crushed chocolate cookies, fresh raspberries, and a creamy white filling, creating a visually appealing contrast.\r\nQty(1 piece)', '2503130143390.jpg', 0),
(59, 'moist slice', 3, '169', 'This image features a rich and moist slice of chocolate cake, topped with glossy chocolate ganache that cascades down the sides. The cake is garnished with fresh, sliced strawberries and a small sprig of mint, adding a pop of color and freshness.\r\nQty(1 piece)', '2503130145230.jpg', 0),
(60, 'red velvet & layered', 3, '249', 'This image features a beautifully layered slice of red velvet cake with a deep red sponge and creamy white frosting.\r\nQty(1 piece)', '2503130147180.jpg', 0),
(61, 'White cake slice', 3, '199', 'This image features a beautifully crafted white cake with a soft, fluffy texture and smooth, creamy frosting. The cake consists of two layers of light vanilla sponge separated by a delicate layer of frosting.\r\nQty(1 piece)', '2503130148130.jpg', 0),
(62, 'raspberry cheesecake', 3, '249', 'This image showcases a delicious raspberry cheesecake with a vibrant red glaze on top. The cheesecake features a thick and creamy raspberry-infused layer over a crunchy golden-brown biscuit crust.\r\nQty(1 piece)', '2503130149570.jpg', 0),
(63, 'raspberry mousse', 3, '99', 'This image features a decadent chocolate raspberry mousse cake with three distinct layers.\r\nQty(1 piece)', '2503130152140.jpg', 0),
(64, 'Frosted vanilla', 3, '139', 'This image showcases a delicate slice of vanilla cake with soft pink frosting. The cake consists of two layers of light, fluffy vanilla sponge separated by a thin layer of pastel pink buttercream.\r\nQty(1 piece)', '2503130153490.jpg', 0),
(65, 'coconut flavour', 3, '199', 'The image features a slice of a two-layered yellow cake with a smooth, creamy frosting. The cake has a slightly dense texture and a light golden-brown color.\r\nQty(1 piece)', '2503130159570.webp', 0),
(66, 'mocha chocolate icebox', 3, '299', 'The image showcases a mocha chocolate icebox cake with multiple thin layers of chocolate cookie or biscuit and a creamy coffee-flavored filling.\r\nQty(1 piece)', '2503130201110.jpg', 0),
(67, 'freshly baked', 6, '179', 'The image shows freshly baked, golden-brown bread rolls filled with finely chopped green herbs, possibly scallions or chives.\r\nQty(9 piece)', '2503141027120.jpg', 0),
(68, ' chocolate babka', 6, '149', 'The image showcases a beautifully baked chocolate babka, a sweet, braided bread with layers of chocolate filling. The loaf has a deep golden-brown crust with rich, dark chocolate swirls throughout.\r\nQty(1 piece)', '2503141030110.jpg', 0),
(69, 'golden-brown', 6, '99', 'The image displays four golden-brown, freshly baked braided bread rolls on a sheet of parchment paper. The bread has a beautifully woven pattern on top and is sprinkled with finely chopped herbs, possibly parsley or cilantro, adding a touch of green.\r\nQty(1 piece)', '2503141031460.jpg', 0),
(70, ' herb garlic', 6, '149', 'The image features a Qfreshly baked loaf of herb garlic bread, sliced into even pieces and arranged on a rustic wooden cutting board lined with parchment paper.\r\nQty(6 piece)', '2503141033360.jpg', 0),
(71, ' small, square-shaped', 6, '99', 'The image features four small, square-shaped bread rolls placed on a white plate. Two of the rolls have a golden-brown, glossy surface, and one of them is garnished with small green leaves.\r\nQty(4 piece)', '2503141034570.jpg', 0),
(72, 'pumpkin and cornmeal', 6, '199', 'The image features a freshly baked loaf of pumpkin and cornmeal quick bread placed on a rustic wooden surface. The bread has a golden-orange hue with visible pieces of nuts and herbs.\r\nQty(4 piece)', '2503141037330.jpg', 0),
(73, 'casserole', 6, '79', 'The image showcases a delicious-looking breakfast casserole served on a white plate. The slice is golden-brown with visible pieces of ham, cheese, and eggs, giving it a rich and hearty texture.\r\nQty(3 piece)', '2503141039460.jpg', 0),
(74, 'delicious sandwich', 6, '249', 'The image features a delicious sandwich served on a white plate. The sandwich is made with rustic, crusty bread that has a golden-brown exterior and is speckled with dried fruits and nuts. Inside, there are layers of fresh green lettuce, thinly sliced turkey, and possibly some cheese.\r\nQty(4 piece)', '2503141041390.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cake_shop_users_registrations`
--

CREATE TABLE `cake_shop_users_registrations` (
  `users_id` int(11) NOT NULL,
  `users_username` varchar(100) NOT NULL,
  `users_email` varchar(150) NOT NULL,
  `users_password` varchar(100) NOT NULL,
  `users_mobile` varchar(50) NOT NULL,
  `users_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cake_shop_users_registrations`
--

INSERT INTO `cake_shop_users_registrations` (`users_id`, `users_username`, `users_email`, `users_password`, `users_mobile`, `users_address`) VALUES
(1, 'kaxeel', 'k@gmail.com', '123', '1234568786', 'this is my addres');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('Cash','Card') NOT NULL,
  `delivery_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `user_id`, `total_amount`, `payment_method`, `delivery_date`, `created_at`) VALUES
('HEER-20250329MI72', 1, 449.00, 'Cash', '2025-03-31 10:17:00', '2025-03-29 04:47:05'),
('HEER-20250329TE51', 1, 419.00, 'Cash', '2025-03-31 10:22:00', '2025-03-29 04:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `item_id` int(11) NOT NULL,
  `invoice_id` varchar(50) DEFAULT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`item_id`, `invoice_id`, `product_name`, `product_price`, `quantity`, `total_price`) VALUES
(89, 'HEER-20250329MI72', 'Red velvet', 449.00, 1, 449.00),
(90, 'HEER-20250329TE51', 'Biscottie', 99.00, 1, 99.00),
(91, 'HEER-20250329TE51', 'Gingersnap', 90.00, 1, 90.00),
(92, 'HEER-20250329TE51', 'Choco chips', 80.00, 1, 80.00),
(93, 'HEER-20250329TE51', 'Fortune', 150.00, 1, 150.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cake_shop_admin_registrations`
--
ALTER TABLE `cake_shop_admin_registrations`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cake_shop_category`
--
ALTER TABLE `cake_shop_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cake_shop_orders`
--
ALTER TABLE `cake_shop_orders`
  ADD PRIMARY KEY (`orders_id`);

--
-- Indexes for table `cake_shop_orders_detail`
--
ALTER TABLE `cake_shop_orders_detail`
  ADD PRIMARY KEY (`orders_detail_id`);

--
-- Indexes for table `cake_shop_product`
--
ALTER TABLE `cake_shop_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `cake_shop_users_registrations`
--
ALTER TABLE `cake_shop_users_registrations`
  ADD PRIMARY KEY (`users_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`),
  ADD KEY `invoices_ibfk_1` (`user_id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`,`product_name`),
  ADD UNIQUE KEY `invoice_id_2` (`invoice_id`,`product_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cake_shop_admin_registrations`
--
ALTER TABLE `cake_shop_admin_registrations`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cake_shop_category`
--
ALTER TABLE `cake_shop_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cake_shop_orders`
--
ALTER TABLE `cake_shop_orders`
  MODIFY `orders_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cake_shop_orders_detail`
--
ALTER TABLE `cake_shop_orders_detail`
  MODIFY `orders_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cake_shop_product`
--
ALTER TABLE `cake_shop_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `cake_shop_users_registrations`
--
ALTER TABLE `cake_shop_users_registrations`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cake_shop_users_registrations` (`users_id`) ON DELETE CASCADE;

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `invoice_item_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`invoice_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
