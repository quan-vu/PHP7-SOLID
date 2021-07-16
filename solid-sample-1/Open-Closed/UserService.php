<?php

/**
 * OCP - Open/ Closed principle example
 */

interface ValidatorInterface {
    public function isValid(string $name): bool;
}

class UserServiceValidatorV1 implements ValidatorInterface {
    
    public function isValid(string $name): bool {
        return strlen($name) > 2;
    }
}

class UserServiceValidatorV2 implements ValidatorInterface {
    
    public function isValid(string $name): bool {
        return strlen($name) > 2;
    }
}

class UserService {

    private $validator;

    public function __construct(
        ValidatorInterface $validator   // Injection UserServiceValidatorV1
    ){
        $this->validator = $validator;
    }

    public function save(string $name): void 
    {
        // Call isValid method
        if ($this->validator->isValid($name)) {
            echo "Saved data.\n";
        } else {
            echo "Data is in valid!\n";
        }
    }
}

// Demo user validator v1
$userService = new UserService(new UserServiceValidatorV1);
$userService->save('An');

// Demo user validator v2
$userService = new UserService(new UserServiceValidatorV2);
$userService->save('Anh');


