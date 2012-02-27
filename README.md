Installation
------------

1. Download the plugin
2. unzip and rename the the directory to 'dhDoctrineGuardChangeRequestPlugin'
3. copy the directory to plugins folder in your Symfony project
4. Update setup() method in ProjectConfiguration class with the line below

    $this->enablePlugins('dhDoctrineGuardChangeRequestPlugin');

5. clear cache

    ./symfony c


!mandatory in order to change password!

add this method to sfGuardUser

public function setHashedPassword($hashed_password)
{
    $this->_set('password', $hashed_password);
}
