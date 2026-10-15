# Noteffy – Productivity & Task-Sharing App

Noteffy is a productivity and task-sharing web application designed to help users organize tasks, improve collaboration, and manage their daily activities efficiently. The project was developed using the WAMP stack, with scheduled background processes and internal API modules supporting application functionality.

## Features
Task Management: Supports productivity-focused task organization and management.
Task Sharing: Designed to facilitate task sharing and collaboration.
Push Notifications: Uses scheduled processes to support timely notifications.
Automated Scheduling: Implements Linux cronjobs to execute scheduled tasks and background processes.
Internal API Modules: Integrates internal APIs to support application functionality across the site.
Admin Panel Enhancements: Includes supplementary front-end development for the organization's administrative panel.
## Tech Stack
WAMP Stack: Windows, Apache, MySQL, and PHP
Backend: PHP
Database: MySQL
Web Server: Apache
Scheduling: Linux Cronjobs
Frontend: Web technologies used for the application and admin panel
Version Control: Git and GitHub
## Key Contributions
Implemented Linux cronjob-based scheduling for automated background processes.
Worked on push notification scheduling to support timely delivery of application notifications.
Contributed to internal API modules used across the website.
Assisted with front-end development and enhancements for the organization's admin panel.
Supported the development of a productivity-focused application centered on task management and sharing.
 Architecture Overview

Noteffy combines a web application backend, database services, internal API modules, and scheduled background jobs.

Frontend: Provides the user interface for interacting with the application.
Backend: Handles application logic and API functionality.
Database: MySQL stores application data.
Scheduled Jobs: Linux cronjobs trigger predefined tasks and notification-related processes.
Admin Panel: Provides an administrative interface with supplementary front-end enhancements.
 Installation and Setup

The following is a general setup guide for a PHP and MySQL application. Adapt the configuration to the actual project structure.

Prerequisites
Git
Apache web server
PHP
MySQL
A compatible WAMP environment for local development
Linux environment with cron support for scheduled jobs
Installation
Clone the repository:
   git clone <repository-url>

Navigate to the project directory:
   cd noteffy

Configure the Apache document root to point to the project directory.
Create a MySQL database and import the project's database schema or SQL dump, if provided.
Configure the database connection using the project's configuration files.
Start Apache and MySQL, then open the application through your local development URL.
Cronjob Configuration

Scheduled tasks can be configured through the Linux crontab.

Open the crontab editor:

crontab -e


Add the appropriate scheduled command using the actual script path and required execution interval.

Note: The cronjob commands, scheduling intervals, API endpoints, and notification scripts must be configured according to the implementation in the repository.

## Configuration and Security
Keep database credentials and API secrets out of version control.
Use environment variables or appropriate configuration files for sensitive settings.
Validate API inputs and apply suitable authentication and authorization checks.
Ensure scheduled jobs have the required permissions and error logging.
 Project Structure

The exact directory structure depends on the repository implementation. A typical PHP application may organize its files as follows:

noteffy/
├── admin/           # Administrative interface
├── api/             # Internal API modules
├── assets/          # CSS, JavaScript, and images
├── config/          # Application configuration
├── includes/        # Shared PHP components
├── cron/            # Scheduled job scripts
├── index.php        # Application entry point
└── README.md


This is an illustrative structure, not a verified listing of the actual repository files.

##  Project Objective

The goal of Noteffy is to provide a centralized platform for productivity and task sharing, supported by automated background processing, notification scheduling, and administrative tools.

 ## Development

This project involved backend-related scheduling and API work, along with supplementary front-end contributions to the organization's admin panel.

 License

Add the applicable license information here if the repository is intended for public distribution.

Project: Noteffy – Productivity & Task-Sharing App
Technology: WAMP Stack, PHP, MySQL, Apache, Linux Cronjobs
Repository: GitHub Repository


<img width="849" height="686" alt="image" src="https://github.com/user-attachments/assets/91b4d41b-26e8-4b52-970c-a2d0b50d19c9" />

