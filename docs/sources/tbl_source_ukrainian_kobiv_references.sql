-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 15, 2014 at 09:31 AM
-- Server version: 5.5.33
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openup`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_source_ukrainian_kobiv_references`
--

CREATE TABLE IF NOT EXISTS `tbl_source_ukrainian_kobiv_references` (
  `short` varchar(6) DEFAULT NULL,
  `reference` varchar(338) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_source_ukrainian_kobiv_references`
--

INSERT INTO `tbl_source_ukrainian_kobiv_references` (`short`, `reference`) VALUES
('Ав', 'Августиновичъ, О.М. (1853) О дикорастущихъ врачебных растенiях Полтавск. губернiи: [1]-9.'),
('Ан', 'Анненковъ, Н. (1878) Ботан. Словарь: [1]-648.'),
('Ар', 'Аркушин, Г. (1996) Силенська гуторка: [1]-167.'),
('Ат', 'Атлас української мови (1984-1988). Vol. 1-3.'),
('Бк', 'Матеріали до словника буковин. говірок (1971-1979). Is. І-VI.'),
('Бр', 'Бродович, Т.М., Бродович, М.М. (1979) Деревья и кустарники запада: [1]-251.'),
('Ва', 'Ващенко, В.С. (1964) Словник полтавських говорів: [1]-107 с.'),
('Вз', 'Определитель высш. раст. Украины (1987) Eds. Доброчаева, Д.Н., Котов, М.И., Прокудин, Ю.Н. et al.: 548.'),
('Вл\n', 'Волковъ, Ф.К. (1873) Списокъ растенiй съ народн. названiями и этнографич. примҍч. Запис. Юго-Зап. Отдел. Рос. Геогр. Общ. за 1873 г.: [1]-14.'),
('Во\n', 'Волян, В. (1854) Началноє основанiє рослинословiя про нижшiи гимназiя и нижшiи реальнiи школы въ ц. к. Австрiйск. держ.: [1]-27.'),
('Вс', 'З матеріялів Бюра Народн. Термінолог. ІУНМ (1930) Вісн. Інст. Укр. Наук. Мови. Is. ІІ: 47-54.'),
('Вх\n', 'Верхратский, И. (1864-1872) Початки до уложення номенклят. и терминолог. природопис., народноі. Is. І-V.'),
('Вх1', 'Верхратский, I. (1901) Знадоби до пiзнання угорско-руских говорiв. Запис. НТШ. Vol. XLX: [1]-280.'),
('Вх2', 'Верхратский, I. Про говiр галицк. лемкiв (1902) Збiрн. фiльол. секциi НТШ: [1]-490.'),
('Вх3', 'Гикля, Е. (1873) Ботаника для шкілъ низш. гимназіяльн. и реальн.: [1]-208.'),
('Вх4', 'Верхратскій, И (1892) Списъ важнҍйш. выразівъ руск. ботаніч. термінольоґ. и номенклят. зъ оглядомъ на шкільну науку въ высш. клясахъ гімназ.: [1]-48.'),
('Вх5', 'Верхратский, І. (1905) Ботанїка на низші кляси шкіл середн.: [1]-238.'),
('Вх6', 'Верхратский, І. (1896) Ботанїка на висші кляси шкіл середн.: [1]-150.'),
('Вх8', 'Верхратский, I. (1908) Новi знадоби номенклят. i термінолог. природопис., народн., збиранi мiж людом: [1]-83.'),
('Гб', 'Горбач, О. (1993) Зібрані статті. Діялектологія. Vol. V: [1]-665.'),
('Гб2', 'Горбач, О. (1997) Південнобуковин. гуцул. говірка і діалект. словник с. Бродина, повіту Радівці (Румунія). Мат-ли до укр. діялектол. Is. 4: [1]-113.'),
('Гв\n', 'Гавришкевичъ, И. (1852) Початокъ до уложення термінолог. ботанiч. руск. Перемишлянинъ: 133―147.'),
('Гд', 'Гордієнко, Г. (1933-1934) Назви рослин у Вишнім Cтуденім. Подкарпатська Русь. Is. Х-ХІ.'),
('Гз', 'Гродзинський, Д.М. (1933) Чотиримов. словник назв рослин: [1]-312.'),
('Го1\n', 'Горнiцкiй, К. (1886) Дополн. къ “Ботанич. словарю” Н. Анненкова 1850, 1878 г.:  [1]-55.'),
('Го2', 'Горнiцкiй, К. (1890) Списокъ русск. и немногихъ инородческ. названiй растенiй. Второе дополн. къ “Ботанич. словарю” Н. Анненкова. Тр. о-ва испыт. природы при Императ. Харьковск. ун-те. Vol. 24: 365-374.'),
('Гр', 'Грiнченко, Б.Д. (1907-1909) Словарь української мови. Vol. 1-4.'),
('Гт\n', 'Гримут, М.I. (1978) Лексика флори у надтисянських говiрках Виноградiвськ. р-ну Закарпат. обл. Diploma thesis (typescript): [1]-106 с.'),
('Гу', 'Гуцульщина. Лінгвіст. етюди (1991) Ed. Закревська, Я.: [1]-308 с.'),
('Дб', 'Дубняк, К. (1917) Короткий рос.-укр. словничок термінів природознавства та географії. 3 ed.: [1]-40.'),
('Дз', 'Дзендзелівський, Й.О. (1958) Словник специфіч.ї лексики говірок нижн. Подністров’я. Лексикограф. бюл. Is. VI: 36-54.'),
('Ду', 'Дубровський, В. (1918) Словник москов.-укр.: [1]-542.'),
('Жл', 'Желеховський. Е., Недільський, С. (1886) Малорус.-нїм. словарь. Vol. 1-2.'),
('Зл', 'Залесова, Е.Н., Петровская, О.В. (1898-1901) Полн. рус. иллюстрир. словарь. Травник и цветник: [1]-1152.'),
('Ів', 'Iваницький, С., Шумлянський, Ф. (1923) Рос.-укр. словник. Vol. 1-2.'),
('Км', 'Комендар, В.І. (1971) Лікарські рослини Карпат: [1]-248.'),
('Ко', 'Кобів Ю. (2994) Словник укр. наук. і народн. назв судин. рослин: [1]-800.'),
('Кр\n', 'Красновъ, А. (1891) Мат-лы для флоры Полтав. губернiи. Тр. О-ва испыт. природы при Императ. Харьковск. Ун-те. Vol. 24: 399-514.'),
('Кч', 'Корчинський, М.Й. (1994) Назви дикорос. флори в говірках Турківськ. р-ну Львівськ. обл. Наук. запис. молодих учених Ужгород. ун-ту. Vol. 4: 185-214.'),
('Лв\n', 'Новицкiй, М. (1861) Додаточокъ до галиц.-рус. номенкл. ботан. Львовянинъ: 94-103.'),
('Лс', 'Лисенко, П.С. (1974) Словник поліс. говорів: [1]-260.'),
('Лс1', 'Лисенко, П.С. (1958) Словник специфіч. лексики правобереж. Черкащини. Лексикограф. бюл. Is. 4: 5-21.'),
('Лч', 'Левченко, М. (1874) Опытъ рус.-укр. словаря: [1]-190.'),
('Мг', 'Миголинець, О.Ф. (1994) Ботаніч. лексика укр. говорів Закарпат. обл. Назви дикорост. трав’ян. Рослин. Наук. зап. молодих учених Ужгород. ун-ту. Vol. 4: 215-255.'),
('Мг2', 'Миголинець, О.Ф. (1995) Ботаніч. лексика укр. говорів Закарпат. обл. Назви дерев та кущів. Наук. зап. молодих учених Ужгород. ун-ту. Vol. 5-6: 262-279.'),
('Мл', 'Мельник, М. (1992) Укр. номенклят. висш. ростин. Збірн. Математ.-природ.-лікар. Секції НТШ: [1]-356.'),
('Мн', 'Монтрезоръ, В. (1881) Обозр. Красивҍйш. растенiй, входящ. въ составъ флоры губерн. Кiевск. Учебн. Округа: Кiевск., Подольск., Волынск., Черниговск. и Полтавск.: [1]-47.'),
('Мн2', 'Монтрезоръ, В. (1886) Обозр. растенiй, входящ. въ составъ флоры губерн. Кiевск. Учебн. Округа: Кiевск., Подольск., Волынск., Черниговск. и Полтавск.: [1]-508.'),
('Мо', 'Москаленко, А.А. (1958) Словник діалектизмів укр. говірок Одеськ. обл.: [1]-78.'),
('Мс', 'Москаленко, Л.А. Ботанич. лексика укр. степн. говоров Николаевск. обл. PhD thesis: [1]-465.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
