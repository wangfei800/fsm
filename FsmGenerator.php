<?php

require_once('Fsm.php');
require_once('FsmParams.php');
require_once('FsmValidator.php');

/*
 * Finite automation machine generator
 *
 */
class FsmGenerator
{
    protected $validator = null;
    protected $errorMessage = '';

    public function __construct()
    {
        $this->validator = new FsmValidator();
    }

    public function getError()
    {
        return $this->errorMessage;
    }

    /**
     * Run the finite automation machine with given input.
     *
     * @param string $inputString
     * @return array
     * @throws Exception
     */
    public function generateFsm(FsmParams $fsmParams, $validator = null)
    {
        try {
            if (!empty($validator)) {
                $this->validator = $validator;
            }

            if (!$this->validator->validate($fsmParams)) {
                throw new \Exception('Error in parameters: ' . $this->validator->getError());
            }

            $fsm = new Fsm($fsmParams);

            return $fsm;

        } catch (Exception $ex) {
            $this->errorMessage = $ex->getMessage();
            return false;
        }
    }
}
