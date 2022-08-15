<h1>mnemesong/spex</h1>

[![Latest Stable Version](http://poser.pugx.org/mnemesong/spex/v)](https://packagist.org/packages/mnemesong/spex)
[![PHPUnit](https://github.com/mnemesong/spex/actions/workflows/php-unit.yml/badge.svg)](https://github.com/mnemesong/spex/actions/workflows/php-unit.yml)
[![PHPStan-src-lvl9](https://github.com/mnemesong/spex/actions/workflows/phpstan-lvl9.yml/badge.svg)](https://github.com/mnemesong/spex/actions/workflows/phpstan-lvl9.yml)
[![PHPStan-test-unit-lvl5](https://github.com/mnemesong/spex/actions/workflows/phpstan-unit.yml/badge.svg)](https://github.com/mnemesong/spex/actions/workflows/phpstan-unit.yml)
[![PHP Version Require](http://poser.pugx.org/mnemesong/spex/require/php)](https://packagist.org/packages/mnemesong/spex)
[![License](http://poser.pugx.org/mnemesong/spex/license)](https://packagist.org/packages/mnemesong/spex)

- The documentation is written in two languages: Russian and English.
- Документация написана на двух языках: русском и английском.


<hr>

<h2>General description / Общее описание</h2>

<h3>ENG:</h3>
<p>The package provides objects and an interface for expression of specifications (describes the conditions for fetching 
records from storage). For quick construction, use Sp::ex() builder.</p>
<h3>RUS:</h3>
<p>Пакет предоставляет объекты и интерфейс для выражения спецификаций (описывают услоние выборки записей из хранилища).
Для быстрого построения используется билдер Sp::ex()</p>
<hr>

<h2>Requirements / Требования</h2>
<ul>
    <li>PHP >= 7.4</li>
    <li>Composer >=2.0</li>
</ul>
<hr>

<h2>Installation / Установка</h2>
<p>composer require "mnemesong/spex"</p>
<hr>

<h2>Specifications / Спецификации</h2>

<h3>ENG:</h3>
<p>Specifications allow you to specify a condition for searching or selecting records, including logically complex ones.</p>

<h4>Specifier Sp::ex</h4>
<p>The ex() method of class Sp allows you to quickly express any specification of various types. Its general syntax looks like
as follows</p>
<p><code>Sp::ex(&lt;spec character&gt;, &lt;column name&gt;, &lt;additional comparison parameter(column name, value or null)&gt);</code></p>
<p>Additional type parameter depends on the specification type. There are several types of specifications:</p>

<h4>Array comparison specifications</h4>
<p>They have the general form: <code>Sp::ex(string &lt;spec mark&gt;, string &lt;column name&gt;, array &lt;comparison array&gt;)</code></p>
<h6>Types of array comparison specifications:</h6>
<ul>
     <li><code>"in"</code> - checks whether the value in the column is included in the comparison array</li>
</ul>
<h6>Example:</h6>
<p><code>Sp::ex("in", "age", [11, 22, 33, 44, 55])</code></p>
<br>

<h4>Table column comparison specifications</h4>
<p>They have a general form: <code>Sp::ex(string &lt;spec mark&gt;, string &lt;column name&gt;, string &lt;column name&gt;)</code></p>
<h6>Table column comparison specification types:</h6>
<ul>
    <li><code>"c="</code> - checks the equality of values in two columns of the same table row</li>
    <li><code>"c!="</code> - checks for inequality of values in two columns of the same table row</li>
    <li><code>"c>"</code>, <code>"c>="</code>, <code>"c<"</code>, <code>"c<="</code>-
        compare values in two columns of one table row</li>
    <li><code>"clike"</code> - checks whether the value of the second column of the string is included in the first column as a substring</li>
</ul>
<h6>Example:</h6>
<p><code>Sp::ex("c<=", "contractsCount", "requestsCount")</code></p>
<br>

<h4>Number Comparison Specifications</h4>
<p>They have the general form: <code>Sp::ex(string &lt;spec mark&gt;, string &lt;column name&gt;, float|int|stringNumber &lt;numerical value&gt;)
</code></p>
<h6>Comparison specification types with numeric value:</h6>
<ul>
    <li><code>"n="</code> - checks for equality (not NULL-safe) of a column value with a specified numeric value</li>
    <li><code>"n!="</code> - checks for inequality (non-NULL-safe) values of a column with a specified numeric value</li>
    <li><code>"n>"</code>, <code>"n>="</code>, <code>"n<"</code>, <code>"n<="</code> - compares
        the value of the column with the specified numeric value</li>
</ul>
<h6>Example:</h6>
<p><code>Sp::ex("n=", "winsCount", "losesCount")</code></p>
<br>

<h4>String comparison specifications</h4>
<p>They have the general form: <code>Sp::ex(string &lt;spec mark&gt;, string &lt;column name&gt;, string &lt;string value&gt;)
</code></p>
<h6>Comparison specification types with string value:</h6>
<ul>
    <li><code>"s="</code> - checks for equality (not NULL-safe) of the column value with the specified string value</li>
    <li><code>"s!="</code> - checks if the value of the column with the specified string value is not NULL-safe</li>
    <li><code>"s>"</code>, <code>"s>="</code>, <code>"s<"</code>, <code>"s<="</code> - compare character by character
        values of the column with the specified string value</li>
    <li><code>"like"</code> - checks if a string value is a substring of a value in a column</li>
</ul>
<h6>Example:</h6>
<p><code>Sp::ex("s=", "name", "Bob")</code></p>
<br>

<h4>Unary Comparison Specifications</h4>
<p>They have a general form: <code>Sp::ex(string &lt;spec mark&gt;, string &lt;column name&gt;)</code></p>
<h6>Unary comparison specification types:</h6>
<ul>
    <li><code>"null"</code> - checks if the value of the column is NULL</li>
    <li><code>"!null"</code> - checks if the column value is null</li>
    <li><code>"empty"</code> - checks for equality in a NULL column or an empty string</li>
    <li><code>"!empty"</code> - checks if value is not NULL column or empty string</li>
</ul>
<h6>Example:</h6>
<p><code>Sp::ex("empty", "comment")</code></p>
<br>

<h4>Complex compound specifications</h4>
<p>They have the general form: <code>Sp::ex(string &lt;spec mark&gt;, SpecificationInterface[] &lt;array of child specifications&gt;)
</code></p>
<h6>Types of complex compound specifications:</h6>
<ul>
    <li><code>"and"</code> - specifications correspond to entries for which all conditions specified are met
        in child specifications</li>
    <li><code>"and"</code> - specifications correspond to the entry for which one of the conditions specified
        in child specifications</li>
</ul>
<h6>Example:</h6>
<p><code>Sp::ex("and", [Sp::ex("!empty", "birthday"), Sp::ex("!empty", "age")])</code ></p>
<br>

<h4>Unary compound specifications</h4>
<p>They have the general form: <code>Sp::ex(string &lt;spec mark&gt;, SpecificationInterface &lt;child specification&gt;)
</code></p>
<h6>Unary compound specification types:</h6>
<ul>
     <li><code>"!"</code> is a non-null-safe negation of a child specification.</li>
</ul>
<h6>Example:</h6>
<p><code>Sp::ex("!", Sp::ex("c=", "managerUuid", "customerUuid"))</code></p>

<h3>RUS:</h3>
<p>Спецификации позволяют указывать условие для поиска или отбора записей, в том числе логически сложные.</p>

<h4>Выразитель спецификаций Sp::ex</h4>
<p>Метод ex() класса Sp позволяет быстро выражать любые спецификации различных типов. Его общий синтаксис выгляди
следующим образом</p>
<p><code>Sp::ex(&lt;знак спецификации&gt;, &lt;имя колонки&gt;, &lt;доп. параметр сравнения(имя колонки, значеие или null)&gt);</code></p>
<p>Тип доп. параметра зависит от типа спецификации. Существует несколько типов спецификаций:</p>

<h4>Спецификации сравнения с массивом</h4>
<p>Имеют общий вид: <code>Sp::ex(string &lt;знак спецификации&gt;, string &lt;имя колонки&gt;, array &lt;массив сравнения&gt;)</code></p>
<h6>Типы спецификаций сравнения с массивом:</h6>
<ul>
    <li><code>"in"</code> - проверяет вхождение значения в колонке в массив сравнения</li>
</ul>
<h6>Пример:</h6>
<p><code>Sp::ex("in", "age", [11, 22, 33, 44, 55])</code></p>
<br>

<h4>Спецификации сравнения колонок таблицы</h4>
<p>Имеют общий вид: <code>Sp::ex(string &lt;знак спецификации&gt;, string &lt;имя колонки&gt;, string &lt;имя колонки&gt;)</code></p>
<h6>Типы спецификаций сравнения колонок таблицы:</h6>
<ul>
    <li><code>"c="</code> - проверяет равенство значений в двух колонках одной строки таблицы</li>
    <li><code>"c!="</code> - проверяет неравенство значений в двух колонках одной строки таблицы</li>
    <li><code>"c>"</code>, <code>"c>="</code>, <code>"c<"</code>, <code>"c<="</code> - 
        сравнивают значений в двух колонках одной строки таблицы</li>
    <li><code>"clike"</code> - проверяет вхождение значения второй колонки строки в первую в качестве подстроки</li>
</ul>
<h6>Пример:</h6>
<p><code>Sp::ex("c<=", "contractsCount", "requestsCount")</code></p>
<br>

<h4>Спецификации сравнения c числовым значением</h4>
<p>Имеют общий вид: <code>Sp::ex(string &lt;знак спецификации&gt;, string &lt;имя колонки&gt;, float|int|stringNumber &lt;числовое значение&gt;)
</code></p>
<h6>Типы спецификаций сравнения c числовым значением:</h6>
<ul>
    <li><code>"n="</code> - проверяет равенство (не NULL-безопасное) значения колонке с указанным числовым значением</li>
    <li><code>"n!="</code> - проверяет неравенство (не NULL-безопасное) значения колонке с указанным числовым значением</li>
    <li><code>"n>"</code>, <code>"n>="</code>, <code>"n<"</code>, <code>"n<="</code> - сравнивает 
        значения колонке с указанным числовым значением</li>
</ul>
<h6>Пример:</h6>
<p><code>Sp::ex("n=", "winsCount", "losesCount")</code></p>
<br>

<h4>Спецификации сравнения cо строковым значением</h4>
<p>Имеют общий вид: <code>Sp::ex(string &lt;знак спецификации&gt;, string &lt;имя колонки&gt;, string &lt;строковое значение&gt;)
</code></p>
<h6>Типы спецификаций сравнения cо строковым значением:</h6>
<ul>
    <li><code>"s="</code> - проверяет равенство (не NULL-безопасное) значения колонке с указанным строковым значением</li>
    <li><code>"s!="</code> - проверяет неравенство (не NULL-безопасное) значения колонке с указанным строковым значением</li>
    <li><code>"s>"</code>, <code>"s>="</code>, <code>"s<"</code>, <code>"s<="</code> - сравнивает посимвольно
        значения колонке с указанным строковым значением</li>
    <li><code>"like"</code> - проверяет вхождение строкового значения в значение в колонке в качестве подстроки</li>
</ul>
<h6>Пример:</h6>
<p><code>Sp::ex("s=", "name", "Bob")</code></p>
<br>

<h4>Спецификации унарного сравнения</h4>
<p>Имеют общий вид: <code>Sp::ex(string &lt;знак спецификации&gt;, string &lt;имя колонки&gt;)</code></p>
<h6>Типы спецификаций унарного сравнения:</h6>
<ul>
    <li><code>"null"</code> - проверяет равенство значения колонке NULL</li>
    <li><code>"!null"</code> - проверяет неравенство значения колонке NULL</li>
    <li><code>"empty"</code> - проверяет равенство значения в колонке NULL или пустой строке</li>
    <li><code>"!empty"</code> - проверяет неравенство значения колонке NULL или пустой строке</li>
</ul>
<h6>Пример:</h6>
<p><code>Sp::ex("empty", "comment")</code></p>
<br>

<h4>Сложные составные спецификации</h4>
<p>Имеют общий вид: <code>Sp::ex(string &lt;знак спецификации&gt;, SpecificationInterface[] &lt;массив дочерних спецификаций&gt;)
</code></p>
<h6>Типы сложных составных спецификаций:</h6>
<ul>
    <li><code>"and"</code> - спецификации отвечают записи для которых выполняются все условия, указанные 
        в дочерних спецификациях</li>
    <li><code>"and"</code> - спецификации отвечают записи для которых выполнется , одно из условий, указанных 
        в дочерних спецификациях</li>
</ul>
<h6>Пример:</h6>
<p><code>Sp::ex("and", [Sp::ex("!empty", "birthday"), Sp::ex("!empty", "age")])</code></p>
<br>

<h4>Унарные составные спецификации</h4>
<p>Имеют общий вид: <code>Sp::ex(string &lt;знак спецификации&gt;, SpecificationInterface &lt;дочерняя спецификация&gt;)
</code></p>
<h6>Типы унарных составных спецификаций:</h6>
<ul>
    <li><code>"!"</code> - не Null-безопасное отрицание дочерней спецификации.</li>
</ul>
<h6>Пример:</h6>
<p><code>Sp::ex("!", Sp::ex("c=", "managerUuid", "customerUuid"))</code></p>
<br>
<hr>

<h2>License / Лицензия</h2>
- MIT
<hr>

<h2>Contacts / Контакты</h2>
- Anatoly Starodubtsev "Pantagruel74"
- tostar74@mail.ru
