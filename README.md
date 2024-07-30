# Dynamic Calculator Website

A dynamic calculator website built with PHP and MySQL. This project includes a robust backend for managing multiple calculators, user authentication, and a clean frontend interface. Easily add and manage calculators with customizable HTML and JavaScript.

## Features

- User authentication (Admin and Member roles)
- Add, edit, and delete calculators
- Dynamic loading of calculator forms and scripts
- Responsive design with Bootstrap
- SEO-friendly URLs with slugs
- User-friendly admin dashboard

## Technologies Used

- PHP
- MySQL
- Bootstrap 5
- JavaScript
- HTML/CSS

## Setup Instructions

### Prerequisites

- PHP >= 7.4
- MySQL
- Web server (e.g., Apache, Nginx)
- Composer (optional for managing dependencies)

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/your-repo.git
    cd your-repo
    ```

2. Import the `database.sql` file into your MySQL database.

3. Configure your database connection in `config.php`:
    ```php
    <?php
    // Database connection credentials
    $servername = "localhost";
    $username = "your_database_username";
    $password = "your_database_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

4. Ensure your web server is configured to serve the project directory.

5. Access the application in your web browser:
    ```
    http://yourdomain.com/your-repo
    ```

## Usage

- Login with the demo credentials (`admin` / `admin`) to access the admin dashboard.
- Add, edit, and delete calculators through the admin dashboard.
- View and use calculators on the frontend.

## Contributing

Contributions are welcome! Please create a pull request or open an issue to discuss your changes.

## License

This project is licensed under the MIT License.
