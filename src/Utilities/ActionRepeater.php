<?php

namespace myTests\Utilities;


trait ActionRepeater
{
    public function repeatAction($action, $timeout = 5, $rate = 300000, $refresh = false)
    {
        $result = null;
        $startTime = time();
        $rate = $refresh ? 5000000 : $rate; //if site is refreshed wait 5 seconds in order to give it time to load
        do {
            try {
                $exception = null;

                if ($result = $action()) {
                    return $result;
                }
            } catch (\Exception $e) {
                $exception = $e;
            }
            if (time() - $startTime >= $timeout) {
                break;
            }
            usleep($rate);
        } while (true);

        if (!empty($exception)) {
            throw $exception;
        }

        return $result;
    }
}
