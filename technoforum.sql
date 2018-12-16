-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost
-- Généré le :  Dim 14 Mai 2017 à 00:31
-- Version du serveur :  5.7.15-log
-- Version de PHP :  5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `technoforum`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `c_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `p_id` int(10) UNSIGNED NOT NULL,
  `c_date` datetime NOT NULL,
  `c_content` text NOT NULL,
  `c_stat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`c_id`, `u_id`, `p_id`, `c_date`, `c_content`, `c_stat`) VALUES
(2, 1, 7, '2017-01-22 23:01:18', '1. Copy the lines of code to the clipboard.<br/>2. Enter a blank line in the Message window.<br/>3. Paste the code into the Input pane of the Message window.<br/>4. Place the insertion point at the end of the last line of code.<br/>5. Press Control+Enter (Windows) or Control+Return (Mac). Director finds the first blank line above the insertion point and executes each line of code after the blank line in succession.', ''),
(3, 1, 6, '2017-01-22 23:01:43', 'merci de votre information :)', ''),
(4, 1, 5, '2017-01-22 23:01:06', 'hiii les membres ??????????', ''),
(5, 1, 3, '2017-01-22 23:01:51', 'hhhhhhh ohh c\'est un grand probleme', ''),
(6, 1, 3, '2017-01-22 23:01:14', 'The Object inspector can be very useful for understanding the structure of complex objects. For example, 3D cast members have many layers of properties. Because the Object inspector shows you a visual representation of the nested structure of those properties, it makes it much easier to become familiar with them and their relationships to each other. Understanding the property structure of objects in Director is important when writing scripts', ''),
(7, 1, 10, '2017-01-22 23:01:03', 'merci', ''),
(8, 1, 10, '2017-01-22 23:01:11', 'The ability to watch the values of properties change while a movie plays is helpful for understanding what is happening in the movie. It is especially helpful when testing and debugging scripts because you can watch as the values change based on scripts you&rsquo;ve written. The Director Debugger window displays this information also, but it is only available when you are in debugging mode. For more information on debugging, see &ldquo;Advanced debugging&rdquo; on page', ''),
(9, 1, 3, '2017-01-22 23:01:34', 'Enter an object manually in the Object inspector 1 Double-click in the first empty cell in the Object column of the Object inspector. 2 Type the name of the object into the cell. Use the same name you would use to refer to the object in your scripts. 3 Press Enter (Windows) or Return (Mac). If the object has subproperties, a plus sign (+) appears to the left of it. 4 Click the plus sign. The properties of the object appear below it. Properties with subproperties appear with a plus sign to their left. Click each plus sign to display the subproperties.', ''),
(10, 1, 3, '2017-01-22 23:01:42', 'Turn on Autopoll 1 Right-click (Windows) or Control-click (Mac) in the Object inspector. The Object inspector context menu appears. 2 Select Autopoll from the context menu. When Autopoll is on, a check mark appears next to the Autopoll item in the context menu', ''),
(11, 1, 3, '2017-01-22 23:01:51', 'Clear the entire contents of the Object inspector ❖ Right-click (Windows) or Control-click (Mac) inside the Object inspector and select Clear All from the context menu. When you open a separate movie from the one you are working on, the objects you entered in the Object inspector remain. This makes it easy to compare different versions of the same movie. When you exit Director, the items in the Object inspector are lost.', ''),
(12, 1, 3, '2017-01-22 23:01:57', 'The Debugger window is a special mode of the Script window. It provides several tools for finding the causes of problems in your scripts. By using the Debugger window, you can quickly locate the parts of your code that are causing problems. The Debugger window allows you to run scripts', ''),
(13, 1, 3, '2017-01-22 23:01:05', 'Add a breakpoint that will open the Debugger window 1 In the Script window, open the script that should contain the breakpoint. 2 Click in the left margin of the Script window next to the line of code where you want the breakpoint to appear, or place the insertion point on the line of code and click Toggle Breakpoint. Your code will stop executing at the beginning of this line, and the Script window will enter debugging mode. If the Script windo', ''),
(14, 2, 6, '2017-01-22 23:01:43', 'non c pas ca', ''),
(15, 1, 17, '2017-01-22 23:01:11', 'hiiii how are you bro ??', ''),
(16, 3, 17, '2017-01-22 23:01:36', '@ilyassking, fine and you ??', ''),
(17, 2, 17, '2017-01-22 23:01:09', 'hii les amies , j\'ais des nouvelle ....', ''),
(18, 1, 17, '2017-01-28 16:01:50', 'jhlkh', '');

-- --------------------------------------------------------

--
-- Structure de la table `forum`
--

CREATE TABLE `forum` (
  `f_id` int(10) UNSIGNED NOT NULL,
  `f_nom` text NOT NULL,
  `f_desc` text NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `forum`
--

INSERT INTO `forum` (`f_id`, `f_nom`, `f_desc`, `u_id`) VALUES
(4, 'SEO et reffercement', 'les techniques de SEO et les problemes ...', 1),
(5, 'les language de programmation moderne', 'php, c#, js, nodejs,angular js, ...', 1),
(6, 'les materiels informatiques', 'hp, dell, lenovo, ...', 1),
(7, 'le forum des problem resau', 'les question et les problemmes resau ...', 2),
(8, 'forum de descution ouvert pour touts les sujets', 'hello world !', 3);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

CREATE TABLE `post` (
  `p_id` int(10) UNSIGNED NOT NULL,
  `p_title` text NOT NULL,
  `p_content` text NOT NULL,
  `f_id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `p_date` datetime NOT NULL,
  `p_stat` int(30) NOT NULL,
  `p_vus` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `post`
--

INSERT INTO `post` (`p_id`, `p_title`, `p_content`, `f_id`, `u_id`, `p_date`, `p_stat`, `p_vus`) VALUES
(1, 'les regles de forum', 'If this guide is distributed with software that includes an end user agreement, this guide, as well as the software described in it, is furnished under license and may be used or copied only in accordance with the terms of such license. Except as permitted by any such license, no part of this guide may be reproduced, stored in a retrieval system, or transmitted, in any form or by any means, electronic, mechanical, recording, or otherwise, without the prior written permission of Adobe Systems Incorporated. Please note that the content in this guide is protected under copyright law even if it is not distributed with software that includes an end user license agreement. <br/><br/>-  regle 1<br/>-  regle 2<br/>-  regle 3<br/>-  regle 4<br/>-  regle 5', 6, 3, '2017-01-22 23:01:29', 2, 2),
(2, 'j\'ai un problem avec mon pc hp', 'The content of this guide is furnished for informational use only, is subject to change without notice, and should not be construed as a commitment by Adobe Systems Incorporated. Adobe Systems Incorporated assumes no responsibility or liability for any errors or inaccuracies that may appear in the informational content contained in this guide. Please remember that existing artwork or images that you may want to include in your project may be protected under copyright law. The unauthorized incorporation of such material into your new work could be a violation of the rights of the copyright owner. Please be sure to obtain any permission required from the copyright owner. Any references to company names in sample templates are for demonstration purposes only and are not intended to refer to any actual organization. This work is licensed under the Creative Commons Attribution Non-Commercial 3.0 License. To view a copy of this license, visit http://creativecommons.org/licenses/by-nc-sa/3.0/us/', 6, 3, '2017-01-22 23:01:14', 4, 4),
(3, 'j\'ai un grand problem', 'This section provides an alphabetical list of all the constants available in Director&reg;. The majority of these constants apply only to Lingo. JavaScript syntax does contain some constants that are similar to the Lingo constants listed here;\' therefore, where appropriate, JavaScript syntax usage and examples are provided to help you map the functionality of Lingo constants with their closest counterparts in JavaScript syntax. For more information about JavaScript syntax constants, see one of the many third-party resources on the subject.', 6, 3, '2017-01-22 23:01:50', 4, 23),
(4, 'when used before and after a string', 'If this guide is distributed with software that includes an end user agreement, this guide, as well as the software described in it, is furnished under license and may be used or copied only in accordance with the terms of such license. Except as permitted by any such license, no part of this guide may be reproduced, stored in a retrieval system, or transmitted, in any form or by any means, electronic, mechanical, recording, or otherwise, without the prior written permission of Adobe Systems Incorporated. Please note that the content in this guide is protected under copyright law even if it is not distributed with software that includes an end user license agreement. The content of this guide is furnished for informational use only, is subject to change without notice, and should not be construed as a commitment by Adobe Systems Incorporated. Adobe Systems Incorporated assumes no responsibility or liability for any errors or inaccuracies that may appear in the informational content contained in this guide. Please remember that existing artwork or images that you may want to include in your project may be protected under copyright law. The unauthorized incorporation of such material into your new work could be a violation of the rights of the copyright owner. Please be sure to obtain any permission required from the copyright owner.<br/><br/>Any references to company names in sample templates are for demonstration purposes only and are not intended to refer to any actual organization. This work is licensed under the Creative Commons Attribution Non-Commercial 3.0 License. To view a copy of this license, visit http://creativecommons.org/licenses/by-nc-sa/3.0/us/ Adobe, the Adobe logo, Director, Flash, and Shockwave, are either registered trademarks or trademarks of Adobe Systems Incorporated in the United States and/or other countries. Microsoft and Windows are registered trademarks or trademarks of Microsoft Corporation in the United States and/or other countries. All other trademarks are the property of their respective owners. Bitstream is a trademark or a registered trademark of Bitstream Inc. This product contains either BSAFE and/or TIPEM software by RSA Security, Inc. This product includes software developed by the Apache Software Foundation (http://www.apache.org). Adobe Flash 9 video compression and decompression is powered by On2 TrueMotion video technology.  &copy; 1992-2005 On2 Technologies, Inc. All Rights Reserved. <br/><br/>http://www.on2.com. Portions of this product contain code that is licensed from Gilles Vollant. Portions of this product contain code that is licensed from Nellymoser, Inc.  (www.nellymoser.com)', 7, 3, '2017-01-22 23:01:32', 2, 3),
(5, 'probleme avec Lingo', 'Capitalization is correct (ff the script is written in JavaScript syntax). JavaScript syntax is case-sensitive, which means that all methods, functions, properties, and variables must be referred to by using the correct capitalization. If you attempt to call a method or function by using incorrect capitalization, you will receive a script error. If you attempt to access a variable or property by using incorrect capitalization, you may not receive a script error, but your script may not behave as expected. For example, the following mouseUp handler contains a statement that attempts to access the itemLabel property by using incorrect capitalization. This script does not produce a script error, but instead dynamically creates a new variable with the incorrect capitalization. The value of the newly created variable is undefined.<br/> <br/>// JavaScript syntax  <br/> function beginSprite() {   this.itemLabel = &quot;Blue prints&quot;;  <br/> }  <br/>   <br/> function mouseUp() {   trace(this.itemlabel) // creates the itemlabel property  <br/> }', 5, 3, '2017-01-22 23:01:13', 4, 4),
(6, 'le SEO ??', 'Resize the Output pane<br/><br/>❖ Drag the horizontal divider to a new position.<br/>Hide the Output pane completely<br/><br/>❖ Click the Collapse/Expand button in the center of the horizontal divider. When the Output pane is hidden, output from scripts that execute is displayed in the Input pane.', 4, 3, '2017-01-22 23:01:58', 4, 8),
(7, 'Hide the Output pane completely', 'Display the Output pane if it is hidden<br/><br/>❖ Click the Collapse/Expand button again.<br/>Clear the contents of the Message window<br/><br/>❖ Click the Clear button. If the Output pane is visible, its contents are deleted. If the Output pane is not visible, the contents of the Input pane are deleted.<br/>Delete a portion of the contents of the Output pane<br/><br/>1. Select the text to be deleted.<br/>2. Press the Backspace or Delete key.', 7, 3, '2017-01-22 23:01:50', 4, 12),
(8, 'y-a-t il des solution ??', 'The pop-up menus include the following:<br/><br/>&bull; Alphabetical Lingo includes all commands except 3D Lingo, presented in an alphabetical list.<br/>&bull; Categorized Lingo includes all commands except 3D Lingo, presented in a categorized list.<br/>&bull; Alphabetical 3D Lingo includes all 3D Lingo, presented in an alphabetical list.<br/>&bull; Categorized 3D Lingo includes all 3D Lingo, presented in a categorized list.<br/>&bull; Scripting Xtras includes the methods and properties of all scripting Xtra extensions found, regardless of whether they are Adobe&reg; or third-party Xtra extensions. Note: The scripting Xtra extensions listed in the Scripting Xtras pop-up menu are only those that support the Interface() method and whose names actually appear in the pop-up menu. Although some cast member media types such as 3D and DVD also support the Interface() method, they do not appear in the Scripting Xtras pop-up menu because they are not implemented in Director as scripting Xtra extensions.', 7, 1, '2017-01-22 23:01:40', 0, 0),
(9, 'C# vs Java ??', 'indicate that these Lingo statements have run. Suppose you were trying to determine why the playhead did not go to the frame labeled &quot;Game Start.&quot; If the line --&gt; _movie.go(&quot;Game Start&quot;) never appeared in the Message window, maybe the condition in the previous statement was not what you expected. The Message window Output pane can fill with large amounts of text when the Trace button is on. To delete the contents of the Output pane, click the Clear button. If the Output pane is not visible, the contents of the Input pane are deleted. You can keep track of the value of variables and other objects by selecting the name of the object in the Message window and clicking the Inspect Object button. The object is added to the Object inspector, where its value is displayed and updated as the movie plays. For more information on the Object inspector, see &ldquo;Debugging in the Object inspector&rdquo; on page 84. When you are in debugging mode, you can follow how a variable changes by selecting it in the Message window and then clicking the Watch Expression button. Director then adds the variable to the Watcher pane in the Debugger window, where its value is displayed and updated as you work in the Debugger window. For more information on the Watcher pane, see &ldquo;Debugging in the Debugger window&rdquo; on page 87', 5, 1, '2017-01-22 23:01:23', 4, 2),
(10, 'comment tracer un tableau ??', '+---------------------------------------------------------------------------+<br/>| # | nom | prenom | email                            | sex        | ville      |<br/>+---------------------------------------------------------------------------+<br/>| 1 | ariba | ilyas     | ilyas.ariba@gmail.com | homme | rissani |', 6, 1, '2017-01-22 23:01:41', 4, 8),
(11, 'quelles sont les techniques de SEO ?', 'When Director runs and encounters a breakpoint, the script stops executing and the Script window changes to debugging mode. The movie is still playing, but the execution of your scripts is stopped until you use the Debugger window to tell Director how to proceed. If you have multiple Script windows open, Director searches for one containing the script where the breakpoint occurred and changes that window to debugging mode. ????', 4, 2, '2017-01-22 23:01:11', 0, 1),
(12, 'java ou php ??', '❖ Click the name of the handler in the Call Stack pane. The variables appear in the Variable pane. The Variable pane includes four tabs for viewing variables:<br/><br/>The All tab displays both global and local variables associated with the current handler. The Local tab displays only the local variables associated with the selected handler.<br/><br/>The Property tab displays the properties declared by the current script. The Global tab displays only the global variables associated with the selected handler.', 5, 2, '2017-01-22 23:01:29', 0, 0),
(13, 'what is lingo ??', 'Copyright &copy; 2009 Adobe Systems Incorporated. All rights reserved. Adobe&reg; Director&reg; 11.5 Scripting Dictionary If this guide is distributed with software that includes an end user agreement, this guide, as well as the software described in it, is furnished under license and may be used or copied only in accordance with the terms of such license. Except as permitted by any such license, no part of this guide may be reproduced, stored in a retrieval system, or transmitted, in any form or by any means, electronic, mechanical, recording, or otherwise, without the prior written permission of Adobe Systems Incorporated. Please note that the content in this guide is protected under copyright law even if it is not distributed with software that includes an end user license agreement. The content of this guide is furnished for informational use only, is subject to change without notice, and should not be construed as a commitment by Adobe Systems Incorporated. Adobe Systems Incorporated assumes no responsibility or liability for any errors or inaccuracies that may appear in the informational content contained in this guide.', 5, 2, '2017-01-22 23:01:24', 0, 0),
(14, 'hp ou dell ??', 'Microsoft and Windows are registered trademarks or trademarks of Microsoft Corporation in the United States and/or other countries.<br/><br/>All other trademarks are the property of their respective owners. Bitstream is a trademark or a registered trademark of Bitstream Inc.', 6, 2, '2017-01-22 23:01:02', 0, 0),
(15, 'Debug using the Message window', '❖ Set the Player object&rsquo;s debugPlaybackEnabled property to TRUE. When this property is TRUE, playing back a projector or a movie that contains Shockwave content opens a Message window (Windows) or a Message text file (Mac), and the results of any put() or trace() function calls are output to these formats.<br/><br/>If at any time during the movie the debugPlaybackEnabled property is set to FALSE, the Message window or text file is closed and cannot be opened again during that playback session, even if debugPlaybackEnabled is set back to TRUE later in that session.', 7, 2, '2017-01-22 23:01:37', 4, 1),
(16, 'SEO ou les ads facebook ?', 'If a sprite does the wrong thing, try checking the sprite&rsquo;s property values. Are they set to the values you want when you want?', 4, 3, '2017-01-22 23:01:28', 4, 0),
(17, 'hello world!', 'If the problem is not easy to identify, try the following approaches:<br/><br/>&bull; Determine which section has the problem. For example, if clicking a button produces the wrong result, investigate the script assigned to the button. If a sprite does the wrong thing, try checking the sprite&rsquo;s property values. Are they set to the values you want when you want?<br/><br/>&bull; Figure out where the script flows. When a section of the movie does not do what you want, first try to trace the movie&rsquo;s sequence of events in your head. Look at other scripts in the message hierarchy to make sure Director is running the correct handler.', 8, 3, '2017-01-22 23:01:41', 4, 18);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `u_id` int(10) UNSIGNED NOT NULL,
  `u_nom` varchar(30) NOT NULL,
  `u_prenom` varchar(30) NOT NULL,
  `u_pseudo` varchar(30) NOT NULL,
  `u_email` varchar(30) NOT NULL,
  `u_sex` varchar(30) NOT NULL,
  `u_password` varchar(40) NOT NULL,
  `u_birthday` varchar(30) NOT NULL,
  `u_avatar` varchar(40) NOT NULL DEFAULT 'default.png',
  `u_level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`u_id`, `u_nom`, `u_prenom`, `u_pseudo`, `u_email`, `u_sex`, `u_password`, `u_birthday`, `u_avatar`, `u_level`) VALUES
(1, 'ARIBA', 'Ilyas', 'ilyassking', 'ilyas.ariba@gmail.com', 'homme', '123', '23/1/1997', '1.jpg', 0),
(2, '', '', '', 'HAMDANI.anas@gmail.com', 'famme', '123', '23/9/1997', 'default.png', 0),
(3, 'Admin', 'Admin', 'supperAdmin', 'Admin@gmail.com', 'homme', '123', '23/7/1997', 'default.png', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`c_id`);

--
-- Index pour la table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`f_id`);

--
-- Index pour la table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`p_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `c_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `forum`
--
ALTER TABLE `forum`
  MODIFY `f_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `post`
--
ALTER TABLE `post`
  MODIFY `p_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
