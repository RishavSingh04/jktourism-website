FAKIR CHAND BOOK STORE
========================
PHP + MySQL dynamic bookstore for college deployment practical.

LOCAL SETUP
1. Put this folder inside XAMPP/htdocs.
2. Start Apache and MySQL.
3. Open phpMyAdmin and import database.sql.
4. db.php uses localhost/root/blank password by default.
5. Open http://localhost/fakir-chand-book-store/

LIVE DEPLOYMENT
1. Create a MySQL database on your hosting panel.
2. Import database.sql through phpMyAdmin (remove CREATE DATABASE/USE lines if the host doesn't allow them).
3. Update db.php with your hosting database name, username and password.
4. Upload all files to public_html using FileZilla.
5. Open your domain.

DEMO LOGIN
Register a new account from register.php. Passwords are stored securely with PHP password_hash().
