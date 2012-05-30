<?php

include_once 'src/Frame.php';

class TenthFrame extends Frame {

    public function isClosed() {
        if (count($this->rolls) == 3) {
            return true;
        }
        elseif (count($this->rolls) < 2) {
            return false;
        }
        else {
            if (array_sum($this->rolls) >= 10) {
                return false;
            }
            else {
                return true;
            }
        }
    }
}
