INSERT INTO Templates (title, contents, comments)
VALUES ('CV', '{{date}} 
{{applicant_name}} 
{{applicant_email}} 

Dear {{applicant_name}}, 

Thank you for your application to the position of {{position_title}}. We have a large number of applicants for this position and we are sorry to inform you that on this occasion you were not selected for the interview. 

We wish you all the best in your job search. 

Best wishes, 
{{interviewer_name}} 
{{interviewer_email}}', 
'CV is not well formatted::::CV has spelling mistakes');

INSERT INTO Templates (title, contents, comments)
VALUES ('Phone interview', '{{date}}
{{applicant_name}}
{{applicant_email}}

Dear {{applicant_name}},

Thank you very much for investing your time and effort to interview with our team about our {{position_title}} position at HappyTech.

It was great to talk to you and learn about your skills and experiences. 

Unfortunately, at this time, we decided to proceed with our selection process with another candidate.
It is a decision we did not make easily because you are really a strong candidate with a wonderful personality.



On behalf of HappyTech, I thank you for your time, interest and effort, and I wish you the best in your future career endeavors.

Regards,
{{interviewer_name}}
{{interviewer_email}}', 
'Candidate did not seem like a good team fit::::Candidate failed to answer basic technical questions');

INSERT INTO Templates (title, contents, comments)
VALUES ('Technical interview', '{{date}}
{{applicant_name}}
{{applicant_email}}

Dear {{applicant_name}},

I want to thank you for your interest in the {{position_title}} position at HappyTech and for all of the time you have put into the interview process. 

Unfortunately, we will not be offering the position to you. While your education qualifications are very impressive, we have chosen a candidate who has more hands-on experience. 



On behalf of HappyTech, I thank you for your time, interest and effort, and I wish you the best in your future career endeavors.

Regards,
{{interviewer_name}}
{{interviewer_email}}', 
'Candidate could not solve problem that was set::::Candidate seemed to lack relevant experience when questioned about technical issues');

