# Inserting PHP into Web Pages

* The PHP parser does not parse anything that is not included in the tags that indicate PHP script.
* There are several ways to delimit PHP script, but only "<?php ?>" and "<?= ?>" are commonly used.
* It is a common coding standard to require that the closing tag is omitted in included files, but this is not a PHP requirement

# Language Constructs

* Language constructs are different from functions in that they are baked right into the language.
* Language constructs are not functions, and so cannot be used as a callback function. They follow rules that are different from functions when it comes to parameters and the use of parentheses.
* The PHP Manual page on reserved keywords 1 has a complete list
* One possible tricky exam question that might come up is in understanding the small difference between print and echo.
* The reason not to use include_once() and require_once() all the time is a performance issue.

# Comments

* There are three styles to mark comments
* API documentation can additionally conform to external standards such as those used by the PHPDocumentor project.

# Representing Numbers

* There are four ways in which an integer may be expressed in a PHP script
* Floating point numbers (called doubles in some other languages) can be expressed either in standard decimal format or in exponential format.

# Variables

* PHP is a loosely typed language. It is important not to think that PHP variables don’t have a type. They most definitely do, it’s just that they may change type during runtime and don’t need their type to be declared explicitly when initialized.
* PHP will implicitly cast the variable to the data type required for an operation.
* PHP has three categories of variable—scalars, composite, and resources.
* PHP has the null type, which is used for variables that have not had a value set to them.
* There are four scalar types.
* Strings in PHP are not simply a list of characters. Internally PHP strings contain information about their length and are not null terminated.
* There are two composite types: arrays and objects.
* You can cast a variable to null, as in the following example, but this behavior is deprecated in PHP 7.2 so you shouldn’t do it even though PHP 7.1 supports it.
* Be very careful when casting between floats and integers.
* Naming variables: Names are case sensitive; Names may contain letters, numbers, and the underscore character; Names may not begin with a number;
* PHP 7 will always evaluate access strictly left to right.
* There are several caveats to using variable variable names. They could impact on your code security and can also make your code a little murky to read.
* Variables become unset when they become out of scope and you can use the command unset() to manually clear a variable.

# Constants

* Constants 7 are similar to variables but are immutable. They have the same naming rules as variables, but by convention will have uppercase names.
* The third parameter of define is optional and indicates whether the constant name is case sensitive or not.
* Constants can only contain arrays or scalar values and not resources or objects.
* Only the const keyword can be used to create a namespaced constant
* The constant() function 9 is used to retrieve the value of a constant.

# Superglobals

* Superglobals are available in every scope.
* You can alter the values of superglobals, but it’s generally suggested to rather assign a locally scoped variable to the superglobal and modify that.
* The $_SERVER superglobal has many keys, and you should be familiar with them.

# Magic Constants

* Magic constants are those which PHP provides automatically to every running script.
* The value of these magic constants changes depending on where you use it.

# Operators
# Control Structures
# Configuration
# Performance

# Namespaces

* In the broadest definition namespaces are a way of encapsulating items.
* In the PHP world, namespaces are designed to solve two problems: name collisions and ability to alias (or shorten) Extra_Long_Names designed to alleviate the first problem.
* Namespace names are case-insensitive.
* The Namespace name PHP, and compound names starting with this name (like PHP\Classes) are reserved for internal language use and should not be used in the userspace code.
* Multiple namespaces may also be declared in the same file. There are two allowed syntaxes.
* Much like directories and files, PHP namespaces also contain the ability to specify a hierarchy of namespace names. Thus, a namespace name can be defined with sub-levels.
* A simple analogy can be made between PHP namespaces and a filesystem. There are three ways to access a file in a file system and it is the same for PHP namespaces.