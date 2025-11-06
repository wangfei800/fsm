<?php

require_once ('FsmInterface.php');

/*
 * Finite automation machine, 5-tuple.
 *
 */
class Fsm implements FsmInterface
{
    protected $debug = false;
    protected $allStates, $allowableInputs, $initialState, $acceptableFinalStates, $transitionFunc;

    /**
     * Debug mode will output information
     * @param $debug
     */
    public function setDebug($debug) {
        $this->debug = (bool)$debug;
    }

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
        $this->allStates = $allStates;
        $this->allowableInputs = $allowableInputs;
        $this->initialState = $initialState;
        $this->acceptableFinalStates = $acceptableFinalStates;

        if (!is_callable($transitionFunc)) {
            throw new Exception('transitionFunc should be callable');
        } else {
            $this->transitionFunc = $transitionFunc;
        }
    }

    /**
     * Run the finite automation machine with given input.
     *
     * @param string $inputString
     * @return array
     * @throws Exception
     */
    public function run($inputString): array
    {
        try {
            if (empty($inputString)) {
                throw new Exception('Input cannot be empty');
            }

            $inputArray = str_split($inputString);
            $currentState = $this->initialState;

            foreach ($inputArray as $index => $currentVar) {
                // Check if the var is valid
                if (!in_array($currentVar, $this->allowableInputs)) {
                    throw new Exception("Index: $index, '$currentVar' is not valid.");
                }

                $nextState = call_user_func($this->transitionFunc, $currentState, $currentVar);

                if ($this->debug) {
                    if ($index == 0) {
                        $currentStateDesc = 'Initial state';
                    } else {
                        $currentStateDesc = 'Current State';
                    }
                    echo "$currentStateDesc = $currentState, input = $currentVar, result state = $nextState" . PHP_EOL;
                }

                $currentState = $nextState;
            }

            // After running, check if final states is acceptable
            if (!in_array($currentState, $this->acceptableFinalStates)) {
                return [
                    'status'    => 'error',
                    'state'     => '',
                    'message'   => "Final state: $currentState is wrong",
                ];
            } else {
                return [
                    'status'    => 'success',
                    'state'     => $currentState,
                ];
            }

        } catch (Exception $ex) {
            return [
                'status' => 'error',
                'message' => __METHOD__ . ' ' . $ex->getMessage()
            ];
        }
    }
}
