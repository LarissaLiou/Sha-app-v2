import mysql.connector
import csv
# Define your connection parameters
db_config = {
    'user': 'root',
    'password': '',
    'host': '127.0.0.1',  # or '127.0.0.1'
    'database': 'sociate'
}

csvfile = "Process_Events/Events.csv"
data = list(csv.reader(open(csvfile)))[1:]

# Establish a connection
# Establish a connection
try:
    connection = mysql.connector.connect(**db_config)

    if connection.is_connected():
        print("Connected to the database")

    

except mysql.connector.Error as err:
    print("Error:", err)

finally:
    if connection.is_connected():
        cursor.close()
        connection.close()
        print("MySQL connection is closed")
