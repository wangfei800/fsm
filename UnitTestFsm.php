<?php

/**
 * FSM Unit testing
 */
require_once('FsmParams.php');
require_once('FsmValidator.php');
require_once('Fsm.php');
require_once('FsmGenerator.php');

require_once('vendor/autoload.php');

use PHPUnit\Framework\TestCase;

class UnitTestFsm extends TestCase
{
    public function testValidator()
    {
        $fsmParams = new FsmParams([0,1,2], [], [], [], function () {});
        $validator = new FsmValidator();

        // current validator only implement the first and last parameters
        $ret = $validator->validate($fsmParams);
        $this->assertTrue($ret);

        // now there is error, the first param should be array
        $fsmParams = new FsmParams('', [], [], [], function () {});
        $ret = $validator->validate($fsmParams);
        $this->assertFalse($ret);

        // the last one is not a function
        $fsmParams = new FsmParams([0,1,2], [], [], [], '');
        $ret = $validator->validate($fsmParams);
        $this->assertFalse($ret);
    }

    public function testFsmGenerator()
    {
        $States         = ['S0', 'S1', 'S2'];
        $inputSet       = [0, 1];
        $finalStates    = ['S0', 'S1', 'S2'];
        $initialState   = 'S0';
        $fsmGenerator   = new FsmGenerator();
        $fsmParams      = new FsmParams($States, $inputSet, $initialState, $finalStates, 'transitionFunc');

        $generator = new FsmGenerator();
        $fsm = $generator->generateFsm($fsmParams);
        // This will fail as there is no transitionFunc
        $this->assertEquals(false, $fsm);

        $this->assertStringContainsString('transitionFunc should be callable', $generator->getError());
    }

    public function testFsm()
    {
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

        $States         = ['S0', 'S1', 'S2'];
        $inputSet       = [0, 1];
        $finalStates    = ['S0', 'S1', 'S2'];
        $initialState   = 'S0';
        $fsmGenerator   = new FsmGenerator();
        $fsmParams      = new FsmParams($States, $inputSet, $initialState, $finalStates, 'transitionFunc');

        $generator = new FsmGenerator();
        $fsm = $generator->generateFsm($fsmParams);

        // result should be S1 for 1
        $result = $fsm->run('1');
        if ($result && is_array($result)) {
            $this->assertEquals('S1', $result['state']);
        }

        // result should be S2 for 10
        $result = $fsm->run('10');
        if ($result && is_array($result)) {
            $this->assertEquals('S2', $result['state']);
        }

        // result should be S2 for 101
        $result = $fsm->run('101');
        if ($result && is_array($result)) {
            $this->assertEquals('S2', $result['state']);
        }

        // result should be S1 for 1010
        $result = $fsm->run('1010');
        if ($result && is_array($result)) {
            $this->assertEquals('S1', $result['state']);
        }
    }
}
