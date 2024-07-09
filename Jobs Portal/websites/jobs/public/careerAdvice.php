<?php
// Require the dbConnection.php file to establish connection with the database
require('./dbConnection.php');
// Set variables value
$title = 'Career Advice';
$mainClass = 'home';
$output = '
<p>Welcome to Jo\'s Jobs, we\'re a recruitment agency based in Northampton. We offer a range of different office jobs. Get in touch if you\'d like to list a job with us.</a></p>
<h2>Here are some Career Advices:</h2>
<ol>
    <li><strong>Know Yourself:</strong> Understand your strengths, weaknesses, interests, and values. This self-awareness will guide you in finding a career that aligns with who you are.</li>
    <li><strong>Set Clear Goals:</strong> Define what you want to achieve in your career, both short-term and long-term. Having clear goals will help you stay focused and motivated.</li>
    <li><strong>Continuous Learning:</strong> In today\'s fast-paced world, it\'s crucial to keep learning and upgrading your skills. Stay updated with industry trends and invest in professional development.</li>
    <li><strong>Networking:</strong> Build and maintain professional relationships. Networking can open up new opportunities, provide support, and help you learn from others in your field.</li>
    <li><strong>Seek Feedback:</strong> Don\'t be afraid to ask for feedback from mentors, colleagues, or supervisors. Constructive feedback can help you identify areas for improvement and grow professionally.</li>
    <li><strong>Be Adaptable:</strong> The job market is constantly changing, so be flexible and open to new opportunities. Adaptability is a valuable skill in today\'s dynamic work environment.</li>
    <li><strong>Take Risks:</strong> Don\'t be afraid to take calculated risks in your career. Stepping out of your comfort zone can lead to growth and new opportunities.</li>
    <li><strong>Work-Life Balance:</strong> Strive for a healthy balance between your work and personal life. Burnout can negatively impact your career, so make time for relaxation, hobbies, and spending time with loved ones.</li>
    <li><strong>Stay Positive:</strong> Career paths often have ups and downs. Stay resilient, maintain a positive attitude, and focus on solutions rather than dwelling on setbacks.</li>
    <li><strong>Give Back:</strong> As you progress in your career, consider giving back by mentoring others or getting involved in volunteer work. Helping others not only feels rewarding but also expands your network and enhances your leadership skills.</li>
</ol>
';
// Call the layout.html.php that is the layout of the page
require('./templates/layout.html.php');