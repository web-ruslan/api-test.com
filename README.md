# api-test.com
1. Please create a simple REST API service with one single method

The method should perform a fake logging of money transactions and return transaction status.
The transaction status should be generated randomly (“rejected” or “approved”).
If it’s not rejected the method should return your random transaction ID and the status.
When it’s rejected the method should return error message with the status.
Please feel free to add more options or more data. 
The main thing – it must be well organized, readable and should work fast.
Your API must have very simple authentication and return data in JSON format only. 

Syntax:
POST /transaction/{email}/{amount}/

Email – user email, amount – sum of transaction (money). 
Those two parameters are must have and must be properly validated.
You shouldn't use a database for it, but sure you can do it if you want (please review item 3 for it).

Example:
Input: POST /transaction/a@a.com/241221.30/
Output: JSON 
{
  "status": "rejected",
  "error_message": "Fraud detected!"
}
