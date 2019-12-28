<?php

namespace App\Utils;

class BigNumber
{
    const ROUND_MODE_FLOOR = 'floor';
    const ROUND_MODE_CEIL = 'ceil';
    const ROUND_MODE_HALF_UP = 'half_up';

    protected $precision = 10;

    protected $value;

    public static function new($value, $roundMode = BigNumber::ROUND_MODE_HALF_UP)
    {
        return new BigNumber($value, $roundMode);
    }

    public function __construct($value, $roundMode = BigNumber::ROUND_MODE_HALF_UP)
    {
        if ($this->isNumber($value)) {
            $value = $this->convertNumberToString($value);
        }
        $roundedValue = BigNumber::round($value, $roundMode, $this->precision);
        $this->value = $this->standardize((string) $roundedValue);
    }

    private function isNumber($value)
    {
        $type = gettype($value);
        // string like '2.4e-7 need to be converted to correct format'
        return $type == 'integer' || $type == 'double' || ($type == 'string' && strpos($value, 'e'));
    }

    private function isBigNumber($value)
    {
        return gettype($value) == 'object' && get_class($value) == 'BigNumber';
    }

    private function standardize($value)
    {
        if (strpos($value, '.') !== false) {
            $index = strlen($value);
            do {
                $index--;
            } while ($value[$index] == '0');
            if ($value[$index] == '.') {
                $index--;
            }
            return substr($value, 0, $index + 1);
        }
        return $value;
    }

    private function convertNumberToString($value)
    {
        return number_format($value, $this->precision + 1, '.', '');
    }

    public function add($number, $roundMode = BigNumber::ROUND_MODE_HALF_UP)
    {
        $result = bcadd($this->value, new BigNumber($number), $this->precision + 1);
        return new BigNumber($result, $roundMode);
    }

    public function sub($number, $roundMode = BigNumber::ROUND_MODE_HALF_UP)
    {
        $result = bcsub($this->value, new BigNumber($number), $this->precision + 1);
        return new BigNumber($result, $roundMode);
    }

    public function div($number, $roundMode = BigNumber::ROUND_MODE_HALF_UP)
    {
        $result = bcdiv($this->value, new BigNumber($number), $this->precision + 1);
        return new BigNumber($result, $roundMode);
    }

    public function mul($number, $roundMode = BigNumber::ROUND_MODE_HALF_UP)
    {
        $result = bcmul($this->value, new BigNumber($number), $this->precision + 1);
        return new BigNumber($result, $roundMode);
    }

    public static function round($value, $mode, $precision)
    {
        $addition = '0';
        if ($precision > 0) {
            $addition = '0.' . str_repeat('0', $precision - 1);
            switch ($mode) {
                case BigNumber::ROUND_MODE_CEIL:
                    $addition = $addition . '0999';
                    break;
                case BigNumber::ROUND_MODE_FLOOR:
                    $addition = $addition . '0';
                    break;
                case BigNumber::ROUND_MODE_HALF_UP:
                    $addition = $addition . '05';
                    break;
            }
        } else {
            switch ($mode) {
                case BigNumber::ROUND_MODE_CEIL:
                    $addition = '0.999';
                    break;
                case BigNumber::ROUND_MODE_FLOOR:
                    $addition = '0';
                    break;
                case BigNumber::ROUND_MODE_HALF_UP:
                    $addition = '0.5';
                    break;
            }
        }
        if (bccomp($value, '0', $precision) < 0) {
            $addition = '-' . $addition;
        }
        return bcadd($value, $addition, $precision);
    }

    public function comp($value)
    {
        return bccomp($this->value, new BigNumber($value), $this->precision);
    }

    public static function min($a, $b)
    {
        return (BigNumber::new($a)->comp($b) < 0) ? $a : $b;
    }

    public static function max($a, $b)
    {
        return (BigNumber::new($a)->comp($b) > 0) ? $a : $b;
    }

    public function toString()
    {
        return $this->value === null ? '' : $this->value;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function isNegative(){
        return $this->comp(0) < 0;
    }
}
