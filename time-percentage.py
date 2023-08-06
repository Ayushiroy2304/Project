import serial
import time
import mysql.connector

# Replace with the appropriate serial port and baud rate for your RFID reader
serial_port = 'COM3'
baud_rate = 9600

# Database configuration
user_db_host = 'localhost'
user_db_user = 'root'
user_db_password = '123456789'
user_db_database = 'user_registration'

access_db_host = 'localhost'
access_db_user = 'root'
access_db_password = '123456789'
access_db_database = 'accesst'

# Set to keep track of currently entered tags
entries = set()

# Set the variables to keep track of entries in red and green colors
red_entries = 0
green_entries = 0

def process_entry_exit(tag_id):
    global red_entries, green_entries

    # Establish a connection to the user registration database
    user_db_connection = mysql.connector.connect(
        host=user_db_host,
        user=user_db_user,
        password=user_db_password,
        database=user_db_database
    )
    user_db_cursor = user_db_connection.cursor()

    # Check if the tag ID exists in the userdata table
    select_query = "SELECT id FROM userdata WHERE id = %s"
    user_db_cursor.execute(select_query, (tag_id,))
    user_data = user_db_cursor.fetchone()

    # Close the connection to the user registration database
    user_db_cursor.close()
    user_db_connection.close()

    if user_data:
        # Establish a connection to the access database
        access_db_connection = mysql.connector.connect(
            host=access_db_host,
            user=access_db_user,
            password=access_db_password,
            database=access_db_database
        )
        access_db_cursor = access_db_connection.cursor()

        # Initialize entry_time and exit_time variables
        entry_time = None
        exit_time = None

        # Process the entry or exit action based on the RFID tag ID
        if tag_id not in entries:
            # Entry time
            entries.add(tag_id)
            entry_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())

            # Increment the count of entries in red or green color
            entry_time_obj = time.strptime(entry_time, "%Y-%m-%d %H:%M:%S")
            if entry_time_obj.tm_hour == 23 and entry_time_obj.tm_min >= 48:
                red_entries += 1
                entry_color = "red"
            else:
                green_entries += 1
                entry_color = "green"

            # Print the entry time with appropriate text color
            print(f"Entry time: <span style='color: {entry_color}'>{entry_time}</span>")
        else:
            # Exit time
            entries.remove(tag_id)
            exit_time = time.strftime("%Y-%m-%d %H:%M:%S", time.localtime())

            print(f"Tag ID {tag_id} tapped for exit at {exit_time}")

        # Close the connection to the access database
        access_db_cursor.close()
        access_db_connection.close()

        # Calculate the percentages based on the total number of entries
        total_entries = red_entries + green_entries
        red_percentage = (red_entries / total_entries) * 100
        green_percentage = (green_entries / total_entries) * 100

        # Print the percentages
        print(f"Percentage of entries in red color: {red_percentage:.2f}%")
        print(f"Percentage of entries in green color: {green_percentage:.2f}%")

# Establish a serial connection with the RFID reader
rfid_reader = serial.Serial(serial_port, baud_rate)

# Main loop to continuously detect RFID tags
while True:
    # Read the data from the RFID reader
    tag_data = rfid_reader.readline().strip().decode('utf-8')

    # Process the entry or exit action based on the tag ID
    process_entry_exit(tag_data)
