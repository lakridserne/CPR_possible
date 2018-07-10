# This is a simple version of cpr_generator.php used to teach kids in Coding
# Pirates how this works. It just validates the CPR number instead of generating a list

cpr_num = "2812930081"
gender = "boy"

# multiply by control chiffers
multiplied = []
control_numbers = [4,3,2,7,6,5,4,3,2]
i = 0
for cpr in cpr_num:
    if i < 9:
        multiplied.append(int(cpr) * control_numbers[i])
        i = i + 1

sum_cpr = sum(multiplied)
rest = sum_cpr % 11
last_num = 11-rest
if int(last_num) == int(cpr_num[9]):
    if int(last_num % 2 == 0) and gender == "girl":
        print("CPR " + cpr_num + " is valid")
    elif int(last_num % 2 != 0) and gender == "boy":
        print("CPR " + cpr_num + " is valid")
else:
    print("CPR " + cpr_num + " is not valid")
