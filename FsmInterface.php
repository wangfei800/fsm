<?php

/*
 * Interface for FSM
 *
 */
interface FsmInterface
{

    /**
     * Debug mode will output information
     * @param $debug
     */
    public function setDebug(bool $debug);

    /**
     * Five parameters to build FSM
     * @param array $allStates
     * @param array $allowableInputs
     * @param array $initialState
     * @param array $acceptableFinalStates
     * @param callback $transitionFunc
     */
    public function __construct($allStates, $allowableInputs, $initialState, $acceptableFinalStates, $transitionFunc);

    /**
     * Run the finite automation machine with given input.
     *
     * @param string $inputString
     * @return array
     * @throws Exception
     */
    public function run($inputString): array;
}
