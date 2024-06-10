import csv
import numpy as np
import mysql.connector

#print(dir(mysql))


mydb = mysql.connector.connect(user='root', password='123456789',
                              host='127.0.0.1',
                              database='db_poke')
cursor = mydb.cursor()

debug = 0


with open('pokemon_alopez247.csv', newline='',encoding="utf-8") as csvfile:
    csv_data = csv.reader(csvfile)
    next(csv_data)
    
    for row in csv_data:

        query='INSERT INTO Pokemon_type(P_ID,type) '+'VALUES('
        new_data='"'+str(row[0])+'"'+','+'"'+str(row[2])+'"'
        end=');'

        new_query=query+new_data+end

        if debug:
            print(row[0],row[2],row[3])

        if debug:
            print(new_query)

        cursor.execute(new_query)

        if row[3] != '':
            query='INSERT INTO Pokemon_type(P_ID,type) '+'VALUES('
            new_data='"'+str(row[0])+'"'+','+'"'+str(row[3])+'"'
            end=');'

            new_query=query+new_data+end

            if debug:
                print(new_query)

            cursor.execute(new_query)




          
#close the connection to the database.
mydb.commit()

