<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */
$context = Timber::get_context();
$context['advisors'] = array(
  array(
    "name" => "Joshua Benton",
    "image" => "benton-joshua.jpg",
    "description" => "Joshua Benton is director of the Nieman Journalism Lab at Harvard University, a project to help journalism adapt to the demands of the Internet age. Before coming to Harvard in 2007 as a Nieman Fellow, he spend seven years as an education reporter for The Dallas Morning News, during which he won five first-place awards in the National Awards for Education Reporting, in investigative reporting, beat reporting, and opinion writing. He also won the Philip Meyer Journalism Award from Investigative Reporters & Editors and the Fred M. Hechinger Grand Prize for Distinguished Education Reporting. He is a native of south Louisiana."
  ),
  array(
    "name" => "Celeste Ford",
    "image" => "ford-celeste.jpg",
    "description" => "Celeste Ford is the Manager of Media Relations for Carnegie Corporation of New York. She is a former TV news reporter of 25 years who worked her way up from smaller markets to the nation’s top local station–WABC-TV in New York City. She also reported for PBS and CNBC. During her 15 years at WABC-TV, Celeste started and ran the station’s first unit dedicated to education issues. Her reporting was honored with a number of the broadcast industry’s top awards including a DuPont-Columbia University Award and two Edward R. Murrow awards."
  ),
   array(
    "name" => "Louis Freedberg",
    "image" => "freedberg-louis.jpg",
    "description" => "Louis Freedberg is the executive director for EdSource, a nonprofit organization that provides data tools and research on education issues in California. Previously he was a senior reporter and an adviser to California Watch. As a co-founder, Louis was the first director of California Watch until May 2010. He previously was director of the California Media Collaborative, based at the Commonwealth Club of California. Until 2007, he worked at the San Francisco Chronicle in a variety of roles: columnist and member of its editorial board, Washington correspondent during the presidency of Bill Clinton, and higher education reporter."
  ),
  array(
    "name" => "Mitch Gelman",
    "image" => "gelman-mitch.jpg",
    "description" => "Mitch Gelman oversees the digital products at Gannett Co., including the development and design of browser, tablet and mobile phone services across the company’s media properties. Prior to coming to Gannett, Gelman was a vice president at Examiner.com and chief operating officer at THX, Ltd. From 2001 to 2008, he managed operations at CNN.com as senior vice president and executive producer, extending the CNN brand to multiple digital platforms, making CNN.com the number one news and information site online and garnering numerous awards, including a national Edward R. Murrow award and recognition by the Knight Foundation for excellence in news innovation. From 1998 to 2000, Gelman was executive editor of SI.com, the No. 3 sports site in the U.S."
  ),
  array(
    "name" => "LynNell Hancock",
    "image" => "hancock-lynnell.jpg",
    "description" => "LynNell Hancock is a reporter and writer specializing in education and child and family policy issues, who has taught journalism at Columbia University’s Graduate School of Journalism since 1993. She is the director of the Spencer Fellowship for Education Journalism. In addition to contributing to Newsweek, Columbia Journalism Review, The Nation and The New York Times, she served on staff of The Village Voice, the New York Daily News, and Newsweek where she covered national and local education issues."
  ),
  array(
    "name" => "Paul Hechinger",
    "image" => "hechinger-paul.jpg",
    "description" => "Paul Hechinger is a veteran of broadcast and online journalism. He has produced cross-medium journalism for Time, Court TV, NPR and The MacNeil/Lehrer NewsHour."
  ),
    array(
    "name" => "Michael B. Horn",
    "image" => "horn-michael.jpg",
    "description" => "Michael B. Horn is the co-founder and executive director of the education practice of Innosight Institute, a non-profit think tank devoted to applying the theories of disruptive innovation to solve problems in the social sector. Tech&Learning magazine named Horn to its list of the 100 most important people in the creation and advancement of the use of technology in education."
  ),
   array(
    "name" => "Luis Huerta",
    "image" => "huerta-luis.jpg",
    "description" => "Luis Huerta is an associate professor of education at Teachers College, Columbia University. His scholarly interests include education policy, decentralization in education, school choice (charter schools, vouchers, home schooling, tuition tax credits), privatization in education, and school finance."
  ),
  array(
    "name" => "Judith Johnson",
    "image" => "johnson-judith.jpg",
    "description" => "Judith Johnson is the former Superintendent of Schools for the Peekskill City School District, serving from 2001 to 2011. Johnson was the first woman and African-American to serve in that post. From 1997 to 2000, Judith served in the Clinton administration as Deputy Assistant Secretary for Elementary and Secondary Education and later as Acting Assistant Secretary for Elementary and Secondary Education. Ms. Johnson began her educational career in the New York City Public schools as a teacher, guidance counselor, and administrator for High School Redirection, one of the first alternative high schools established in New York City."
  ),
  array(
    "name" => "Liam Kerr",
    "image" => "kerr-liam.jpg",
    "description" => "Liam Kerr is the Massachusetts State Director for Democrats for Education Reform (DFER). Prior to DFER, Liam worked for the management consultancy The Parthenon Group and the national venture philanthropy fund New Profit Inc. Liam started his career as an AmeriCorps volunteer with California Library Literacy Services, where he helped expand a library-based adult literacy program. He has advised youth sports nonprofits throughout Massachusetts, an NGO consultancy in the Czech Republic, a charter school incubator, and a charter school network."
  ),
  array(
    "name" => "Harold Levy",
    "image" => "levy-harold.jpg",
    "description" => "Harold Levy is executive director of the Jack Kent Cooke Foundation, a private, independent foundation dedicated to advancing the education of exceptionally promising students who have financial need. Mr. Levy was formerly the New York City Schools Chancellor, where he created and published the first set of accountability metrics, started the Teaching Fellows program, instituted a math initiative that resulted in significant test score increases and led the system during the 9/11 attacks and their aftermath. He has also served as Executive Vice President of Kaplan, Inc., a subsidiary of the Washington Post Company, where he started Kaplan University’s online School of Education."
  ),
    array(
    "name" => "Vernon Loeb",
    "image" => "loeb-vernon.jpg",
    "description" => "Vernon Loeb is managing editor of the Houston Chronicle. Previously he was local editor for The Washington Post and before that, deputy managing editor/news at The Philadelphia Inquirer, where he was a reporter earlier in his career. Before returning to Philadelphia, he was Metro investigations editor at the Los Angeles Times and a defense reporter at The Washington Post."
  ),
   array(
    "name" => "Kay McClenney",
    "image" => "mcclenney-kay.jpg",
    "description" => "Kay McClenney is Director of the Center for Community College Student Engagement and Sid W. Richardson Endowed Fellow in the Community College Leadership Program (CCLP) at The University of Texas at Austin. She also directs the Center’s Initiative on Student Success, supported by the MetLife Foundation and Houston Endowment Inc."
  ),
  array(
    "name" => "Deborah McGriff",
    "image" => "mcgriff-deborah.jpg",
    "description" => "Deborah McGriff is a partner at NewSchools Venture Fund, where she leads the firm’s Academic Systems Initiative, and contributes to investment strategy and management assistance for a variety of its portfolio ventures."
  ),
  array(
    "name" => "Michael H. Oreskes",
    "image" => "oreskes-michael.jpg",
    "description" => "Michael “Mike” Oreskes is Vice President and Senior Managing Editor of The Associated Press (AP). He supervises the news cooperative’s daily all-format and global report. Mike came to the AP in 2008 from the International Herald Tribune where he was executive editor of the Paris-based daily owned by The New York Times. He spent 27 years with The New York Times Co. He began in 1981 as reporter for the Times, covering local, state and national politics; he was later appointed Metro editor, Washington bureau chief and deputy managing editor."
  ),
  array(
    "name" => "Jennifer Preston",
    "image" => "preston-jennifer.jpg",
    "description" => "Jennifer Preston is a reporter for The New York Times who writes about the role of social media in politics, government and real life. She recently joined The Lede blog, where she is drawing on the explosion of user generated content now shared on social media platforms to report stories. Jennifer returned to reporting in January 2011 after working as the newsroom’s first Social Media Editor. She began at The New York Times in 1995 as a political reporter and state house bureau chief. She previously worked at New York Newsday as deputy metropolitan editor and City Hall bureau chief."
  ),
   array(
    "name" => "Susan Sawyers",
    "image" => "sawyers-susan.jpg",
    "description" => "Susan Sawyers is a New York City based multimedia journalist and social media strategist. Mother of two, wife of one, she is interested in education, philanthropy and lifestyle reporting. Susan works as a researcher and producer for Bloomberg EDU with Jane Williams, Bloomberg Radio’s weekly program on education. Her writing and reporting has appeared in The New York Times, USA Today, The Huffington Post, The Hechinger Report and New York Social Diary. A graduate of Columbia University Graduate School of Journalism and Grinnell College, she was the former director/curator of the Los Angeles-based Iris and B. Gerald Cantor Foundation. She is a friend of The Future Project and a DoSomething speedcatcher and judge."
  ),
  array(
    "name" => "Bill Thompson",
    "image" => "thompson-bill.jpg",
    "description" => "Bill Thompson, a former New York City Comptroller and five-term president of the New York City Board of Education, is a senior managing director at Siebert Brandford Shank, the nation’s largest minority-owned firm in the field of municipal underwriting. As comptroller, Thompson also served as custodian and investment advisor to the five New York City Pension Funds, where he managed a combined portfolio amounting to more than $100 billion at the close of his tenure. During his tenure, Thompson also worked with leaders of the financial services industry to reform the operations of the New York Stock Exchange, and spearheaded the city’s Banking Development District program."
  ),
  array(
    "name" => "Richard Tofel",
    "image" => "tofel-richard.jpg",
    "description" => "Richard Tofel is general manager of ProPublica, with responsibility for all of its non-journalism operations, including communications, legal, finance and budgeting and human resources. He was formerly the assistant publisher of The Wall Street Journal and, earlier, an assistant managing editor of the paper, vice president, corporate communications for Dow Jones & Company, and an assistant general counsel of Dow Jones. Most recently, he served as vice president, general counsel and secretary of The Rockefeller Foundation, and earlier as president and chief operating officer of The International Freedom Center, a museum and cultural center that was planned for the World Trade Center site."
  )
);
$context['post'] = new HechingerPost($post);

Timber::render('pages/advisors.twig', $context);
