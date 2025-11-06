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

}
