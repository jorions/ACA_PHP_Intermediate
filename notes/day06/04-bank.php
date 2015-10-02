<?php

class BankAccount {

    /**
     * The name of the person that owns this account
     * @var string
     */
    public $owner;

    /**
     * How much money this person has
     * @var float
     */
    protected $bankBalance;

    /**
     * Add some money to your account
     * @param float $amount How much you want to deposit
     * @return float
     */
    public function deposit($amount) {

        $this->bankBalance += $amount;

        return $this->bankBalance;
    }

    /**
     * Remove some money from your account
     * @param float $amount How much you want to remove
     * @return float
     * @throws Exception
     */
    public function withdraw($amount) {

        if($this->bankBalance < $amount) {

            // An exception is a PHP class that can be extended and worked with in a diverse number of ways
            throw new Exception('You can\'t withdraw ' . $amount);
        }

        $this->bankBalance -= $amount;

        return $this->bankBalance;
    }
}

// Because we have the potential of throwing an exception, all of the code that may throw an exception should be wrapped in a try tag
// The try could be placed in the withdraw function but this is bad design because in more complicated structures you want each method to
// only perform 1 function and route all exceptions through 1 place
try {

    $myAccount = new BankAccount();

    $myAccount->owner = 'Jared';

    $myAccount->deposit(12345);
    $myAccount->withdraw(100000);

} catch (Exception $e) {

    echo 'An error occurred: ' . $e->getMessage();
}

echo '<pre>';
print_r($myAccount);

