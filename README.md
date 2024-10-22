# Project: Calculation of the KXPO Factor

## Description

This web application allows the calculation of the **KXPO Factor** based on several parameters entered by the user, such as the length of the ship, the angle of gravity (T_sc), and the vertical position of the center of gravity. The app is built with **Laravel** on the backend and uses **Bootstrap 5** for the frontend.

### Main Features

- Accurate calculation of **KXPO Factor** using custom formulas.
- Data entry validation using **AJAX** for a seamless user experience.
- Presentation of results in an **interactive modal** without reloading the page.
- Use of **Bootstrap 5** for a responsive design.
- Real-time error handling and user feedback.

---

## Technologies used

- **Framework**: Laravel (PHP)
- **Frontend**: HTML5, CSS3, JavaScript (AJAX), Bootstrap 5
- **Backend**: PHP with Laravel
- **Database**: MySQL (optional if data persistence is required)
- **Version control**: Git

---

## Facility

### Prerequisites

Make sure you have the following programs installed before beginning the installation:

- **PHP** >= 8.2
- **Composer**
- **Node.js and npm**
- **MySQL** (optional)
- **Git**

### Installation steps

1. Clone the repository:

   ```bash
   git clone https://github.com/usuario/calcolo-fattore-app.git
   cd calcolo-fattore-app
   
2. Install PHP and Laravel dependencies with Composer:
   composer install

3. Install Node.js dependencies for the frontend (if necessary):
   npm install
   npm run dev

4. Configure the .env file:
   configure environment variables for your database, such as username, password, and database name if necessary.

5. Generate an application key:
   php artisan key:generate

6. Migrate databases:
   php artisan migrate

7. Start the Laravel development server:
  php artisan serve

8. Open the application in the browser at http://localhost:8000.

---

### Use
How to calculate the KXPO factor
Open the main page of the application.
Enter the requested values:
Length of the ship (in meters).
Pescaggio a Pieno Carico (T_sc) (in meters).
Vertical Position (can be negative).
Click the "Calculate KXPO" button.
The results will appear in a modal with the calculated parameters, including:
KXPO Factor
Center of gravity height (CG_h)
Pitch Angle (degrees and radians)
Angular Pitch Acceleration

Data validation
The data entered must comply with the validation rules:
All values ​​must be numeric.
The length of the ship and the value of T_sc must be positive values.
Vertical Position can be negative.
If the data is invalid, errors will be displayed below the input fields without reloading the page.

---

### API
- **Endpoint**
- **URL**: /calculate-kxpo
- **Method**: POST
- **Parameters**:
  length: Ship length (decimal, required)
  t_sc: Pescaggio a Pieno Carico (decimal, required)
  vertical_shift: Vertical Position (decimal, required)
  **Answer**:
 {
  "kxpo": 3.452,
  "cg_h": 15,
  "pitch_angle_rad": 0.1309,
  "angular_acceleration_pitch": 0.105
 }
- Errors: In case of invalid data, the API will return a JSON object with the validation errors.

### License
This project is licensed under the MIT License - see the LICENSE file for details.

### Credits
Developer: Ing. Diliam Cueto Casanovas
Creation date: October 2024
Technologies: Laravel, Bootstrap, HTML/CSS, JavaScript


