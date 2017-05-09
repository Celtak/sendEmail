# sendEmail
A php class to send an email with a message in **HTML**

![](https://img15.hostingpics.net/pics/216143dessinmin.png)

## Getting Started

### Installing

Download and move the sendEmail.class.php file to your working directory.

Include it.

```php
<?php require "sendEmail.class.php"; ?>
```

### Create object

Instantiate a new object with the sendEmail class to include a boolean. True if the sender is the same as the reply or false if they are different.

```php
<?php $contact = new sendEmail(true); ?>
```

## Methods list

| Method    | Syntax    | Information |
| --------- | --------- | ------------ |
| Set the Sender | set_sender ( name, address ) | |
| Set the Reply | set_reply ( name, address ) | Optional: required only if it was instantiate with false|
| Set the Subject | set_subject ( subject ) | |
| Set the Message | set_msg ( message ) | In **HTML** |
| Send the Email | send ( address ) | Required to send email but before use the methods: set_sender, set_reply (optional), set_subject, set_msg| 

## Usage

### Send a email

#### The sender and the reply are the same

```php
<?php

  $contact->set_sender('john','john@gmail.com');
  $contact->set_subject('My news');
  $contact->set_msg('<h1>Hello, it\'s me!</h1><p>How are you?</p><p>I am happy to tell you that I am fine.</p>');
  
  // The email is ready now send it
  
  $contact->send('myfriend@hotmail.fr');
  
?>
```

#### The sender and the reply are not the same

```php
<?php 

  $contact->set_sender('Joe','joe@gmail.com');
  $contact->set_sender('Joe','jeo@hotmail.com'); // When someone to reply, he will send a message to joe@hotmail.com and not to joe@gmail.com.
  $contact->set_subject('My news');
  $contact->set_msg('<h1>Hello, it\'s me!</h1><p>How are you?</p><p>I am happy to tell you that I am fine.</p>');
  
  // The email is ready now send it
  
  $contact->send('myfriend@hotmail.fr');
  
?>
```

#### Another way

```php
<?php 

  // Open and save the contents of the file
  $my_message = file_get_contents('doc/mymessage.html');
  
  // Prepare the email
  $contact->set_sender('john','john@gmail.com');
  $contact->set_subject('My news');
  $contact->set_msg($my_message);
  
  // The email is ready now send it
  $contact->send('myfriend@hotmail.fr');
  
?>
```





