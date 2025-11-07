# Finate State Machine

PHP Version 8.x\
You need to install composer if you want to run Unit Test.\
https://getcomposer.org/doc/00-intro.md

## Finite Automation
**A** finite automaton (FA) is a 5-tuple (Q,Σ,q0,F,δ) where,\
**Q** is a finite set of states;\
**Σ** is a finite input alphabet;\
**q0 ∈ Q** is the initial state;\
**F ⊆ Q** is the set of accepting/final states; and\
**δ:Q×Σ→Q** is the transition function.

## To run unit tests:
### Install phpunit library
Run command: composer install
### Run tests
Run command: ./vendor/bin/phpunit ./UnitTestFsm.php
### To display detailed test result
Run command: ./vendor/bin/phpunit --debug ./UnitTestFsm.php

## To run the test:
Run command: php TestFsm.php