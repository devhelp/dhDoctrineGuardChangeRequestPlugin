Installation
------------

1. Download the plugin
2. unzip and rename the the directory to 'dhDoctrineGuardChangeRequestPlugin'
3. copy the directory to plugins folder in your Symfony project
4. Update setup() method in ProjectConfiguration class with the line below

    <pre><code>$this->enablePlugins('dhDoctrineGuardChangeRequestPlugin');</code></pre>

5. enable modules you want to use in settings.yml

    <pre>
    <code>
    all:
      .settings:
        enabled_modules: [ default, dhChangeRequest, dhConfirmChange ]
    </code>
    </pre>

6. clear cache

    <pre><code>php symfony c</code></pre>

Requirements
---------------
Plugin requires sfDoctrineGuardPlugin in order to work

Features
----------------
- after changing email address email is sent to user's new email address with unique url to confirm the change 
- after changing password email is sent to user's email address with unique url to confirm the change
- each url has expiration date so it won't be valid forever
- highly configureable
- (almost) straighforward ajax support for plugin's forms

Usage
----------
Plugin configuration let you use it straightforwad after the installation with minimum effort from your side.

Default plugin's app.yml allows you to configure majority of aspects related with the plugin
so that you will rarely have to overwrite its actions to match your needs (if at all!)

You have to configure Symfony mailer for sending emails with change confirmations

Check app.yml file in config directory for information about supported configuration