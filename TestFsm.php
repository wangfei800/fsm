<?php

/**
 * Mod Three FSM testing
 * To run this, php testFa.php
 */
require_once('FsmGenerator.php');

/**
 * Transition function, used for states transition.
 *
 * @staticvar array $transitionMatrix
 * @param string $state
 * @param string $var
 *
 * @return string new state
 * @throws Exception
 */
function transitionFunc($state, $var)
{
    static $transitionMatrix = [
        'S0' => [
            0 => 'S0',
            1 => 'S1',
        ],
        'S1' => [
            0 => 'S2',
            1 => 'S0',
        ],
        'S2' => [
            0 => 'S1',
            1 => 'S2',
        ],

    ];

    if (!isset($transitionMatrix[$state][$var])) {
        throw new Exception("Cannot transition from state: $state on: $var");
    } else {
        return $transitionMatrix[$state][$var];
    }
};

/**
 * Test fa for given input and initial state.
 *
 * @param string $input
 * @param string $initialState
 * @param boolean $debug
 *
 * @return string
 */
function testModThreeFsm() {

    $States         = ['S0', 'S1', 'S2'];
    $inputSet       = [0, 1];
    $finalStates    = ['S0', 'S1', 'S2'];
    $initialState   = 'S0';
    $fsmGenerator   = new FsmGenerator();
    $fsmParams      = new FsmParams($States, $inputSet, $initialState, $finalStates, 'transitionFunc');
    $fsm            = $fsmGenerator->generateFsm($fsmParams);

    if ($fsm instanceof FsmInterface) {
        $fsm->setDebug(true);
        $result = $fsm->run('1010');
        return $result;
    } else {
        return $fsmGenerator->getError();
    }
}

$result = testModThreeFsm();
if (is_string($result)) {
    // Error happens
    echo 'Error: ' . $result;
} else {
    echo 'Final state: ' . $result['state'];
}

echo PHP_EOL;

