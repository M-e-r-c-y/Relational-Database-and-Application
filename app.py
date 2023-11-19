# app.py

from flask import Flask, render_template, request, jsonify
import pymysql

app = Flask(__name__)

# Configure MySQL
db = pymysql.connect(host='localhost',
                     user='root',
                     password='insert your own mysql password here!!!',
                     #password = '',
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


if __name__ == '__main__':
    app.run(debug=True)