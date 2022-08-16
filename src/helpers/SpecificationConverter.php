<?php
declare(strict_types=1);

namespace Mnemesong\Spex\helpers;

use Mnemesong\Spex\Sp;
use Mnemesong\Spex\specifications\composites\MultipleCompositeSpecification;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Mnemesong\Structure\StructureInterface;
use Webmozart\Assert\Assert;

/**
 * ENG: Auxiliary class for quick conversion of structures into specifications. Useful when you need it fast
 * create a specification for the search for a specific structure by its values as by features.
 *
 * RUS: Вспомогательный класс для быстрой конвертации структур в спецификации. Полезен, когда нужно быстро
 * создать спецификацию поиска конкретной структуры по ее значениям как по признакам.
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class SpecificationConverter
{
    /**
     * @param StructureInterface $structure
     * @param string $composeOperator
     * @return SpecificationInterface|null
     */
    public static function structToSpec(StructureInterface $structure, string $composeOperator = 'and'): ?SpecificationInterface
    {
        Assert::inArray(
            $composeOperator,
            MultipleCompositeSpecification::getAvailableTypes(),
            'Invalid merge operator: ' . $composeOperator . '. Except one of: '
            . implode(', ', MultipleCompositeSpecification::getAvailableTypes()));
        if(empty($structure->toArray())) {
            return null;
        }
        $conds = $structure->map(fn($val, $key) => (isset($val) ? Sp::ex('s=', $key, $val) : Sp::ex('null', $key)));
        return Sp::ex($composeOperator, array_values($conds));
    }
}