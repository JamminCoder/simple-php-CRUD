# simple-php-CRUD
A small, ugly yet functional blog application to demonstrate CRUD functionality in PHP.  

## Requirments
If you want to play around with the app, you need PHP 7 and MySQL 8 installed. 

Download the folder, and configure a local webserver to host the files (that process will vary based on OS).
Then go into `classes/dbh.classes.php` and change `$dbUsername` to the username you are going to use in the database, and  
change `$dbPassword` to the database user's password.  You can keep `$dbHost` and `$dbName` the same, unless you configure your database differently than what I am about to show... 

## Configuring Your Database:
1. Create a database for your blog:  

```sql
mysql> CREATE DATABASE blog_database;
```  

2. Create the `accounts` table:  
```sql
mysql> CREATE TABLE accounts (
  username VARCHAR(25) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  user_id VARCHAR(100) NOT NULL
);
```

3. Create the `posts` table:  
```sql
mysql> CREATE TABLE posts (
  post_title VARCHAR(100) NOT NULL,
  post_body TEXT NOT NULL,
  post_author VARCHAR(25) NOT NULL,
  post_id VARCHAR(100) NOT NULL
);
```  
4. Make sure your database user has `CREATE`, `UPDATE`, `DELETE`, `INSERT`, and `SELECT` permisions on `blog_database`:  
```sql
mysql> GRANT SELECT, INSERT, UPDATE, DELETE, CREATE ON 'blog_database'.* TO '<DB_USERNAME>'@'localhost';
```  
Just replace `<DB_USERNAME>` with the user that will be using `blog_database`. If you're using a database outside of your computer, then you will need yo replace `localhost` with the appropriate address.
