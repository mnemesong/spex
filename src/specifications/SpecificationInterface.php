<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications;

/**
 * ENG: Interface for specifications. The specification describes the record selection condition for a query/command.
 *
 * RUS: Интерфейс для спецификаций. Спецификация описывает условие выбора записей для запроса/комманды.
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
interface SpecificationInterface
{
    //binary string value-comparing
    const TYPE_STR_EQUALS = 's=';
    const TYPE_STR_NOT_EQUALS = 's!=';
    const TYPE_STR_NOT_EQUALS_NULL_SAFE = 's!=?';
    const TYPE_STR_MORE_THAN = 's>';
    const TYPE_STR_NOT_MORE_THAN = 's<=';
    const TYPE_STR_LESS_THAN = 's<';
    const TYPE_STR_NOT_LESS_THAN = 's>=';
    const TYPE_STR_LIKE = 'like';

    //binary numeric value-comparing
    const TYPE_NUM_EQUALS = 'n=';
    const TYPE_NUM_NOT_EQUALS = 'n!=';
    const TYPE_NUM_NOT_EQUALS_NULL_SAFE = 'n!=?';
    const TYPE_NUM_MORE_THAN = 'n>';
    const TYPE_NUM_NOT_MORE_THAN = 'n<=';
    const TYPE_NUM_LESS_THAN = 'n<';
    const TYPE_NUM_NOT_LESS_THAN = 'n>=';

    //binary array-comparing
    const TYPE_IN = 'in';

    //binary fields-comparing
    const TYPE_COLUMN_STR_EQUALS = 'cs=';
    const TYPE_COLUMN_STR_NOT_EQUALS = 'cs!=';
    const TYPE_COLUMN_STR_EQUALS_NULL_SAFE = 'cs=?';
    const TYPE_COLUMN_STR_NOT_EQUALS_NULL_SAFE = 'cs!=?';
    const TYPE_COLUMN_STR_MORE_THAN = 'cs>';
    const TYPE_COLUMN_STR_NOT_MORE_THAN = 'cs<=';
    const TYPE_COLUMN_STR_LESS_THAN = 'cs<';
    const TYPE_COLUMN_STR_NOT_LESS_THAN = 'cs>=';
    const TYPE_COLUMN_STR_LIKE = 'clike';
    const TYPE_COLUMN_NUM_EQUALS = 'cn=';
    const TYPE_COLUMN_NUM_NOT_EQUALS = 'cn!=';
    const TYPE_COLUMN_NUM_EQUALS_NULL_SAFE = 'cn=?';
    const TYPE_COLUMN_NUM_NOT_EQUALS_NULL_SAFE = 'cn!=?';
    const TYPE_COLUMN_NUM_MORE_THAN = 'cn>';
    const TYPE_COLUMN_NUM_NOT_MORE_THAN = 'cn<=';
    const TYPE_COLUMN_NUM_LESS_THAN = 'cn<';
    const TYPE_COLUMN_NUM_NOT_LESS_THAN = 'cn>=';

    //unary
    const TYPE_EMPTY = 'empty';
    const TYPE_NOT_EMPTY = '!empty';
    const TYPE_NULL = 'null';
    const TYPE_NOT_NULL = '!null';

    //composite
    const TYPE_NOT = '!';
    const TYPE_AND = 'and';
    const TYPE_OR = 'or';

    /**
     * @return bool
     */
    public function isComposite(): bool;

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string[]
     */
    public static function getAvailableTypes(): array;
}