# app.py

from flask import Flask, render_template, request, jsonify, redirect, url_for
from flask_login import LoginManager, UserMixin, login_user, login_required, logout_user, current_user
import pymysql

import hashlib
import os

app = Flask(__name__)
app.config['SECRET_KEY'] = 'your_secret_key'  # Change this to a random secret key

login_manager = LoginManager(app)
login_manager.login_view = 'login'

# MySQL database configuration
# Configure MySQL
db = pymysql.connect(host='localhost',
                     user='root',
                     password='!',
                     #password = '!',
                     db='MAMS',
                     charset='utf8mb4',
                     cursorclass=pymysql.cursors.DictCursor)
cursor = db.cursor()

# Create tables if not exists
cursor.execute("""
    CREATE TABLE IF NOT EXISTS Customer (
        CustomerID INT PRIMARY KEY,
        ContactInformation TEXT,
        MachinesOwned TEXT,
        PurchaseHistory TEXT,
        WarrantyInformation TEXT,
        PasswordHash VARCHAR(255),
        Salt VARCHAR(50)
    );
""")

cursor.execute("""
    CREATE TABLE IF NOT EXISTS ServiceProvider (
        ServiceProviderID INT PRIMARY KEY,
        ServiceProviderName VARCHAR(255),
        ContactInformation TEXT,
        PasswordHash VARCHAR(255),
        Salt VARCHAR(50)
    );
""")
db.commit()

# Example User class for Customer (replace this with your own user model)
class Customer(UserMixin):
    def __init__(self, customer_id, contact_info, machines_owned, purchase_history, warranty_info, password_hash, salt):
        self.id = customer_id
        self.contact_info = contact_info
        self.machines_owned = machines_owned
        self.purchase_history = purchase_history
        self.warranty_info = warranty_info
        self.password_hash = password_hash
        self.salt = salt

# Example User class for ServiceProvider (replace this with your own user model)
class ServiceProvider(UserMixin):
    def __init__(self, provider_id, provider_name, contact_info, password_hash, salt):
        self.id = provider_id
        self.provider_name = provider_name
        self.contact_info = contact_info
        self.password_hash = password_hash
        self.salt = salt


@login_manager.user_loader
def load_user(user_id):
    # Check if the user is a Customer or ServiceProvider
    cursor.execute("SELECT * FROM Customer WHERE CustomerID=%s", (user_id,))
    customer_data = cursor.fetchone()
    if customer_data:
        return Customer(*customer_data)

    cursor.execute("SELECT * FROM ServiceProvider WHERE ServiceProviderID=%s", (user_id,))
    provider_data = cursor.fetchone()
    if provider_data:
        return ServiceProvider(*provider_data)

@app.route('/')
def home():
    return render_template('home.html')

@app.route('/login')
def login():
    return render_template('login.html')

@app.route('/login', methods=['POST'])
def login_post():
    user_id = request.form.get('user_id')
    password = request.form.get('password')

    # Check if the user is a Customer
    cursor.execute("SELECT * FROM Customer WHERE CustomerID=%s", (user_id,))
    customer_data = cursor.fetchone()
    if customer_data and check_password(customer_data[5], customer_data[6], password):  # Assuming PasswordHash and Salt are at index 5 and 6
        user = Customer(*customer_data)
        print("Customer login successful")
        print("User:", user)
        login_user(user)
        return redirect(url_for('dashboard'))

    # Check if the user is a ServiceProvider
    cursor.execute("SELECT * FROM ServiceProvider WHERE ServiceProviderID=%s", (user_id,))
    provider_data = cursor.fetchone()
    if provider_data and check_password(provider_data['PasswordHash'], provider_data['Salt'], password):
        user = ServiceProvider(*provider_data)
        print("ServiceProvider login successful")
        print("User:", user)
        login_user(user)
        return redirect(url_for('dashboard'))

    # If the login fails, redirect to the login page
    print("Login failed")
    return redirect(url_for('login'))

@app.route('/dashboard')
@login_required
def dashboard():
    if current_user.is_authenticated:
        return render_template('dashboard.html', user=current_user)
    else:
        return redirect(url_for('login'))

@app.route('/logout')
@login_required
def logout():
    logout_user()
    return redirect(url_for('home'))

@app.route('/create_user', methods=['GET', 'POST'])
def create_user():
    if request.method == 'POST':
        # Get form data
        user_id = request.form.get('user_id')
        user_type = request.form.get('user_type')  # 'customer' or 'provider'
        contact_info = request.form.get('contact_info')
        password = request.form.get('password')

        # Check if the user ID is already taken
        cursor.execute("SELECT * FROM ServiceProvider WHERE ServiceProviderID=%s", (user_id,))
        existing_user = cursor.fetchone()

        if existing_user:
            return render_template('create_user.html', error='User ID already taken')

        # Create a new user
        salt = generate_salt()
        password_hash = hash_password(password, salt)

        try:
            cursor.execute("""
                INSERT INTO ServiceProvider (ServiceProviderID, ServiceProviderName, ContactInformation, PasswordHash, Salt)
                VALUES (%s, %s, %s, %s, %s)
            """, (user_id, "", contact_info, password_hash, salt))

            db.commit()
        except Exception as e:
            print("Error during insertion:", str(e))
            return render_template('create_user.html', error='Failed to create user. Please try again.')

        # Try to retrieve the newly created user using a separate query
        cursor.execute("SELECT * FROM ServiceProvider WHERE ServiceProviderID=%s", (user_id,))
        user_data = cursor.fetchone()

        print("User data after insertion (separate query):", user_data)

        if user_data:
            user = ServiceProvider(*user_data, )

            print("User creation successful")
            print("User:", user)

            login_user(user)  # Automatically log in the new user

            return redirect(url_for('dashboard'))
        else:
            print("Failed to retrieve the newly created user using a separate query")

    return render_template('create_user.html')  # Add this line to handle GET requests


def generate_salt():
    return os.urandom(16).hex()

def hash_password(password, salt):
    hashed_password = hashlib.sha256((password + salt).encode('utf-8')).hexdigest()
    return hashed_password

def check_password(saved_password, salt, user_password):
    return saved_password == hash_password(user_password, salt)

if __name__ == '__main__':
    app.run(debug=True)

(""")
@app.route('/users')
def get_users():
    try:
        # Execute the SQL query
        cursor.execute('SELECT * FROM example')

        # Fetch all rows as a list of dictionaries
        result = cursor.fetchall()

        # Return the result as JSON
        return jsonify(result)

    except Exception as e:
        # Handle exceptions (print/log the error, return an error response, etc.)
        print(e)
        return jsonify({'error': 'An error occurred while fetching data'})
(""")

(""")
# Configure MySQL
db = pymysql.connect(host='localhost',
                     user='root',
                     password='2345Nights!',
                     #password = '!',
                     db='MAMS',
                     charset='utf8mb4',
                     cursorclass=pymysql.cursors.DictCursor)
(""")