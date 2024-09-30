# Job Application System

## Overview
PHP, HTML, and CSS were used to create this straightforward, multi-step job application system. Through a series of forms spanning several pages, the application gathers the user's personal data, employment history, and educational background. It also offers session management, progress tracking, and attempts to send a confirmation email upon successful submission.


## CSS Usage:
  - The layout is styled with basic CSS for alignment, spacing, and buttons.
  - Each form step is styled for clarity.
  - A **progress bar** was intended to visually show which step the user is on, but due to some mismatches in the front-end, it has not been fully integrated.


## Application Structure
The application consists of three main pages:
1. **home.php**
2. **review.php**
3. **logout.php**
4. **index.php**
5. **login.php**
6. **registration.php**
7. **submit.php**


## Application Flow
The application flow is as follows:

index.php
    |
    |
login.php
    |
    |
registration.php
    |
    |
home.php
    |
    |
review.php
    |
    |
submit.php
    |
    |
logout.php


## Known Issues

   - The progress bar intended for tracking steps is not fully implemented due to a mismatch between the back-end progress tracking and front-end design.

   - The `mail()` function is not working, likely due to a configuration issue (e.g., missing mail server settings or local environment limitations).
   - This needs to be fixed by configuring a proper mail server or using a third-party service like SendGrid or SMTP.


## How to Run
Start Xampp server, download zip or clone this repository and run index file directly.


## Conclusion

This simple multi-step form system for job applications was constructed with PHP sessions and stylized with little CSS. The application's basic capabilities for collecting and interpreting data function effectively, but several extra features—like the progress bar and email sending—need extra effort or outside setting to operate correctly.