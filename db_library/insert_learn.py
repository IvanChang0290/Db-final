import csv
import numpy as np
import mysql.connector
import re

#print(dir(mysql))


mydb = mysql.connector.connect(user='root', password='123456789',
                              host='127.0.0.1',
                              database='db_poke')
cursor = mydb.cursor()



with open('learn.csv', newline='',encoding="utf-8") as csvfile:

    csv_data = csv.reader(csvfile)

    i=0
    count=0
    
    for row in csv_data:

        if i==0 :
            i+=1
            continue
        #print(row[0],row[1],row[2],row[5],row[6],row[7],row[11],row[16])

        #list=[row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]]
        #new_data='\',\''.join(list)

        check='select P_ID from Pokemon where Name="' + row[0]+'"'+';'
        cursor.execute(check)

        a=str(cursor.fetchone())

        if a=='None':
            continue
        
        number = [int(number) for number in re.findall(r'-?\d+\.?\d*', a)]

        if count!=0 & number[0]==171:
            continue

        if number[0]==171:
            count+=1

        arr=str(number[0])

        check2='select S_ID from Skill where Name="' + row[11]+'"'+';'
        check3='select S_ID from Skill where Name="' + row[12]+'"'+';'
        check4='select S_ID from Skill where Name="' + row[13]+'"'+';'

        cursor.execute(check2)
        a2=str(cursor.fetchone())

        number2 = [int(number2) for number2 in re.findall(r'-?\d+\.?\d*', a2)]
        arr2=str(number2[0])

        cursor.execute(check3)
        a3=str(cursor.fetchone())

        number3 = [int(number3) for number3 in re.findall(r'-?\d+\.?\d*', a3)]
        arr3=str(number3[0])

        cursor.execute(check4)
        a4=str(cursor.fetchone())

        if a4=='None':
            arr4=a4
        else:
            number4 = [int(number4) for number4 in re.findall(r'-?\d+\.?\d*', a4)]
            arr4=str(number4[0])

    
        query='INSERT INTO Have(B_ID,P_ID,S_ID) '+'VALUES('
        new_data='"'+'0'+'"'+','+'"'+arr+'"'+','+'"'+arr2+'"'+')'+','
        new_data2='('+'"'+'0'+'"'+','+'"'+arr+'"'+','+'"'+arr3+'"'+')'+','
        if arr4 != "None":
            new_data3='('+'"'+'0'+'"'+','+'"'+arr+'"'+','+'"'+arr4+'"'
            end=');'

        new_query=query+new_data+new_data2+new_data3+end
        print(new_query)
        i+=1
        #new_data=np.array([row[0],row[1],row[5],row[16],row[11],row[5],row[6],row[7]])

        #print(new_data)
        #print(row)

        cursor.execute(new_query)



          
#close the connection to the database.
mydb.commit()
