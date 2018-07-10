cpr_nummer = "1111111118"
gender = "boy"
tal = [4,3,2,7,6,5,4,3,2]
ganget = []
i = 0

for cpr in cpr_nummer:
    if i < 9:
        ganget.append(int(cpr) * tal[i])
        i = i + 1

summeret = sum(ganget)
rest = summeret % 11
sidste_ciffer = 11-rest

if cpr_nummer[9] == sidste_ciffer:
    if gender == "boy" and sidste_ciffer % 2 != 0:
        print("Det var et rigtigt CPR nummer " + cpr_nummer)
    elif gender == "girl" and sidste_ciffer % 2 == 0:
        print("Det var et rigtigt CPR nummer " + cpr_nummer)
elif cpr_nummer[9] != sidste_ciffer:
    print("Det er et forkert CPR nummer " + cpr_nummer)
