# Laravel Event Manager with Outlook Calendar Integration

This Laravel application streamlines event management and facilitates seamless integration with your Microsoft Outlook calendar.

## Features

- Event Management: Create, update, and delete events effortlessly.
- Upcoming Events: View a comprehensive list of upcoming events at a glance.
- Outlook Calendar Integration: Synchronize events seamlessly with your Outlook calendar.
- Notifications: Receive timely notifications for upcoming events.
- Authentication: Ensure secure authentication with Azure Active Directory.
- Background Job Queue: Utilize Laravel Queues for efficient background job processing during event creation in Outlook.
- Extended Support: Enjoy support for event descriptions and start/end dates.
## Requirements
- Laravel 8+
- Microsoft Azure Active Directory account
- Microsoft Graph API access
- Composer

## Installation

- Clone this repository or download the ZIP file.
- Run composer install to install dependencies.
- Copy the .env.example file to .env and configure your application settings:
- APP_ID: Your Microsoft Azure application ID
- APP_SECRET: Your Microsoft Azure application secret
- TENANT_ID: Your Azure Active Directory tenant ID
- REDIRECT_URI: Your application's redirect URI
- DATABASE_URL: Your database connection string
- Run php artisan key:generate to generate an application key.
- Run php artisan migrate to create the necessary database tables.
- (Optional) Set up Laravel Queues if you intend to use background processing for event creation in Outlook.
- Start the development server: php artisan serve.
## Usage
### Create an Event:
- Specify the title, start date, end date, and description.
- Click the "Create Event" button.
- The event will be created in your application and seamlessly synced with your Outlook calendar.
- Update or Delete an Event:
- Click on the event in the list.
- Edit the event details or click the "Delete Event" button.
- The changes will be saved and reflected in both your application and Outlook calendar.
