import mysql.connector


conn = mysql.connector.connect(
   user='root', password='', host='127.0.0.1', database='neps_database')

#Creating a cursor object using the cursor() method
cursor = conn.cursor()

#Retrieving single row
sql = '''SELECT user_interest from users WHERE status='Online' '''

#Executing the query
cursor.execute(sql)

#Fetching 1st row from the table


#Fetching 1st row from the table
results = cursor.fetchall();

for row in results :

    print(row[0])



def dbcon():

   
    return 0

 


#Closing the connection


