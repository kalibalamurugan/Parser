What is this repository for?

    PARSER – Personalized Accessibility based Re-ranking of Search Engine Results which aims towards quantizing the optimality of the pages with respect to the user’s personalized accessibility and information requirement context.

PARSER which incorporates personalization in-terms of accessibility guidelines and content while re-ranking the search engine‘s results.

BitBucket Account:https://bitbucket.org/kalibalamurugan/parser_repo 
GitHUB: https://github.com/kalibalamurugan/Parser
How do I get set up?

How to configure Parser:
1. Install Xampp 
2. Paste Parser Folder inside PHP enabled directory (/htdocs/Xampp/) 
3. To install Achecker in localhost:
  3.1. http://downloads.sourceforge.net/achecker/AChecker-1.3.tar.gz follow link to download achecker 
  3.2. Server requirements are the same as the ATutor Requirements. After downloading the file, unpack it into a PHP enabled directory, then in your browser open the install scripts by pointing your broweer to: http://[yourservername.com]/achecker/install/. Then follow the instructions. 
  3.3. Once achecker installed successfully; type http://localhost/achecker/ in browser address bar 
  3.4. Click on register link and provide all necessary information 
  3.5. After successfully installation you will get Service ID, make note of it [Detailed Help for registeration :In order for a user to login to the AChecker system and save results from accessibility reviews, manage guidelines, translate or administer the system, a unique system account needs to be created. Use the Register link on the login screen to access the registration form. If email-confirmation has been enabled by the system administrator, a message will be sent to the email address entered, containing a link that must be followed to confirm the new account. Once this has been done, the login name or email address, and the password entered during registration can now be used on the Login screen.
       A user may login to AChecker with their Login Name or Email address, and the Password entered during registration. Logging in gives users access to create, edit and use customized validation guidelines, and to save result of completed accessibility evaluations.] 
  3.6. Click on Web Service API
  http://localhost/xampp/AChecker-1.3/AChecker/checkacc.php?uri=http%3A%2F%2Fatutor.ca&; id=[change service id of your own] &output=html&guide=STANCA,WCAG2-AA&offset=10 
4. Go to parser directory, open Restwebservice.php file, change following line of code
How to Configure Database 
    5.1. Create Database named “Parser” 
    5.2. Click on import button to import parser.sql file.
    Register user profile
    Go browser window and Type localhost/xampp/parser/bing_basic.html
    Web Accessibility Checker AChecker is used to evaluate HTML content for accessibility problems by entering the location of a web page, uploading an html file, or by pasting the complete HTML source code from a Web page. AChecker produces a report of all accessibility problems for your selected guidelines. AChecker identifies 3 types of problems: 1. Known problems: These are problems that have been identified with certainty as accessibility barriers. You must modify your page to fix these problems; 2. Likely problems:These are problems that have been identified as probable barriers, but require a human to make a decision. You will likely need to modify your page to fix these problems; 3. Potential problems: These are problems that AChecker cannot identify, that require a human decision. You may have to modify your page for these problems, but in many cases you will just need to confirm that the problem described is not present. Options include: Enable HTML Validator When this option is turned on, AChecker sends the HTML content to W3C Markup Validation Service (http://validator.w3.org/) which identifies HTML markup errors and displays the validation results in "HTML Markup Validation Results" section. Expect reviews to take longer when this option is enabled. Enable CSS Validator When this option is enabled, AChecker will send the HTML content, along with its inline styles, styles defined in the head area of the HTML, and linked external style sheets, to the W3C Jigsaw CSS Validator (http://jigsaw.w3.org/css-validator/), which will identify any errors in the CSS, and display those results under the CSS Validation tab of the Accessibility Review. Show Source Print out the HTML of the page being reviewed, and link listed accessibility errors directly to the lines where they occur. Guidelines to Check Against Turn on/off the checkboxes to select the accessibility guidelines that AChecker validates against. View by Guideline: Default: Present the report listing all errors grouped by guideline success criteria. View by Line Number: Present the report listing all errors as they occur in the HTML being evaluated, line by line. Check Details To view details associated with an identified barrier, click on its text link in the accessibility evaluation results to open a window and display a range of information on the barrier.
