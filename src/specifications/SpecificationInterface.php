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
    const TYPE_STR_MORE = 's>';
    const TYPE_STR_NOT_MORE = 's!>';
    const TYPE_STR_EQUALS_OR_LESS = 's<=';
    const TYPE_STR_LESS = 's<';
    const TYPE_STR_NOT_LESS = 's!<';
    const TYPE_STR_EQUALS_OR_MORE = 's>=';
    const TYPE_STR_LIKE = 'like';
    const TYPE_STR_NOT_LIKE = '!like';

    //binary numeric value-comparing
    const TYPE_NUM_EQUALS = 'n=';
    const TYPE_NUM_NOT_EQUALS = 'n!=';
    const TYPE_NUM_MORE = 'n>';
    const TYPE_NUM_NOT_MORE = 'n!>';
    const TYPE_NUM_EQUALS_OR_LESS = 'n<=';
    const TYPE_NUM_LESS = 'n<';
    const TYPE_NUM_NOT_LESS = 'n!<';
    const TYPE_NUM_EQUALS_OR_MORE = 'n>=';

    //binary array-comparing
    const TYPE_IN = 'in';

    //binary fields-comparing
    const TYPE_COLUMN_STR_EQUALS = 'cs=';
    const TYPE_COLUMN_STR_NOT_EQUALS = 'cs!=';
    const TYPE_COLUMN_STR_MORE = 'cs>';
    const TYPE_COLUMN_STR_EQUALS_OR_LESS = 'cs<=';
    const TYPE_COLUMN_STR_LESS = 'cs<';
    const TYPE_COLUMN_STR_EQUALS_OR_MORE = 'cs>=';
    const TYPE_COLUMN_STR_LIKE = 'clike';
    const TYPE_COLUMN_NUM_EQUALS = 'cn=';
    const TYPE_COLUMN_NUM_NOT_EQUALS = 'cn!=';
    const TYPE_COLUMN_NUM_MORE = 'cn>';
    const TYPE_COLUMN_NUM_EQUALS_OR_LESS = 'cn<=';
    const TYPE_COLUMN_NUM_LESS = 'cn<';
    const TYPE_COLUMN_NUM_EQUALS_OR_MORE = 'cn>=';

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