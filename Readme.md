# Insly Project API

![Insly logo](https://i.imgur.com/0178v4J.png)

## Task 1 - Calculator

Write a simple car insurance calculator which will output price of the policy using vanilla PHP and ReactJS or VueJS.

1. Create a form with following fields:

   - a. Estimated value of the car.

     - i. Minimum value 100 EUR
     - ii. Maximum value 100000 EUR

   - b. Tax percentage

     - i. From range 0 – 100 %

   - c. Number of policy installments – count of payments in which the client wants to pay for the policy

     - i. From range 1 – 12

   - d. Calculation button

2. Build a calculator logic in PHP using OOP, following good practices and try to use design patterns.

   - a. Base price of policy is 11% from entered car value, except every Friday 15-20 o’clock (user time) when it is 13%

   - b. Commission is added to base price (17%)

   - c. Tax is added to base price (user entered)

   - d. Calculate different payments separately (if number of payments are larger than 1)

   - e. Installment sums must match total policy sum

   - f. Output is rounded to two decimal places

3. Output a table with the result as a Modal. When clicking on the background then the modal should close.

![Table example](https://i.imgur.com/yfwXd5y.png)

## Task 2 – SQL

1. Create a database structure to store employee information. The information stored is as follows:

   - Name
   - Birthdate
   - ID code / SSN
   - Is a current employee (yes/no)
   - Contact information (e-mail, phone, address)

   - The following information in English, Spanish and French:
     - Introduction
     - Previous work experience
     - Education information

   - Log info:
     - Who and when created the entry
     - Who and when last modified the data

2. The information should be presented as an .sql file which can be imported into a database without errors.
3. Write example query to get 1-person data in all languages
4. Add test data for one customer into database
