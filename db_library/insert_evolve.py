import csv
import numpy as np
import mysql.connector

#print(dir(mysql))


mydb = mysql.connector.connect(user='root', password='police26',
                              host='127.0.0.1',
                              database='db_pokemon')
cursor = mydb.cursor()

debug = 0


with open('pokemons_evo.csv', newline='',encoding="utf-8") as csvfile:
    csv_data = csv.reader(csvfile)
    next(csv_data) 
    name_to_id = {row[1]: row[0] for row in csv_data if int(row[0]) <= 721}


with open('pokemons_evo.csv', newline='',encoding="utf-8") as csvfile:
    csv_data = csv.reader(csvfile)
    next(csv_data) 

    for row in csv_data:

        if int(row[0])>721:
            break


        if row[4]!="nothing":
            evolved_from = row[4]

            if evolved_from in name_to_id:
                original_id = name_to_id[evolved_from]

                if debug ==1:
                    print(row[0],row[1], evolved_from, original_id)

                query='INSERT INTO Evolve(Evo_P_ID,Ori_P_ID) '+'VALUES('
                new_data='"'+str(row[0])+'"'+','+'"'+str(original_id)+'"'
                end=');'
                new_query=query+new_data+end

                if debug ==1:
                    print(new_query)
                # cursor.execute(new_query)


#close the connection to the database.
mydb.commit()

