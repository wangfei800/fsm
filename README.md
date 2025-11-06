# Finate State Machine

PHP Version 8.x

## Finite Automation
**A** finite automaton (FA) is a 5-tuple (Q,Σ,q0,F,δ) where,\
**Q** is a finite set of states;\
**Σ** is a finite input alphabet;\
**q0 ∈ Q** is the initial state;\
**F ⊆ Q** is the set of accepting/final states; and\
**δ:Q×Σ→Q** is the transition function.

##To run unit tests:
Run command: composer install\
then: ./vendor/bin/phpunit ./UnitTestFsm.php

##To run the test:
php TestFsm.php