<?php

namespace Mnemesong\SpexTestHelpers\checkers;

use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Webmozart\Assert\Assert;

class StringSpecificationChecker
{
    public static function check(StringValueComparingSpecification $spec, ?string $val): bool
    {
        $t = $spec->getType();
        if($t === 's=') {
            if(is_null($val)) {
                return false;
            }
            return $spec->getValue() === $val;
        } elseif ($t === 's!=') {
            if(is_null($val)) {
                return true;
            }
            return $spec->getValue() !== $val;
        }  elseif ($t === 's<') {
            if(is_null($val)) {
                return false;
            }
            return strcasecmp($val, $spec->getValue()) < 0;
        } elseif ($t === 's<=') {
            if(is_null($val)) {
                return false;
            }
            return strcasecmp($val, $spec->getValue()) <= 0;
        } elseif ($t === 's!<') {
            if(is_null($val)) {
                return true;
            }
            return strcasecmp($val, $spec->getValue()) >= 0;
        } elseif ($t === 's>') {
            if(is_null($val)) {
                return false;
            }
            return strcasecmp($val, $spec->getValue()) > 0;
        } elseif ($t === 's>=') {
            if(is_null($val)) {
                return false;
            }
            return strcasecmp($val, $spec->getValue()) >= 0;
        } elseif ($t === 's!>') {
            if(is_null($val)) {
                return true;
            }
            return strcasecmp($val, $spec->getValue()) >= 0;
        }
    }
}