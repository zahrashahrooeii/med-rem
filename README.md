# Medication Reminder App

This is a Medication Reminder application that helps users to manage and track their medication schedules. The app provides secure user authentication with OTP-based registration and login. Users can add medications and receive timely reminders.

## Features

- **User Registration and Login**: Secure authentication with OTP verification.
- **Medication Management**: Add, view, and manage your medications.
- **Responsive UI**: User-friendly and responsive interface.
- **Email Integration**: Sends OTP to users via email during registration.
- **Session Management**: Secure sessions for logged-in users.

## Technologies Used

- **PHP**: Server-side scripting language.
- **MySQL**: Database management.
- **PHPMailer**: For sending emails.
- **OTPHP**: For generating and verifying OTPs.
- **HTML/CSS**: For frontend design and UI/UX.

## Getting Started

### Prerequisites

- PHP 7.4 or later
- MySQL
- Composer (for managing PHP dependencies)

### Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/zahrashahrooeii/med-rem.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd medication-reminder-app
    ```

3. **Install the dependencies:**

    ```bash
    composer install
    ```

4. **Set up the database:**

    - Create a MySQL database.
    - Import the `db.sql` file located in the `database` directory.

5. **Configure the environment:**

    - Copy the `config.php` file from the `src` folder and update it with your database credentials.
    - Update the PHPMailer credentials in the `register.php` file.

6. **Run the application:**

    - Start your local PHP server and navigate to the application in your browser.

### Usage

- **Register**: Navigate to `/public/register.php` to register a new user.
- **Login**: Navigate to `/public/login.php` to log in.
- **Dashboard**: After logging in, manage your medications on the dashboard.


## Contributing

Contributions are welcome! Please feel free to submit a Pull Request or open an issue if you find any bugs.

## Contact

If you have any questions, feel free to reach out.

- **Email**: zahra.shahrooeii@gmail.com
- **GitHub**: https://github.com/zahrashahrooeii

