**This Project LIVE at:**  

[https://srgec-library.great-site.net/](https://srgec-library.great-site.net/)



📚 SRGEC Library Web System

Welcome to the SRGEC Library Web System — a digital platform designed to manage and streamline library access, student tracking, and resource administration for SRGEC.

This project is organized into three main modules:

admin

Gate-register

scanner

Each plays a specific role in managing the library system.

📁 Project Structure
/admin

This folder contains tools and interfaces for administrators. Likely features:

Adding/editing/deleting user records

Viewing logs of scanned entries and exits

General library settings and analytics


/Gate-register

This module is responsible for logging entries and exits through the library gate. It serve as a simple interface used by security personnel or automated systems.

Typical features:

Log timestamps for entry/exit

Store logs for audit or reporting


/scanner

This folder includes the QR or ID scanner interface used at the library entrance. It connect with a scanner to read student/library IDs.

Potential functionality:

Scan and decode QR codes or IDs

Match scanned IDs with user database

Total history of visitors in Pie Chart and Bar Graph

Trigger automatic logging to Gate-register

Possible files inside:


🚀 Getting Started

To set up and run this system:

Clone or download this project.

Deploy on a PHP-supported server (e.g., XAMPP, WAMP, or a live hosting service).

Make sure your server supports:

PHP

MySQL

Configure database

Start the app from /admin/index.php for administrative access.

🔐 User Roles

Admin: Full access to all modules.

Library Staff: Use Gate-register and scanner.

Students/Visitors: Can be scanned and registered through the system.

📞 Contact

For questions or support, please contact the system administrator or SRGEC IT department.
