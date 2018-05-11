#present
#Script for linking with db and send sms and mail.
#header files
import time
import mysql.connector as mariadb
import smtplib


#establishing connection between script and python.!
mariadb_connection = mariadb.connect(user='root', password='rameena123', database='test');


#creating objects
cursor = mariadb_connection.cursor();
cu = mariadb_connection.cursor();


#testing queries & printing the whole table
cursor.execute("SELECT * FROM messages");
while True:
    mes = cursor.fetchone()
    if mes is not None:
        message = "\n"+str(mes[0])
    else:
        break;
col=cursor.column_names

#query for finding the age and saving it as "Age" and selecting the rows with the bday and 18..!!
cu.execute("SELECT email FROM emails"); #s
sender = "sih.atomises@gmail.com"
try:
    session = smtplib.SMTP('smtp.gmail.com', 587)
    session.ehlo()
    session.starttls()
    print("Its getting printed");
    session.ehlo()
    session.login(sender, 'sihatomises@123')
    while True:
            data1 = cu.fetchone()
            if data1 is not None:
            # Filtering and sending the mail
                print(message)
                session.sendmail(sender, data1, message)
            else:
                print("entered");
                break;
    session.quit()
except smtplib.SMTPException:
    print('Error')




