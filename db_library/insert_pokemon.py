import csv
import numpy as np
import mysql.connector

#print(dir(mysql))


mydb = mysql.connector.connect(user='root', password='123456789',
                              host='127.0.0.1',
                              database='db_poke')
cursor = mydb.cursor()

with open('pokemons_evo.csv', newline='',encoding="utf-8") as csvfile:
    csv_data = csv.reader(csvfile)
    next(csv_data) # skip first row
    id_to_info = {info[0]: info[17] for info in csv_data if int(info[0]) <= 721}


with open('pokemon_alopez247.csv', newline='',encoding="utf-8") as csvfile:

    csv_data = csv.reader(csvfile)

    i=0
    
    for row in csv_data:

        if i==0 :
            i+=1
            continue
        #print(row[0],row[1],row[2],row[5],row[6],row[7],row[11],row[16])

        #list=[row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]]
        #new_data='\',\''.join(list)

        query='INSERT INTO Pokemon(P_ID,Name,info,Type,R_ID,HP,ATK,DEF) '+'VALUES('
        new_data='"'+row[0]+'"'+','+'"'+row[1]+'"'+','+'"'+id_to_info[row[0]]+'"'+','+'"'+row[16]+'"'+','+'"'+row[11]+'"'+','+'"'+row[5]+'"'+','+'"'+row[6]+'"'+','+'"'+row[7]+'"'
        end=');'

        new_query=query+new_data+end
        print(new_query)
        #new_data=np.array([row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]])

        #print(new_data)
        #print(row)

        cursor.execute(new_query)



          
#close the connection to the database.
mydb.commit()

