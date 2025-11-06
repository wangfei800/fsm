<?php

require_once('FsmValidatorInterface.php');
require_once('FsmParams.php');

/*
 * Fsm validator
 *
 */
class FsmValidator implements FsmValidatorInterface
{
    protected $errorMessage = [];

    /**
     * Run the finite automation machine with given input.
     *
     * @param string $inputString
     * @return true or error message string
     * @throws Exception
     */
    public function validate(FsmParams $fsmParams): bool
    {
        try {
            $errorMessage = [];

            // limited validation here
            if (!is_array($fsmParams->getAllStates())) {
                $this->errorMessage[] = 'All states must be array';
            }

            if (!is_callable($fsmParams->getTransitionFunc())) {
                throw new Exception('transitionFunc should be callable');
            }

            if (count($this->errorMessage)) {
                return false;
            } else {
                return true;
            }
        } catch (Exception $ex) {
            $this->errorMessage[] = $ex->getMessage();
            return false;
        }
    }

    public function getError(): string
    {
        return implode('|', $this->errorMessage);
    }
}
