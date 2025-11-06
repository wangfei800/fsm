<?php

require_once ('FsmInterface.php');

/*
 * Finite automation machine parameters
 *
 */
class FsmParams
{
    protected $allStates, $allowableInputs, $initialState, $acceptableFinalStates, $transitionFunc;

    /**
     * Five parameters to build FSM
     * @param array $allStates
     * @param array $allowableInputs
     * @param array $initialState
     * @param array $acceptableFinalStates
     * @param callback $transitionFunc
     */
    public function __construct($allStates, $allowableInputs, $initialState,
                                $acceptableFinalStates, $transitionFunc)
    {
        $this->allStates                = $allStates;
        $this->allowableInputs          = $allowableInputs;
        $this->initialState             = $initialState;
        $this->acceptableFinalStates    = $acceptableFinalStates;
        $this->transitionFunc           = $transitionFunc;
    }

    public function getAllStates()
    {
        return $this->allStates;
    }

    public function getAllowableInputs()
    {
        return $this->allowableInputs;
    }

    public function getInitialState()
    {
        return $this->initialState;
    }

    public function getAcceptableFinalStates()
    {
        return $this->acceptableFinalStates;
    }

    public function getTransitionFunc()
    {
        return $this->transitionFunc;
    }

}
