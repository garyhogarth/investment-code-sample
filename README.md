# Investment code sample
A simple set of classes to fulfil an investment based code test

In a real environment this may be too verbose, however for the point of demonstration I have completed it. 

## Conditions
- Each of our loans has a start date and an end date.
- Each loan is split in multiple tranches.
- Each tranche has a different monthly interest percentage.
- Also each tranche has a maximum amount available to invest. So once the maximum is reached, further investments can't be made in that tranche.
- As an investor, I can invest in a tranche at any time if the loan it’s still open, the maximum available amount was not reached and I have enough money in my virtual wallet.
- At the end of the month we need to calculate the interest each investor is due to be paid. 

### To Use
```php
@todo
```


### Testing
PHP Unit can be installed via composer just run, I have included composer.phar for simplicity

```
php composer.phar install
```

from the root directory of the project.

You can then run

```
vendor/bin/phpunit --colors tests
```

Alternatively you can use a locally installed version of PHP Unit
