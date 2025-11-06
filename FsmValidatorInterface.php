<?php

require_once('FsmParams.php');

/*
 * Fsm validator interface
 *
 */
Interface FsmValidatorInterface
{
    public function validate(FsmParams $fsmParams): bool;
    public function getError(): string;
}
