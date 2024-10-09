# Telegram chat analyser!

Welcome to **telegram-chat-analyser!**, a funny analyser to analysis your telegram chats. This is just the primary version, and we may have any other updates for future releases.

## Features

- **Privacy:** Your chat don't save in any database and your files are not sored in anywhere.
- **User-friendly:** Easy to use with graphs, a bit complicated when using raw result.


## Demo

A live version of the application is online and accessible via [telegram-char.epicmaze.ir]()

You can easily use that for analysis your lightweight chats.

## Installation

To set up your own self-hosted server, follow these steps:

### Prerequisites

Ensure you have the following installed on your system:

- Composer
- MySql
- Apache Server
- php >= 8.2
- Laravel >= 10

### Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/erfanfh/chatAnalysis.git
   ```

2. **Navigate to the project directory:**

   ```bash
   cd chatAnalysis
   ```

3. **Install dependencies:**

   ```bash
   composer install
   ```
4. **Copy the example environment file and configure the environment::**

   ```bash
   cp .env.example .env
   ```
   Update the .env file with your database and other configurations.

5. **Generate the private key:**

   ```bash
   php artisan key:generate
   ```
   
6. **Run the database migrations:**

   ```bash
   php artisan migrate
   ```

7. **Update your php.ini:**

   Update your `post_max_size` in `php.ini` file to the amount you prefer

8. **Set up your server:**

   - set up apache server via a third-party application like xammp (recommended).

     #### **or**

   - set up your server via this command

      ```bash
      php artisan serve
      ```
      The application will be available at http://localhost:8000.


## Support

For support, email erfanfarokhi.official@gmail.com.
