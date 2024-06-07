import csv
import numpy as np
import mysql.connector

#print(dir(mysql))


mydb = mysql.connector.connect(user='root', password='police26',
                              host='127.0.0.1',
                              database='db_pokemon')
cursor = mydb.cursor()



with open('moves.csv', newline='',encoding="utf-8") as csvfile:

    csv_data = csv.reader(csvfile)

    i=0
    
    for row in csv_data:

        if i==0 :
            i+=1;
            continue;
        #print(row[0],row[1],row[2],row[5],row[6],row[7],row[11],row[16])

        #list=[row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]]
        #new_data='\',\''.join(list)

        count=str(i)
        query='INSERT INTO Skill(S_ID,Name,Type,damage) '+'VALUES('
        new_data='"'+count+'"'+','+'"'+row[0]+'"'+','+'"'+row[1]+'"'+','+'"'+row[3]+'"'
        end=');'

        new_query=query+new_data+end
        #print(new_query)
        i+=1;
        #new_data=np.array([row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]])

        #print(new_data)
        #print(row)

        cursor.execute(new_query)



          
#close the connection to the database.
mydb.commit()
