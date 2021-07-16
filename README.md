# PHP7-SOLID

Implement S.O.L.I.D - 5 Principles of Object-Oriented Design

## Introduction to SOLID

S.O.L.I.D As A Rock

Your code adheres to the first 5 principles.

*Mã của bạn nên tuân thủ 5 nguyên tắc đầu tiên.*

Making sure your code easy to read and to write.


### 1. Single Responsibility Principle (SRP)

> A class should have only one reason to change.

Controller class ia an example for this. When have some reason to change that just is the logic.

Controller should be talk to other service to do specify logic such as: email, datatabse.

**UserRegistration: version 1**

```php
class UserRegistration {

    public function __construct (
        Mysql $mysql,
        Email $email
    ){
        $this->mysql = $mysql;
        $this->email = $email;        
    }

    public function register(User $user)
    {
        // save in database
        $this->mysql->query("INSERT INTO users ...");

        // send notification to user
        $this->email
            ->to($user->email)
            ->subject("Welcome")
            ->send();
    }
}
```

**UserRegistration: version 2**

```php
class UserRegistration {

    public function __construct (
        UserRegistrationStorage $storage,
        UserRegistrationWelcomeEmail $welcomeEmail
    ){
        $this->storage = $storage;
        $this->welcomeEmail = $welcomeEmail;        
    }

    public function register(User $user)
    {
        // save in database
        $this->storage->save($user);

        // send notification to user
        $this->welcomeEmail->email($user);
    }
}
```

## 2. Open/Close Principle (OCP)

> Software entities ... should be open for extension, but closed for modification.

# Closed for modification

That is we need to change the behavior of a class without editing its source code.

Closed for modification does not mean we should never ever change source code. 

### Open for extension

- Open for extension mean inherritance.

PHP have a final keyword, when we use final for a function nobody can extend that class, you can not subclass it.


Example 1:

```php
// Single responsibility is to perform those behaviors
interface Swimming  { public function swim(); }
interface Quacking  { public function quacking(); }
interface Flying    { public function flying(); }

class Quacking implements Quacking {
    public function quack() { /** quack like a real duck */ }
}

class MuteDuck implements Quacking {
    public function quack() { /** do nothing */ }
}

class SpeakingDuck implements Quacking {
    public function quack() { /** speak like a rubber duck */ }
}

// Eider Duck
class EiderDuck {
    
    function __construct(
        Swimming $swimming,
        Quacking $quacking,
        Flying $flying
    ){
        $this->swimming = $swimming;
        $this->quacking = $quacking;
        $this->flying = $flying;
    }
    
    public function swim() {
        $this->swimming->swim();
    }

    public function quack() {
        $this->quacking->quack();
    }

    public function fly() {
        $this->flying->fly();
    }
}


// Apply: We want to change quack sound withou change source code
// We extension it like this

class Oooooh implements Quiacking {
    public function quack() {
        /** make an awesome oooh noiselike an eiderduck */
    }
}

// we inject interface it use Strategy Pattern
new EdierDuck(new Swimming, new Oooooh, new Flying)
```

### Decorator Pattern

A way to implement extension.

Decorator examples

- Integrate an application with an API
- API uses OAuth2 for auth
- Have to send a valid OAuth2 tokan with each API call
- Token a valid for 49 hours

```php
interface AccessTokenRepository {
    public function get(): AccessToken;
}

class ApiRepository implements AccessTokenRepository {
    function __construct(Provider $provider) {
        $this->provider = $provider;
    }

    public function get(): AccessToken {
        return $this->provider->getAccessToken();
    }
}
```

### Observer Pattern

Another way to implement extension.

## 3. Liskov Substitution Pronciple (LSP)

> Object in a program should be replaceable with instances of their subtypes without altering the correctness of that program.
> If S is a subtype of T, then objects of type T in a program may be replaced with objects of type S without altering any of the desirable properties of that program.

- Design by contract

### Behaviror, Behaviror, Behaviror


Search filter Example

- App contains pages wuth lists of "things".
- We had to include various search options on each list.
- Options types includes dropdowns, free text , date ranges, ..etc

```php
interface Filter {
    /**
     * @param \Cake\Network\Request $request
     * @param \Cake\ORM\Query       $query
    */
    public function buildQueryFfrom(Request $request, Query $query) {};
}
```

## 4. Dependnce Injecion