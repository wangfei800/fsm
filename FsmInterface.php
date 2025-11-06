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
     * Run the finite automation machine with given input.
     *
     * @param string $inputString
     * @return array
     * @throws Exception
     */
    public function run($inputString): array;
}
