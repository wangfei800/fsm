<?php

/*
 * Finite automation machine generator
 *
 */
class FsmGenerator
{
    public function __construct()
    {
        // placeholder
    }

    /**
     * Run the finite automation machine with given input.
     *
     * @param string $inputString
     * @return array
     * @throws Exception
     */
    public function generateFsm($allStates, $allowableInputs, $initialState,
                                $finalStates, $transitionFunc)
    {
        try {
            $fsm = new Fsm($allStates, $allowableInputs, $initialState,
                $finalStates, $transitionFunc);

            return $fsm;

        } catch (Exception $ex) {
            return [
                'status' => 'error',
                'message' => __FUNCTION__ . ' ' . $ex->getMessage()
            ];
        }
    }
}
