# app.py

from flask import Flask, render_template, request, jsonify, redirect, url_for
from flask_login import LoginManager, UserMixin, login_user, login_required, logout_user, current_user
import pymysql


app = Flask(__name__)

app.config['SECRET_KEY'] = 'your_secret_key'  # Change this to a random secret key

login_manager = LoginManager(app)
login_manager.login_view = 'login'

class User(UserMixin):
    def __init__(self, user_id, username, password):
        self.id = user_id
        self.username = username
        self.password = password

# Dummy user data for demonstration purposes (replace this with your own user authentication logic)
users = {'1': User('1', 'user1', 'password1')}

@login_manager.user_loader
def load_user(user_id):
    return users.get(user_id)

# Configure MySQL
db = pymysql.connect(host='localhost',
                     user='root',
                     password='insert your own mysql password here!!!',
                     #password = '!',
                     db='MAMS',
                     charset='utf8mb4',
                     cursorclass=pymysql.cursors.DictCursor)

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
    user_id = request.form.get('user_id')  # Replace 'user_id' with the actual name of your login form field
    password = request.form.get('password')
    print(user_id, password)
    user = users.get(user_id)
    print(user)

    if user and password == user.password:
        login_user(user)
        return redirect(url_for('dashboard'))

    return redirect(url_for('login'))

@app.route('/dashboard')
@login_required
def dashboard():
    return render_template('dashboard.html', username=current_user.username)

# Create a cursor to execute SQL queries
cursor = db.cursor()
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
        username = request.form.get('username')
        password = request.form.get('password')

        # Check if user_id is already taken
        if user_id in users:
            return render_template('create_user.html', error='User ID already taken')

        # Create a new user
        new_user = User(user_id, username, password)
        users[user_id] = new_user
        login_user(new_user)  # Automatically log in the new user

        return redirect(url_for('dashboard'))

    return render_template('create_user.html')


if __name__ == '__main__':
    app.run(debug=True)