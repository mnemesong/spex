<?php
declare(strict_types=1);

namespace Mnemesong\Spex\exceptions;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class InvalidSpecificationTypeException extends \InvalidArgumentException
{
    protected $message = 'Unknown specification type';
}