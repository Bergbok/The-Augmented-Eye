/*===============================AT==================================== 
Filename: 2. Sample_Data_Inserts.sql
Author: Albertus Cilliers
Description: This file will insert sample data into the database.
=====================================================================*/

USE TheAugmentedEye;

INSERT INTO Users(userPassword, userName, userSurname, userGender, userBirthday, userEmail, userContactNo, userSubscribedToNewsletter, userRegistrationDate)
VALUES('awe','Kimberly','La Vallette','Female','2040-01-12','kimberly.lavallette@theaugmentedeye.com','0728941354',false,CURDATE()),
	  ('awe','Lana','Smithee','Female','2040-01-12','lana.smithee@theaugmentedeye.com','0826845812',false,CURDATE()),
      ('awe','Donovan','D. Dawson','Male','2020-01-12','donovan.d.dawson@theaugemnetedeye.com','0728884568',false,CURDATE()),
	  ('awe','Albertus','Cilliers','Male','2003-06-09','albertus.cilliers@gmail.com','0844023335',true,CURDATE()),
      ('admin','Admin','Istrator','Other','1969-06-09','admin','0101010101',false,CURDATE());
      
INSERT INTO Admins(userID)
VALUES(5);

-- The following articles were obtained from the VA-11 HALL-A wiki at: https://va11halla.fandom.com/wiki/The_Augmented_Eye

-- Day 1 Articles
SET @content = 
'With inflation rates among the highest in the world, constant shortages of basic groceries, and rampant violent crime, Glitch City''s citizens look for a better life in other countries.
<br><br>
QUINCY, however, isnt happy with this.
<br><br>
"They learn in our schools and universities" the prime minister said during a talk with The Augmented Eye "but they apply what they learn somewhere else and I find it rather insulting."
<br><br>
This comes after revealing new economic measures for the city, which most analysts consider to be useless for the current environment.
<br><br>
"They don''t know sh*t" concluded QUINCY. ';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('1','Mass emigration continues as QUINCY reveals new economic adjustments',@content,'1999-12-13 12:00:00');

SET @content = 
'If you thought Alice_Rabbit was good at cracking the most complicated security protocols in the world, then this new group will certainly blow your mind. They''ve yet to make an impact as big as Alice_Rabbit, but they seem to be aiming very high with the recent threats issued against Prime Minister QUINCY.
<br><br>
"We hold full access to QUINCY''s email network and we''ll release the whole database this January," the group declared during a stream.
<br><br>
<b>"Shallow threats."</b>
<br><br>
When questioned, Prime Minister QUINCY dismissed all of the group''s threats by stating he''s not "hiding anything" and is not afraid of a possible leak of his email history.
<br><br>
"Maybe everyone will get to see what kind of TV I bought last month." 
<br><br>
<b>Wild Parties</b>
<br><br>
The people behind the Wonderlanders seemed to enjoy dressing in all kinds of rabbit costumes during the stream. From anthro to bunny girl, the purpose was to show the love and respect they have for Alice_Rabbit and their role in today''s politics.
<br><br>
"We want to follow their example while having some fun!"
<br><br>
We''re not sure if this will go anywhere, but we''ll be there to tell you if it does.';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('1','"Wonderlanders" are the newest threat to your security',@content,'1999-12-13 12:15:00');

SET @content = 
'The popular show Cyborg in Heels returns to The Dome this march, with tickets going on sale in January.
<br><br>
Cyborg in Heels is a massive stage show about a cyborg fighting terrorism while wearing heels. Director Quinton Hayter explains Cyborg in Heels'' special appeal during a exclusive interview with The Augmented Eye.
<br><br>
"What''s not to love about it? It''s a cyborg, WEARING HEELS, CUTTING STUFF. That''s literally something we''ve never seen before, a niche market I''m willing to capitalize on."
<br><br>
Check out the full interview in the next few weeks, exclusively here at the Augmented Eye. ';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('2','Cyborg in Heels returns next year to the Super Silver Thunder Dome',@content,'1999-12-13 12:30:00');

-- Day 2 Articles
SET @content = 
'This morning, a suicide attempt was thwarted by an unidentified local woman. The incident occurred at the Artemis Will Mall, where people noticed someone was at the rooftop of the building. Fire fighters were called as soon as their presence was noticed by pedestrians, but the person jumped off without notice.
<br><br>
<b>A mysterious rescuer</b>
<br><br>
Just when the would-be suicide victim jumped off, a local woman was able to catch them mid-air, and fled the scene before anyone could identify her. The mall is taking extra security measures now.';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('2','Local woman, Local hero',@content,'1999-12-14 12:00:00');

# If Donovan gets drunk

SET @content = 
'This is not really a surprise, but a lot of people seem to hate this particular brand of instant food.
<br><br>
This is from a survey we conducted here at The Augmented Eye last month. We asked our readers to tell us their most hated dishes.
<br><br>
And with a total of six thousand votes, it looks like the market for shrimp ramen is reducing! That''s good. Because it SUCKS. It sucks so much, I barf a little everytime I smell it. How can anyone LIKE that? It''s ridiculous.
<br><br>
Ugh, I can''t even finish this article. I''m sorry, everyone but I have to puke.
<br><br>
Blergh. I hope it''s put out of sale. ';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('2','70% of our readers consider shrimp ramen to be "disgusting"',@content,'1999-12-14 12:15:00');

SET @content = 
'A dog, you say? Why not? After receiving brain enhancements, they''re capable of learning at near-human speeds, so why is it so impossible to imagine a gifted dog who uses their brilliance for programming?
<br><br>
It makes a lot of sense, right?
<br><br>
Well, maybe,
<br><br>
01010100 01001000 01000101 00100000
<br><br>
01010010 01000101 01010100 01010010
<br><br>
01001001 01000010 01010101 01010100
<br><br>
01001001 01001111 01001110 00100000
<br><br>
01001001 01010011 00100000 01000011
<br><br>
01001111';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('2','I think Alice_Rabbit might a a dog...',@content,'1999-12-14 12:30:00');

# If Donovan doesn't get drunk

SET @content = 
'Megachristmas can be harsh for people in Glitch City, especially given the current political and economic climate.
<br><br>
Parents can neither afford gifts nor traditional dishes due to high prices and shortages. It certainly looks like it will be a grim month for everyone living with just the minimum wage, which is about half of the population.
<br><br>
Now, citizens from all districts seem to be looking for a definitive answer to their problems, and they''re taking their frustrations out to the streets.
<br><br>
“I want my holidays back. It’s not fair that we have to give up on our customs because you idiots suck at economy," said a protester during today’s manifestation.';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('1','Riots intensify as we approach Megachristmas',@content,'1999-12-14 12:45:00');

SET @content = 
'Even though recent medical advances concerning the Tokyo Flu have been successfully implemented across the globe, Glitch City is currently facing a financial crisis that makes this treatment near impossible to find locally.
<br><br>
In the few places that continue to receive a supply of subsidized medicine, lines can often extend several blocks. Drugstores use biometric systems to prevent scalpers from getting medicines at low prices, and then reselling them afterwards for a huge profit.
<br><br>
“This is unacceptable,” A mother of two told AE while standing in line at a downtown pharmacy. “The only possible disease that can affect me can’t be treated due to morons in high places. I want my quality of life back!”';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('1','Tokyo Flu Treatment nowhere to be found',@content,'1999-12-14 13:00:00');

-- Day 3 Articles

SET @content = 
'A powerful 8.6 magnitude tremor has struck the area of Neo-San Francisco. Fortunately, modern science was able to identify the quake almost an hour in advance, providing the city plenty of time to prepare for the worst.
<br><br>
During a conference call, Glitch City’s Prime Minister QUINCY congratulated the rescue teams at Neo SF for its rapid response in the wake of the warning. “They’re an example to follow, and we’re certainly looking forward to implement these advancements in earthquake prediction here in our beautiful city.”
<br><br>
Glitch City is not currently known to be a seismic zone.';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('1','Neo-San Francisco rocked by a powerful earthquake, millions saved',@content,'1999-12-15 12:00:00');

# If Donovan gets drunk

SET @content = 
'Don’t let anyone tell you otherwise! She’s the BEST. Like, she had to be hand-crafted to be this perfect. Holy moly.
<br><br>
She’s the top tier EVERYTHING and I’m baffled as to how there are still people out there hoping to be as awesome and hot and great. They can''t. It’s impossible for a human to top such an achievement.
<br><br>
I, for one, welcome our new roboko overlord.';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('3','KIRA mIKI CONFIRMED AS THE BEST POP STAR IN HISTORY!!',@content,'1999-12-15 12:15:00');

SET @content = 
'The Augmented Eye: In today’s interview segment, we sit with Tino Award nominee GLO-RI-A Light! It’s an honor to be here with you.
<br><br>
GLO-RI-A: I-It’s My pleasure...
<br><br>
AE: Tell us everything. What was your experience working with...
<br><br>
<b class="error-message">Content blocked in your region</b>';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('3','Interview: GLO-RI-A Light and her quest for a Tino Award.',@content,'1999-12-15 12:30:00');

# If Donovan doesn't get drunk

SET @content = 
'After the numerous protests held around the city, which are caused by an ongoing economic and safety crisis, Glitch City’s Prime Minister QUINCY has made it clear that if the rioters take another civilian life, he’ll personally write a law to ban all kinds of public manifestations.
<br><br>
“This simply can’t go on,” QUINCY told AE during a call. “They only want to destroy public property. They’re actively sabotaging our efforts to recover our beautiful city, and I’ve decided that if they cause another civillian casualty, I’ll do everything in my power to ban protests. The White Knights will have full authorization to use maximum force.”
<br><br>
QUINCY will be running for a second term next year.';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('1','Quincy: One more civil death and we''ll ban protests',@content,'1999-12-15 12:45:00');

SET @content = 
'Who is Alice_Rabbit? Judging by the complexity of the methods they''ve used to breach all kinds of protected software, some are starting to think this is in fact a group and not a single individual.
<br><br>
So, is Alice_Rabbit a group after all?
<br><br>
Not the first time this would be a thing.
<br><br>
More than half a century ago, a group of notorious hackers rose to prominence, and they called themselves Anon
<br><br>
<p id="hacked-text"> HahAHhah thEy wErEnt EvEn a ThrEaT to rEaL protEctEd daTa $#%#////// dEcEmbEr 17 //////////#$%#$ </p>
<script type="text/javascript" src="/The Augmented Eye/JavaScript/hackerText.js"></script>
<script>Init("hacked-text", 1, 1)</script>';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('1','Is Alice Rabbit a group? The answer here',@content,'1999-12-15 13:00:00');

-- Day 4 Articles

# If Donovan gets drunk the two previous days

SET @content = 
'I’m tired of you! ALL OF YOU! Readers, writers and columnists, or whatever you are! I’m tired of trying to elevate the standard of this stupid, shitty tabloid! I''m tired of getting nonexistent hits whenever we attempt something deep!
<br><br>
I really wanted to report on the riots, you know? Just like the old times but NOOOO. All YOU want to read is crap about stupid hackers, talking dogs, and “retro memes” or whatever the FUCK.
<br><br>
Just fuck my shit up. I quit.';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('3','FUUUUUUCK THE WOOOORLD',@content,'1999-12-16 12:00:00');

# If Donovan doesn't get drunk the two previous days

SET @content = 
'Crime is up 5% this month, officially making the road to Megachristmas a dangerous one.
<br><br>
White Knights, aware of the situation, have promised to maintain security in all sectors, even though recent budget cuts have been decreasing the morale of their personnel.
<b> An Uphill Battle </b>
<br><br>
Poverty and the lack of opportunities are no longer the main causes of crime.
<br><br>
Criminals come from all walks of life. They will murder and distribute drugs for no other reason than the fact it gives them power. It’s no longer about feeding their families. It''s about domination. There are entire sectors controlled by these dangerous gangs and there’s no solution in sight. This Megachristmas will be a very dark one. ';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('3','Crime rate up 5% this month',@content,'1999-12-16 12:00:00');

-- Day 8 Articles

SET @content = 
'For the longest time, the term “Christmas Cake” referred to women aged 26 or above, who are regarded as undesirable -- just like a Christmas cake that ceases being useful after December 25th.
<br><br>
But men around Glitch City apparently have developed a sweet tooth.
<br><br>
“Who doesn’t like a mature woman?” Todd, 19, told The Augmented Eye. “They have all the necessary experience already and plus, I’m soooo tired of spoiled, immature girls doing stupid sh*t. I say bring on the hot office ladies!”
<br><br>
Jill, 27, is confused. “Christmas what? Is that like the opposite of Beefcake?” After discovering the real meaning, she launched into an hour-long rant. "I''ll let you know pencil skirts are the best!"
<br><br>
Alma Armas, 29, is pleased. “About damn time. I’m tired of those highschool fuckers stealing the cute boys,” After a 30-minute rant, she concluded, “THEY TOOK OUR BOOYYYS!” ';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('2','Men prefer “Christmas Cakes”, study reveals',@content,'1999-12-20 12:00:00');

-- Day 11 Articles

SET @content = 
'Glitch City is one of the few places on Earth that''s strictly self-sufficient, with an important rate of only 0.8%. However, that might change due to the recent shortages across the city.
<br><br>
Prime Minister QUINCY revealed this morning that the government plans to have a mored relaxed policy for importers. "We don''t lift the currency control, but we can provide them foreign currency at a low fixed rate. That way, we can secure essential items at affordable prices." QUINCY told AE.
<br><br>
Some experts say that private companies are no longer working at full capacity, which is unsurprising news given that the QUINCY government has seized most of them, resulting in the shortage crisis in the first place. ';
INSERT INTO Articles(articleAuthorID, articleTitle, articleContent, articlePublishDate)
VALUES('2','QUINCY studies the possibility of allowing imports',@content,'1999-12-23 12:00:00');


