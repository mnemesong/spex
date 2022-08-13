<?php
declare(strict_types=1);

namespace Mnemesong\Spex\exceptions;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class InvalidSpecificationTypeException extends \InvalidArgumentException
{
    /* @phpstan-ignore-next-line */
    protected $message = 'Unknown specification type';
}