# Project Brief: AI Job Application & Skill Gap Analyzer

## 1. Problem
Some people may not know whether their resume matches the job they're looking for or not. This website will help the user to analyze the job intended and compared it to their resume. It will help users know which part of their skills that matches and which part is not.

## 2. Target users
Freshgraduates who are looking for a job or adults who wants a career switch.

## 3. MVP features
1. Register, log in, log out
2. Upload one PDF resume, with file type and size checks
3. Extract the text and show it to the user, so they can check it
4. Paste a job description
5. Click “Analyze” → one AI request → results: matching skills (with evidence from the resume) requirements not clearly shown
6. A simple score calculated by our code, with an explanation
7. Save the analysis so the user can see it again

## 4. Risks
- Risk 1: The system may not analyze the job correctly
  Mitigation: The AI gives the results in text so that the user can see wether it is correct or not
- Risk 2: Privacy - user's data may not be secured as it was sent to the AI company
  Mitigation: Remove personal details (name, phone, email, address) before
  sending the resume to the AI. Choose an AI provider that does not use our
  data for training. Tell users clearly what is sent, and let them delete
  their own data.
- Risk 3: Some text that are extracted from PDF may have broken or wrong text.
  Mitigation: After the system scanned and extracted the text, it will show at the textbox the overall text that was extracte. From here, user can check whether the extracted text is right or wrong and edit it.

## 5. Test data
- Fake resume: (written? yes/no) yes
- Real job description: (found? yes/no) yes

## 6. Functional requirements
- FR1: The system shall allow users to register, log in, and log out.
- FR2: The system shall allow user to upload one PDF resume with file type with maximum of 5 MB
- FR3: The system shall extract the text and show it to the user and allow user to edit it
- FR4: The system shall analyze based on the PDF and job description, and show the  
- FR5: The system shall save the analysis so the user can see it again
- FR6: The system shall allow the user to paste the job description they intended to apply at the textbox

## 7. Non-functional requirements
- NFR1: Uploaded resumes shall be visible only to the user who uploaded them.
- NFR2: The system shall not send the user's personal records such as name, email, phone number or home address to the AI provider.
- NFR3: The system shall take within 1 minute to complete the analysis.

## 8. Database design
resumes
- id
- user_id   (foreign key → users)
- original_filename
- extracted_text
- timestamps

job_descriptions
- id
- user_id
- job_title
- job_description
- timestamps

analyses
- id
- user_id
- resume_id (foreign key -> resumes)
- job_description_id (foreign key->job_descriptions)
- ai_model
- file_path (this is where we saved it)
- job_score
- result

# 9. Pages
| Page              | What the user does                     | Requirement |
|-------------------|----------------------------------------|-------------|
| Register          | Creates an account                     | FR1         |
| Login             | Logs in with email and password        | FR1         |
| Dashbboard        | See the activity's overall progress    | FR5         |
| Upload resume page| Upload the resume to be extracted      | FR2 & FR3   | 
|                   | and checks and edit the text           |             |
| Paste job desc    | Paste the job description              | FR6         |
| Paste job desc    | User click analyse to start the        | FR6 & FR4   |
| page              | analysis                               |             |
| Results page      | Scores and matching skills shown       | FR4         |
| History page      | See the history activity and results   | FR 5        |

## 10. Results page wireframe
Results
+--------------------------------------------------+
| Your overall score: 67%                          |
| 4 of 6 required skills found in your resume      |
+--------------------------------------------------+
| Matching skills                                  |
| ✓ PHP  — "Built HuffazTrack using Laravel..."    |
| ✓ HTML — "Designed responsive web pages..."      |
+--------------------------------------------------+
| Requirements not clearly shown                   |
| • JavaScript                                     |
| • React.js                                       |
+--------------------------------------------------+
| AI-generated. May contain mistakes.              |
| Please check the evidence above.                 |
+--------------------------------------------------+