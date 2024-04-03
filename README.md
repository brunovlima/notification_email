# Email Notification Library using phpMailer
This library is designed to send emails using the phpMailer library. Executing this action in an uncomplicated manner is essential for any system.

To install the library, run the following command:

```sh
composer require brunovlima/notification_email
```

To use the library, simply require the composer’s autoload, invoke the class, and call the method:

```sh
<?php

require __DIR__ . '/lib_notif_ext/autoload.php';

USE Notification\Email;

$email = new Email(2, "mail.host.com", "your@email.com", "your-pass", "smtp secure (tls/ssl)", "port (587)",
    "from@email.com", "From Name");

$email->sendEmail("Subject", "Content", "reply@email.com", "Replay Name", "address@email.com", "Address Name");
```

Note that the entire email sending configuration is using the magic constructor method! Once the constructor method is invoked within your application, your system will be ready to perform the dispatches.


### Developers
* [Bruno Vieira] - Desenvolvedor desta biblioteca e Programador Laravel, PHP, Python, Angular, Flask, JavaScript, Html, Css, Sass
* [phpMailer] - bruno.lima80@fatec.sp.gov.br or brunoglobalnegocios@gmail.com

License
----

MIT
**Faça bom uso!**
[//]:#
[Bruno Vieira]: <mailto:brunoglobalnegocios@gmail.com>
[phpMailer]: <https://github.com/brunovlima/notification_email>
[linkedin]: <https://www.linkedin.com/in/li2/>