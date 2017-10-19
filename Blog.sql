-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 18 Octobre 2017 à 21:22
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `Blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `titre` varchar(45) NOT NULL,
  `date` varchar(45) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `id_user`, `titre`, `date`, `text`) VALUES
(9, 1, 'Why Bootstrap', '14 October 2017', '&lt;h2&gt;Bootstrap History&lt;/h2&gt;\r\n\r\n&lt;p&gt;Bootstrap was developed by Mark Otto and Jacob Thornton at Twitter, and released as an open source product in August 2011 on GitHub.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;In June 2014 Bootstrap was the No.1 project on GitHub!&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;hr /&gt;\r\n&lt;h2&gt;Why Use Bootstrap?&lt;/h2&gt;\r\n\r\n&lt;p&gt;Advantages of Bootstrap:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;&lt;strong&gt;Easy to use:&lt;/strong&gt; Anybody with just basic knowledge of HTML and CSS can start using Bootstrap&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Responsive features:&lt;/strong&gt; Bootstrap&amp;#39;s responsive CSS adjusts to phones, tablets, and desktops&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Mobile-first approach:&lt;/strong&gt; In Bootstrap 3, mobile-first styles are part of the core framework&lt;/li&gt;\r\n	&lt;li&gt;&lt;strong&gt;Browser compatibility:&lt;/strong&gt; Bootstrap is compatible with all modern browsers (Chrome, Firefox, Internet Explorer, Safari, and Opera)&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;hr /&gt;\r\n&lt;h2&gt;Where to Get Bootstrap?&lt;/h2&gt;\r\n\r\n&lt;p&gt;There are two ways to start using Bootstrap on your own web site.&lt;/p&gt;\r\n\r\n&lt;p&gt;You can:&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;Download Bootstrap from getbootstrap.com&lt;/li&gt;\r\n	&lt;li&gt;Include Bootstrap from a CDN&lt;/li&gt;\r\n&lt;/ul&gt;\r\n\r\n&lt;hr /&gt;\r\n&lt;h2&gt;Downloading Bootstrap&lt;/h2&gt;\r\n\r\n&lt;p&gt;If you want to download and host Bootstrap yourself, go to &lt;a href=&quot;file:///home/jordy/My%20Web%20Sites/w3schools/external.html?link=http://getbootstrap.com/getting-started/&quot; target=&quot;_blank&quot;&gt;getbootstrap.com&lt;/a&gt;, and follow the instructions there.&lt;/p&gt;\r\n\r\n&lt;hr /&gt;\r\n&lt;hr /&gt;\r\n&lt;h2&gt;Bootstrap CDN&lt;/h2&gt;\r\n\r\n&lt;p&gt;If you don&amp;#39;t want to download and host Bootstrap yourself, you can include it from a CDN (Content Delivery Network).&lt;/p&gt;\r\n\r\n&lt;p&gt;MaxCDN provides CDN support for Bootstrap&amp;#39;s CSS and JavaScript. You must also include jQuery:&lt;/p&gt;\r\n'),
(10, 1, 'What is HTML?', '15 October 2017', '&lt;p&gt;HTML is the standard markup language for creating Web pages.&lt;/p&gt;\r\n\r\n&lt;ul&gt;\r\n	&lt;li&gt;HTML stands for Hyper Text Markup Language&lt;/li&gt;\r\n	&lt;li&gt;HTML describes the structure of Web pages using markup&lt;/li&gt;\r\n	&lt;li&gt;HTML elements are the building blocks of HTML pages&lt;/li&gt;\r\n	&lt;li&gt;HTML elements are represented by tags&lt;/li&gt;\r\n	&lt;li&gt;HTML tags label pieces of content such as &amp;quot;heading&amp;quot;, &amp;quot;paragraph&amp;quot;, &amp;quot;table&amp;quot;, and so on&lt;/li&gt;\r\n	&lt;li&gt;Browsers do not display the HTML tags, but use them to render the content of the page&lt;/li&gt;\r\n&lt;/ul&gt;\r\n'),
(14, 1, 'array_slice', '18 October 2017', '&lt;div class=&quot;description refsect1&quot; id=&quot;refsect1-function.array-slice-description&quot;&gt;\r\n&lt;h3&gt;Description&lt;/h3&gt;\r\n\r\n&lt;div class=&quot;dc-description methodsynopsis&quot;&gt;array &lt;strong&gt;array_slice&lt;/strong&gt; ( array &lt;code&gt;$array&lt;/code&gt; , int &lt;code&gt;$offset&lt;/code&gt; [, int &lt;code&gt;$length&lt;/code&gt; = &lt;strong&gt;&lt;code&gt;NULL&lt;/code&gt;&lt;/strong&gt; [, bool &lt;code&gt;$preserve_keys&lt;/code&gt; = false ]] )&lt;/div&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;array_slice()&lt;/strong&gt; retourne une s&amp;eacute;rie d&amp;#39;&amp;eacute;l&amp;eacute;ments du tableau &lt;code&gt;array&lt;/code&gt; commen&amp;ccedil;ant &amp;agrave; l&amp;#39;offset &lt;code&gt;offset&lt;/code&gt; et repr&amp;eacute;sentant &lt;code&gt;length&lt;/code&gt; &amp;eacute;l&amp;eacute;ments.&lt;/p&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;div class=&quot;parameters refsect1&quot; id=&quot;refsect1-function.array-slice-parameters&quot;&gt;\r\n&lt;h3&gt;Liste de param&amp;egrave;tres&lt;/h3&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;code&gt;array&lt;/code&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Le tableau d&amp;#39;entr&amp;eacute;e.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;code&gt;offset&lt;/code&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Si &lt;code&gt;offset&lt;/code&gt; est non-n&amp;eacute;gatif, la s&amp;eacute;rie commencera &amp;agrave; cet offset dans le tableau &lt;code&gt;array&lt;/code&gt;. Si &lt;code&gt;offset&lt;/code&gt; est n&amp;eacute;gatif, cette s&amp;eacute;rie commencera &amp;agrave; l&amp;#39;offset &lt;code&gt;offset&lt;/code&gt;, mais en commen&amp;ccedil;ant &amp;agrave; la fin du tableau &lt;code&gt;array&lt;/code&gt;.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;code&gt;length&lt;/code&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Si &lt;code&gt;length&lt;/code&gt; est fourni et positif, alors la s&amp;eacute;rie retourn&amp;eacute;e aura autant d&amp;#39;&amp;eacute;l&amp;eacute;ments. Si le tableau est moins long que &lt;code&gt;length&lt;/code&gt;, alors seuls les &amp;eacute;l&amp;eacute;ments de tableaux disponibles seront pr&amp;eacute;sents. Si &lt;code&gt;length&lt;/code&gt; est fourni et n&amp;eacute;gatif, alors la s&amp;eacute;rie contiendra les &amp;eacute;l&amp;eacute;ments depuis l&amp;#39;offset &lt;code&gt;offset&lt;/code&gt; jusqu&amp;#39;&amp;agrave; &lt;code&gt;length&lt;/code&gt; &amp;eacute;l&amp;eacute;ments en partant de la fin. Si &lt;code&gt;length&lt;/code&gt; est omis, la s&amp;eacute;quence lira tous les &amp;eacute;l&amp;eacute;ments du tableau, depuis l&amp;#39;&lt;code&gt;offset&lt;/code&gt; pr&amp;eacute;cis&amp;eacute; jusqu&amp;#39;&amp;agrave; la fin du tableau.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;code&gt;preserve_keys&lt;/code&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Notez que, par d&amp;eacute;faut, la fonction &lt;strong&gt;array_slice()&lt;/strong&gt; va r&amp;eacute;ordonner et r&amp;eacute;initialiser les indices num&amp;eacute;riques du tableau. Vous pouvez modifier ce comportement en d&amp;eacute;finissant le param&amp;egrave;tre &lt;code&gt;preserve_keys&lt;/code&gt; &amp;agrave; &lt;strong&gt;&lt;code&gt;TRUE&lt;/code&gt;&lt;/strong&gt;.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;/div&gt;\r\n\r\n&lt;div class=&quot;refsect1 returnvalues&quot; id=&quot;refsect1-function.array-slice-returnvalues&quot;&gt;\r\n&lt;h3&gt;Valeurs de retour&lt;/h3&gt;\r\n\r\n&lt;p&gt;Retourne la portion du tableau.&lt;/p&gt;\r\n&lt;/div&gt;\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  `text` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `id_user`, `id_article`, `date`, `text`) VALUES
(1, 1, 10, '15-10-17', 'Moi, je suis seulement PHP, hein, le frontend, je m\'en balek'),
(2, 1, 10, '17-10-17', 'Mdr, Jordy tu es un faux type !');

-- --------------------------------------------------------

--
-- Structure de la table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  `text` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id_article` int(11) NOT NULL,
  `tag` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id_article`, `tag`) VALUES
(9, 'css'),
(9, 'html'),
(9, 'javascript'),
(10, 'html5'),
(14, 'array'),
(14, 'php');

-- --------------------------------------------------------

--
-- Structure de la table `type_user`
--

CREATE TABLE `type_user` (
  `id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `type_user`
--

INSERT INTO `type_user` (`id`, `description`) VALUES
(1, 'Normal'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `pseudo` varchar(45) NOT NULL,
  `passe` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `sexe` varchar(1) NOT NULL,
  `pays` varchar(45) DEFAULT NULL,
  `date_inscription` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `id_type`, `pseudo`, `passe`, `age`, `sexe`, `pays`, `date_inscription`) VALUES
(1, 2, 'PowerC', 'liverpool1234', 19, 'H', 'Togo', '12-10-2017');

-- --------------------------------------------------------

--
-- Structure de la table `vote_article`
--

CREATE TABLE `vote_article` (
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_article_1_idx` (`id_user`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_2_idx` (`id_user`),
  ADD KEY `fk_comment_1_idx` (`id_article`);

--
-- Index pour la table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reply_1_idx` (`id_user`),
  ADD KEY `fk_reply_2_idx` (`id_comment`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_article`,`tag`);

--
-- Index pour la table `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_1_idx` (`id_type`);

--
-- Index pour la table `vote_article`
--
ALTER TABLE `vote_article`
  ADD PRIMARY KEY (`id_user`,`id_article`),
  ADD KEY `fk_vote_article_1_idx` (`id_article`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `type_user`
--
ALTER TABLE `type_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_comment_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comment_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `fk_reply_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reply_2` FOREIGN KEY (`id_comment`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `fk_tag_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_1` FOREIGN KEY (`id_type`) REFERENCES `type_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `vote_article`
--
ALTER TABLE `vote_article`
  ADD CONSTRAINT `fk_vote_article_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vote_article_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
