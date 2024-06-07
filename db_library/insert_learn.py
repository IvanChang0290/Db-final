import csv
import numpy as np
import mysql.connector

#print(dir(mysql))


mydb = mysql.connector.connect(user='root', password='police26',
                              host='127.0.0.1',
                              database='db_pokemon')
cursor = mydb.cursor()



with open('learn.csv', newline='',encoding="utf-8") as csvfile:

    csv_data = csv.reader(csvfile)

    i=0
    
    for row in csv_data:

        if i==0 :
            i+=1;
            continue;
        #print(row[0],row[1],row[2],row[5],row[6],row[7],row[11],row[16])

        #list=[row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]]
        #new_data='\',\''.join(list)

        check='select P_ID from Pokemon where Name="' + row[0]+'"'+';'
        cursor.execute(check)

        arr=str(cursor.fetchone())

        if arr=='None':
            continue;

        check2='select S_ID from Skill where Name="' + row[11]+'"'+';'
        check3='select S_ID from Skill where Name="' + row[12]+'"'+';'
        check4='select S_ID from Skill where Name="' + row[13]+'"'+';'

        cursor.execute(check2)
        arr2=cursor.fetchall()

        print(arr2)

        cursor.execute(check3)
        arr3=str(cursor.fetchone())

        cursor.execute(check4)
        arr4=str(cursor.fetchone())

        query='INSERT INTO Learn(P_ID,S_ID) '+'VALUES('
        new_data='"'+arr+'"'+','+'"'+arr2+'"'+')'+','
        new_data2='('+'"'+arr+'"'+','+'"'+arr3+'"'+')'+','
        new_data3='('+'"'+arr+'"'+','+'"'+arr4+'"'
        end=');'

        new_query=query+new_data+new_data2+new_data3+end
        print(new_query)
        i+=1;
        #new_data=np.array([row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]])

        #print(new_data)
        #print(row)

        cursor.execute(new_query)



          
#close the connection to the database.
mydb.commit()
