# Changelog

This project follows the [SemVer](https://semver.org/) convention for versioning, which implies:
- **MAJOR**: Incompatible changes that break backward compatibility.
- **MINOR**: New backwards compatible features.
- **PATCH**: Bug fixes or minor improvements.

## [Unreleased]

### Added
- **Project documentation**: Complete documentation on the project structure, use of APIs and examples of KXPO calculation responses has been added.

---
## [1.1.0] - 2024-10-18

### Added
- **Modal for results**: Added a modal that clearly displays the results of the KXPO calculation in a table. Users can view parameters such as CG_h height, Pitch angle, and angular acceleration without reloading the page.
  - **Reason**: Improve the user experience, allowing the results to be more visual and easier to interpret in a pop-up modal.
  - **Impact**: It makes the presentation of the results more professional, in addition to making it easier to read them in a well-structured table.
  
- **Error Handling with AJAX**: Validation errors are now handled dynamically using AJAX, allowing the user to correct their input in real time without reloading the page.
  - **Reason**: Improve user experience by avoiding unnecessary reloads and making it easier to correct input errors.
  - **Impact**: Users will receive immediate feedback when data entered is invalid.

### Changed
- **Refactoring of the KXPO factor calculation**: The calculation code has been reorganized by dividing the mathematical operations into several parts to improve the readability and maintainability of the code.
  - **Reason**: To facilitate the understanding and maintenance of the calculation, given that the formula is complex and consists of several intermediate steps.
  - **Impact**: Code is easier to read and debug, reducing the likelihood of errors in future modifications.

  - **JavaScript Separation**: The JavaScript code has been separated from the main HTML, moving it to a separate file (`public/js/kxpo.js`).
  - **Reason**: Improve the code structure and maintain the separation of responsibilities, following frontend development best practices.
  - **Impact**: Facilitates updating JavaScript code without having to alter the frontend view and allows better organization of the project.

###Fixed
- **Fix in decimal data validation**: Fixed an issue where decimal values ​​for `length`, `T_sc`, and `vertical_shift` were not handled correctly, resulting in unexpected validation errors.
  - **Reason**: Ensure that numerical data entered by the user is validated and handled correctly.
  - **Impact**: Improves the reliability of validations and reduces friction for the user when entering decimal values.

  ---

## [1.0.1] - 2024-10-17

###Fixed
- **Correction in the functionality of the "Clean" button**: Fixed an issue where the button to clean the form did not restore the input fields to the initial state.
  - **Reason**: Users reported that the button did not correctly reset fields, which affected their experience when trying to perform multiple calculations.
  - **Impact**: Users can now clean fields without problems and perform a new calculation from scratch.
  
- **Form validation errors in results display**: Fixed an issue where validation messages were not displayed correctly when invalid values ​​were entered.
  - **Reason**: Ensure that validation errors are presented clearly and in real time.
  - **Impact**: Improvement in the user experience by correcting the data before performing the calculation.

---

## [1.0.0] - 2024-10-16

### Added
- **Initial version**: Implementation of the KXPO factor calculation logic, using the values ​​entered by the user (ship length, T_sc and vertical shift) to determine the height of the CG_h and other related parameters.
  - **Reason**: Provide a basic tool to calculate the KXPO factor based on ship length and other technical factors.
  - **Impact**: First functional version that allows users to calculate the KXPO factor with accurate results.

- **Basic Form Validation**: Added basic validation to ensure that entered values ​​are numeric and that empty entries are not allowed.
  - **Reason**: To ensure that calculations are performed with valid values ​​and prevent errors due to incorrect entries.
  - **Impact**: Improves the precision of calculations and prevents errors due to invalid data.