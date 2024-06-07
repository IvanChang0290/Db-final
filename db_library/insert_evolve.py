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
    next(csv_data) # skip first row
    name_to_id = {row[1]: row[0] for row in csv_data if int(row[0]) <= 721}


with open('pokemons_evo.csv', newline='',encoding="utf-8") as csvfile:
    csv_data = csv.reader(csvfile)
    next(csv_data) # skip first row

    for row in csv_data:

        if int(row[0])>721: # match limit
            break


        if row[4]!="nothing": # if have evolve
            evolved_from = row[4]

            if evolved_from in name_to_id:
                original_id = name_to_id[evolved_from]

                if debug:
                    print(row[0],row[1],original_id ,evolved_from ) #(evolve_id , evolve name , original_id , original name)

                query='INSERT INTO Evolve(Evo_P_ID,Ori_P_ID) '+'VALUES('
                new_data='"'+str(row[0])+'"'+','+'"'+str(original_id)+'"'
                end=');'
                new_query=query+new_data+end

                if debug:
                    print(new_query)
                # cursor.execute(new_query)


mydb.commit()

