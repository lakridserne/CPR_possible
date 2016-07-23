# CPR_possible
Small project where I generate Danish CPR numbers.

This can be tried here: https://www.rathhansen.com/cpr_generator.php

Introduction to CPR
===================
Danish readers will also benefit from this section since it contains some extra information about CPR.

In Denmark we have a system called CPR. This is equalant to the American Social Security Number -
i.e. a number that's used to uniquely identify you.

It has also been widely used for authentication - and still is in some cases (though most places do check
more things now, luckily.

It should NOT be used for authentication - it's simply too easy to figure out a CPR number. (But do still keep the last 4 digits secret
if you have a CPR number - it is still used for identifying and authenticating you in some places unfortunately).

CPR numbers is built up of the birthday (the first 6 numbers in the firmat dd-mm-yyyy).

The next number is determined by what year you was born. For a range of years there is a range of numbers that can be assigned.

The next 2 numbers is random number between 0 and 9.

The last number is a control number. This is done by modulus 11. Furthermore it also tells you what gender the person has.

An uneven number is a boy, and an even number is a girl.

Thanks to http://kode.porten.dk/cpr_fix/ which have been a good guide for me.

This was a small, fun project to make.

Please note that you can also get numbers that's not necessarily in this output due to them using another formula, however they first use modulus 11. If they then have more births that day, then they use the other formula.
