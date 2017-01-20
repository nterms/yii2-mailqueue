yii2-mailqueue
==============

Email queue component for yii2 that works with [yii2-swiftmailer](http://www.yiiframework.com/doc-2.0/ext-swiftmailer-index.html)


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist nterms/yii2-mailqueue "*"
```

or add

```
"nterms/yii2-mailqueue": "*"
```

to the require section of your `composer.json` file.

 
Configuration
-------------
Once the extension is installed, add following code to your application configuration :

```php
return [
    //....
    'components' => [
        'mailqueue' => [
            'class' => 'nterms\mailqueue\MailQueue',
			'table' => '{{%mail_queue}}',
			'mailsPerRound' => 10,
			'maxAttempts' => 3,
        ],
    ],
];
```

Following properties are available for customizing the mail queue behavior.

- `table`: Name of the database table to store emails added to the queue.
- `mailsPerRound`: Number of emails to send at a time.
- `maxAttempts`: Maximum number of sending attempts per email.


Updating database schema
------------------------

Apply the database migration to create the table required to store the mail queue messages. To do this, 
add following code to `/config/console.php`:

```php
return [
    //....
    'components' => [
        'mailqueue' => [
            'class' => 'nterms\mailqueue\MailQueue',
			'table' => '{{%mail_queue}}',
        ],
    ],
];
```

then run `yii migrate` command in command line:

```
php yii migrate/up --migrationPath=@vendor/nterms/yii2-mailqueue/migrations/
```

Processing the mail queue
-------------------------

Now calling `process()` on `Yii::$app->mailqueue` will process the message queue and send out the emails. 
In one of your controller actions:

```php

public function actionSend()
{
	Yii::$app->mailqueue->process();
}

```

Most preferably this could be a console command (eg: mail/send) which can be triggered by a CRON job.


Setting the CRON job
--------------------

Set a CRON job to run console command:

```

*/10 * * * * php /var/www/html/myapp/yii mailqueue/process

```


Usage
-----

You can then send an email to the queue as follows:

```php
Yii::$app->mailqueue->compose('contact/html')
     ->setFrom('from@domain.com')
     ->setTo($form->email)
     ->setSubject($form->subject)
     ->setTextBody($form->body)
     ->queue();
```

While `nterms\mailqueue\MailQueue` extends from `yii\swiftmailer\Mailer`, you can replace it with this extension by adding 
`yii2-swiftmailer` configuations directly to `mailqueue` configurations as follows:

```php
return [
    //....
    'components' => [
        'mailqueue' => [
            'class' => 'nterms\mailqueue\MailQueue',
			'table' => '{{%mail_queue}}',
			'mailsPerRound' => 10,
			'maxAttempts' => 3,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => 'localhost',
				'username' => 'username',
				'password' => 'password',
				'port' => '587',
				'encryption' => 'tls',
			],
        ],
    ],
];
```

And use following code for directly sending emails as you ususally do with `yii2-swiftmailer`:

```php
Yii::$app->mailqueue->compose('contact/html')
     ->setFrom('from@domain.com')
     ->setTo($form->email)
     ->setSubject($form->subject)
     ->setTextBody($form->body)
     ->send();
```

License
-------

[MIT](LICENSE)
