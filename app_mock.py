# app.py

from flask import Flask, render_template, request, jsonify, redirect, url_for
from enum import Enum

import pymysql

import hashlib
import os


app = Flask(__name__)

app.config['SECRET_KEY'] = 'your_secret_key'  # Change this to a random secret key

# MySQL database configuration
# Configure MySQL
db = pymysql.connect(host='localhost',
                     user='root',
                     #password='!',
                     password = '!',
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

class UserType(Enum):
    CUSTOMER = 1
    SERVICE_PROVIDER = 2

# Dummy user data for demonstration purposes (replace this with your own user authentication logic)
current_user_id = -1
current_user_type = None

def AddUser(user_id, username, password, user_type):
    salt = os.urandom(16).hex()
    password_hash = hashlib.sha256((password + salt).encode('utf-8')).hexdigest()

    if user_type == user_type.SERVICE_PROVIDER:
        try:
            # Check if the user is a ServiceProvider
            cursor.execute("SELECT * FROM ServiceProvider WHERE ServiceProviderName=%s", (username,))
            provider_data = cursor.fetchone()

            if provider_data:
                print("Username already taken", latest_user_id)
                return render_template('create_user.html', error='User ID already taken')

            print(user_id)
            cursor.execute("""
                INSERT INTO ServiceProvider (ServiceProviderID, ServiceProviderName, ContactInformation, PasswordHash, Salt)
                VALUES (%s, %s, %s, %s, %s)
            """, (user_id, username, "contact_info", password_hash, salt))

            db.commit()
            print("user added: ", latest_user_id)
        except Exception as e:
            print("Error during insertion:", str(e))
            return render_template('create_user.html', error='Failed to create user. Please try again.')


#   Home page
@app.route('/')
def home():
    return render_template('home.html')

#   Login page
@app.route('/login')
def login():
    return render_template('login.html')

@app.route('/login', methods=['POST'])
def login_post():
    username = request.form.get('username') 
    password = request.form.get('password')
    user_type = request.form.get("user_type")
    print(username, password, user_type)
    
    if user_type == 'CUSTOMER':
        user = find_user_by_username(username=username, user_type=UserType.CUSTOMER)
    elif user_type == 'SERVICE_PROVIDER':
        # Check if the user is a ServiceProvider
        cursor.execute("SELECT * FROM ServiceProvider WHERE ServiceProviderName=%s", (username,))
        provider_data = cursor.fetchone()
    if provider_data is None:
        return render_template('login.html', error='provider bad')
    password_hash = hashlib.sha256((password + provider_data['Salt']).encode('utf-8')).hexdigest()
    print(password_hash == provider_data["PasswordHash"])

    if password_hash == provider_data["PasswordHash"]:
        global current_user_id
        global current_user_type
        current_user_id = provider_data["ServiceProviderID"]
        current_user_type = user_type
        return redirect(url_for('dashboard'))
    return render_template('login.html', error='No match')
    

@app.route('/dashboard')
def dashboard():
    return render_template('dashboard.html', id=current_user_id)

@app.route('/logout')
def logout():
    return redirect(url_for('home'))

@app.route('/create_user', methods=['GET', 'POST'])
def create_user():
    if request.method == 'POST':
        # Get form data
        username = request.form.get('username')
        password = request.form.get('password')
        user_type = request.form.get("user_type")
        print(username, password, user_type)

        if user_type == 'CUSTOMER':
            # Create customer
            AddUser(0, username, password, UserType.CUSTOMER)
        elif user_type == 'SERVICE_PROVIDER':
            cursor.execute("SELECT MAX(ServiceProviderID) FROM ServiceProvider")
            max_id_result = cursor.fetchone()
            print(max_id_result)
            max_id = max_id_result["MAX(ServiceProviderID)"] if max_id_result["MAX(ServiceProviderID)"] is not None else 0
            user_id = max_id + 1
            AddUser(user_id, username, password, UserType.SERVICE_PROVIDER)
        else:
            return render_template('create_user.html', error='Pick User Type Option')

        # fuck the user make them login again (for safety tho and robustness of tests)
        return redirect(url_for('login'))

    return render_template('create_user.html')


if __name__ == '__main__':
    app.run(debug=True)